import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// ================= Args =================

const args = process.argv.slice(2);
const rawArg = args.find(a => !a.startsWith("--"));
const isReadOnly = args.includes("--readonly");
const isCrud = args.includes("--crud") || !isReadOnly;
const withTests = !args.includes("--no-tests");

if (!rawArg) {
    console.log("❌ Debes especificar el nombre del módulo.");
    console.log("\n📖 Uso:");
    console.log("  node generate-module.js Product                    # CRUD completo");
    console.log("  node generate-module.js configuracion/auth/Login  # Módulo anidado");
    console.log("  node generate-module.js Product --readonly         # Solo lectura");
    console.log("  node generate-module.js Product --no-tests         # Sin tests");
    process.exit(1);
}

// ================= Module Config =================

// Procesar la ruta completa del módulo (ej: "configuracion/auth/login")
const parts = rawArg.split(/[\/\\]/).filter(Boolean);
const moduleName = parts[parts.length - 1]; // El último elemento es el nombre del módulo
const modulePath = parts.slice(0, -1); // El resto es la ruta de carpetas

const tableName = moduleName
    .replace(/([a-z])([A-Z])/g, "$1_$2")
    .toLowerCase();

// Construir la ruta base considerando las carpetas anidadas
const moduleBase = path.join(__dirname, "src", ...parts);
const domainBase = path.join(moduleBase, "Domain");
const applicationBase = path.join(moduleBase, "Application");
const infraBase = path.join(moduleBase, "Infrastructure");
const testsBase = path.join(moduleBase, "Tests");

// Construir el namespace considerando las carpetas anidadas
const baseNamespace = `Src\\${parts.join("\\")}`;

// Para la tabla, usar prefijo si hay carpetas anidadas
const tablePrefix = modulePath.length > 0 
    ? modulePath.map(p => p.toLowerCase()).join('_') + '_'
    : '';
const fullTableName = tablePrefix + tableName;

// ================= Helpers =================

function createFolders(base, folders) {
    folders.forEach(folder => {
        const dir = path.join(base, folder);
        if (!fs.existsSync(dir)) fs.mkdirSync(dir, { recursive: true });
    });
}

function createFileIfNotExists(file, content) {
    if (!fs.existsSync(file)) {
        fs.writeFileSync(file, content);
        console.log(`   ✓ ${path.relative(__dirname, file)}`);
    }
}

// ================= Templates =================

// ---------- Domain: Entity (Plain PHP Object) ----------

const entityTemplate = (ns, model) => `<?php

namespace ${ns}\\Domain\\Entities;

final class ${model}
{
    public function __construct(
        private ?int $id = null,
        // TODO: Add domain properties
        private ?\\DateTimeImmutable $createdAt = null,
        private ?\\DateTimeImmutable $updatedAt = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): ?\\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    // TODO: Add getters and setters for domain properties

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            // TODO: Add other properties
        ];
    }
}
`;

// ---------- Domain: Repository Interface ----------

const repositoryInterfaceTemplate = (ns, model) => `<?php

namespace ${ns}\\Domain\\Repositories;

use ${ns}\\Domain\\Entities\\${model};

interface ${model}RepositoryInterface
{
    public function save(${model} $entity): ${model};
    public function find(int $id): ${model};
    public function delete(${model} $entity): void;
    public function all(): array;
    public function exists(int $id): bool;
}
`;

// ---------- Domain: Exceptions ----------

const notFoundExceptionTemplate = (ns, model) => `<?php

namespace ${ns}\\Domain\\Exceptions;

use DomainException;

final class ${model}NotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("${model} with ID {$id} not found");
    }
}
`;

const validationExceptionTemplate = (ns, model) => `<?php

namespace ${ns}\\Domain\\Exceptions;

use DomainException;

final class ${model}ValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
`;

// ---------- Infrastructure: Eloquent Model ----------

const eloquentModelTemplate = (ns, model, table) => `<?php

namespace ${ns}\\Infrastructure\\Persistence\\Eloquent;

use Illuminate\\Database\\Eloquent\\Model;

final class ${model}Model extends Model
{
    protected $table = '${table}';
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
`;

// ---------- Infrastructure: Repository Implementation ----------

const repositoryImplementationTemplate = (ns, model) => `<?php

namespace ${ns}\\Infrastructure\\Persistence\\Repositories;

use ${ns}\\Domain\\Entities\\${model};
use ${ns}\\Domain\\Repositories\\${model}RepositoryInterface;
use ${ns}\\Domain\\Exceptions\\${model}NotFoundException;
use ${ns}\\Infrastructure\\Persistence\\Eloquent\\${model}Model;

final class Eloquent${model}Repository implements ${model}RepositoryInterface
{
    public function save(${model} $entity): ${model}
    {
        $model = $entity->getId()
            ? ${model}Model::findOrFail($entity->getId())
            : new ${model}Model();

        $data = $entity->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);
        
        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): ${model}
    {
        $model = ${model}Model::find($id);

        if (!$model) {
            throw new ${model}NotFoundException($id);
        }

        return $this->mapToEntity($model);
    }

    public function delete(${model} $entity): void
    {
        if (!$entity->getId()) {
            throw new ${model}NotFoundException(0);
        }

        ${model}Model::destroy($entity->getId());
    }

    public function all(): array
    {
        return ${model}Model::all()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    public function exists(int $id): bool
    {
        return ${model}Model::where('id', $id)->exists();
    }

    private function mapToEntity(${model}Model $model): ${model}
    {
        return new ${model}(
            id: $model->id,
            // TODO: Map other properties
            createdAt: $model->created_at ? new \\DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \\DateTimeImmutable($model->updated_at) : null,
        );
    }
}
`;

// ---------- Application: DTOs ----------

const createDto = (ns, model) => `<?php

namespace ${ns}\\Application\\DTOs;

use ${ns}\\Domain\\Exceptions\\${model}ValidationException;

final class Create${model}DTO
{
    public function __construct(
        // TODO: Add required properties
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        // TODO: Add validation logic
        // Example:
        // if (empty($this->name)) {
        //     throw new ${model}ValidationException('Name is required');
        // }
    }

    public function toArray(): array
    {
        return [
            // TODO: Map properties
        ];
    }
}
`;

const updateDto = (ns, model) => `<?php

namespace ${ns}\\Application\\DTOs;

use ${ns}\\Domain\\Exceptions\\${model}ValidationException;

final class Update${model}DTO
{
    public function __construct(
        public readonly int $id,
        // TODO: Add properties to update
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->id <= 0) {
            throw new ${model}ValidationException('Invalid ID');
        }
        // TODO: Add more validation logic
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            // TODO: Map properties
        ];
    }
}
`;

const listDto = (ns, model) => `<?php

namespace ${ns}\\Application\\DTOs;

final class List${model}DTO
{
    public function __construct(
        public readonly ?int $page = 1,
        public readonly ?int $perPage = 15,
        public readonly ?string $sortBy = 'id',
        public readonly ?string $sortOrder = 'asc',
        // TODO: Add filter parameters
    ) {}
}
`;

// ---------- Application: Response DTOs ----------

const responseDto = (ns, model) => `<?php

namespace ${ns}\\Application\\DTOs;

final class ${model}ResponseDTO
{
    public function __construct(
        public readonly int $id,
        // TODO: Add response properties
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\\${ns}\\Domain\\Entities\\${model} $entity): self
    {
        return new self(
            id: $entity->getId(),
            // TODO: Map entity properties
            createdAt: $entity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $entity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            // TODO: Add other properties
        ];
    }
}
`;

// ---------- Application: UseCases ----------

const createUseCase = (ns, model) => `<?php

namespace ${ns}\\Application\\UseCases;

use ${ns}\\Application\\DTOs\\Create${model}DTO;
use ${ns}\\Application\\DTOs\\${model}ResponseDTO;
use ${ns}\\Domain\\Entities\\${model};
use ${ns}\\Domain\\Repositories\\${model}RepositoryInterface;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Facades\\Log;

final class Create${model}UseCase
{
    public function __construct(
        private ${model}RepositoryInterface $repository
    ) {}

    public function execute(Create${model}DTO $dto): ${model}ResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating ${model}', $dto->toArray());

            $entity = new ${model}(
                // TODO: Map DTO to Entity
            );

            $entity = $this->repository->save($entity);

            Log::info('${model} created successfully', ['id' => $entity->getId()]);

            return ${model}ResponseDTO::fromEntity($entity);
        });
    }
}
`;

const updateUseCase = (ns, model) => `<?php

namespace ${ns}\\Application\\UseCases;

use ${ns}\\Application\\DTOs\\Update${model}DTO;
use ${ns}\\Application\\DTOs\\${model}ResponseDTO;
use ${ns}\\Domain\\Repositories\\${model}RepositoryInterface;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Facades\\Log;

final class Update${model}UseCase
{
    public function __construct(
        private ${model}RepositoryInterface $repository
    ) {}

    public function execute(Update${model}DTO $dto): ${model}ResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating ${model}', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            // TODO: Update entity properties from DTO

            $entity = $this->repository->save($entity);

            Log::info('${model} updated successfully', ['id' => $entity->getId()]);

            return ${model}ResponseDTO::fromEntity($entity);
        });
    }
}
`;

const deleteUseCase = (ns, model) => `<?php

namespace ${ns}\\Application\\UseCases;

use ${ns}\\Domain\\Repositories\\${model}RepositoryInterface;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Facades\\Log;

final class Delete${model}UseCase
{
    public function __construct(
        private ${model}RepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Deleting ${model}', ['id' => $id]);

            $entity = $this->repository->find($id);
            $this->repository->delete($entity);

            Log::info('${model} deleted successfully', ['id' => $id]);
        });
    }
}
`;

const listUseCase = (ns, model) => `<?php

namespace ${ns}\\Application\\UseCases;

use ${ns}\\Application\\DTOs\\List${model}DTO;
use ${ns}\\Application\\DTOs\\${model}ResponseDTO;
use ${ns}\\Domain\\Repositories\\${model}RepositoryInterface;

final class List${model}UseCase
{
    public function __construct(
        private ${model}RepositoryInterface $repository
    ) {}

    public function execute(List${model}DTO $dto): array
    {
        $entities = $this->repository->all();

        return array_map(
            fn($entity) => ${model}ResponseDTO::fromEntity($entity),
            $entities
        );
    }
}
`;

// ---------- Infrastructure: Requests ----------

const createRequest = (ns, model) => `<?php

namespace ${ns}\\Infrastructure\\Http\\Requests;

use Illuminate\\Foundation\\Http\\FormRequest;
use ${ns}\\Application\\DTOs\\Create${model}DTO;

final class Create${model}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // TODO: Add validation rules
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:table_name',
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: Add custom error messages
        ];
    }

    public function toDTO(): Create${model}DTO
    {
        return new Create${model}DTO(
            // TODO: Map validated request data to DTO
        );
    }
}
`;

const updateRequest = (ns, model) => `<?php

namespace ${ns}\\Infrastructure\\Http\\Requests;

use Illuminate\\Foundation\\Http\\FormRequest;
use ${ns}\\Application\\DTOs\\Update${model}DTO;

final class Update${model}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // TODO: Add validation rules
            // 'name' => 'sometimes|required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: Add custom error messages
        ];
    }

    public function toDTO(): Update${model}DTO
    {
        return new Update${model}DTO(
            $this->route('id'),
            // TODO: Map validated request data to DTO
        );
    }
}
`;

// ---------- Controller ----------

const controllerTemplate = (ns, model, crud) => `<?php

namespace ${ns}\\Infrastructure\\Http\\Controllers;

use Illuminate\\Http\\JsonResponse;
use ${ns}\\Application\\UseCases\\List${model}UseCase;
use ${ns}\\Application\\DTOs\\List${model}DTO;
use ${ns}\\Domain\\Exceptions\\${model}NotFoundException;
use ${ns}\\Domain\\Exceptions\\${model}ValidationException;
${crud ? `use ${ns}\\Infrastructure\\Http\\Requests\\Create${model}Request;
use ${ns}\\Infrastructure\\Http\\Requests\\Update${model}Request;
use ${ns}\\Application\\UseCases\\Create${model}UseCase;
use ${ns}\\Application\\UseCases\\Update${model}UseCase;
use ${ns}\\Application\\UseCases\\Delete${model}UseCase;
` : ""}
final class ${model}Controller
{
    public function index(List${model}UseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new List${model}DTO());
            
            return response()->json([
                'data' => $data,
                'message' => 'List retrieved successfully'
            ]);
        } catch (\\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve list',
                'message' => $e->getMessage()
            ], 500);
        }
    }
${crud ? `
    public function store(Create${model}Request $request, Create${model}UseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => '${model} created successfully'
            ], 201);
        } catch (${model}ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\\Exception $e) {
            return response()->json([
                'error' => 'Failed to create ${model}',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id, List${model}UseCase $useCase): JsonResponse
    {
        try {
            // TODO: Implement Get${model}UseCase for single item
            return response()->json([
                'message' => 'Not implemented yet'
            ], 501);
        } catch (${model}NotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, Update${model}Request $request, Update${model}UseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => '${model} updated successfully'
            ]);
        } catch (${model}NotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (${model}ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\\Exception $e) {
            return response()->json([
                'error' => 'Failed to update ${model}',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, Delete${model}UseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);
            
            return response()->json([
                'message' => '${model} deleted successfully'
            ], 204);
        } catch (${model}NotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete ${model}',
                'message' => $e->getMessage()
            ], 500);
        }
    }
` : ""}
}
`;

// ---------- Routes ----------

const routesTemplate = (ns, model, modulePath, crud) => {
    // Crear la ruta del endpoint basada en la jerarquía de carpetas
    const routePrefix = modulePath.length > 0 
        ? modulePath.map(p => p.toLowerCase()).join('/') + '/' + model.toLowerCase()
        : model.toLowerCase();
    
    return `<?php

use Illuminate\\Support\\Facades\\Route;
use ${ns}\\Infrastructure\\Http\\Controllers\\${model}Controller;

Route::prefix('${routePrefix}')->group(function () {
    Route::get('/', [${model}Controller::class, 'index']);
${crud ? `    Route::post('/', [${model}Controller::class, 'store']);
    Route::get('/{id}', [${model}Controller::class, 'show']);
    Route::put('/{id}', [${model}Controller::class, 'update']);
    Route::delete('/{id}', [${model}Controller::class, 'destroy']);
` : ""}});
`;
};

// ---------- Provider ----------

const providerTemplate = (ns, module, modulePath) => {
    const routesPath = modulePath.length > 0
        ? `src/${modulePath.join('/')}/${module}/Infrastructure/Http/Routes/api.php`
        : `src/${module}/Infrastructure/Http/Routes/api.php`;

    return `<?php

namespace ${ns}\\Infrastructure\\Providers;

use Illuminate\\Support\\ServiceProvider;
use ${ns}\\Domain\\Repositories\\${module}RepositoryInterface;
use ${ns}\\Infrastructure\\Persistence\\Repositories\\Eloquent${module}Repository;

final class ${module}ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            ${module}RepositoryInterface::class,
            Eloquent${module}Repository::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(
            base_path('${routesPath}')
        );
    }
}
`;
};

// ---------- Tests ----------

const unitTestTemplate = (ns, model) => `<?php

namespace ${ns}\\Tests\\Unit;

use PHPUnit\\Framework\\TestCase;
use ${ns}\\Domain\\Entities\\${model};

final class ${model}Test extends TestCase
{
    public function test_can_create_entity(): void
    {
        $entity = new ${model}();
        
        $this->assertInstanceOf(${model}::class, $entity);
        $this->assertNull($entity->getId());
    }

    public function test_can_convert_to_array(): void
    {
        $entity = new ${model}();
        $array = $entity->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
    }

    // TODO: Add more unit tests
}
`;

const featureTestTemplate = (ns, model, modulePath, crud) => {
    const routePrefix = modulePath.length > 0 
        ? modulePath.map(p => p.toLowerCase()).join('/') + '/' + model.toLowerCase()
        : model.toLowerCase();

    return `<?php

namespace ${ns}\\Tests\\Feature;

use Tests\\TestCase;
use Illuminate\\Foundation\\Testing\\RefreshDatabase;

final class ${model}ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_${model.toLowerCase()}(): void
    {
        $response = $this->getJson('/api/${routePrefix}');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'message']);
    }
${crud ? `
    public function test_can_create_${model.toLowerCase()}(): void
    {
        $data = [
            // TODO: Add test data
        ];

        $response = $this->postJson('/api/${routePrefix}', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_update_${model.toLowerCase()}(): void
    {
        // TODO: Create a ${model} first
        // $${model.toLowerCase()} = ...;

        $data = [
            // TODO: Add update data
        ];

        $response = $this->putJson('/api/${routePrefix}/1', $data);

        $response->assertStatus(200);
    }

    public function test_can_delete_${model.toLowerCase()}(): void
    {
        // TODO: Create a ${model} first
        // $${model.toLowerCase()} = ...;

        $response = $this->deleteJson('/api/${routePrefix}/1');

        $response->assertStatus(204);
    }
` : ""}
    // TODO: Add more feature tests
}
`;
};

// ================= Create Structure =================

const displayPath = parts.join('/');
console.log(`\n🚀 Generando módulo: ${displayPath} (${isCrud ? "CRUD" : "READ-ONLY"})\n`);

// Create folders
createFolders(domainBase, ["Entities", "Repositories", "Exceptions"]);
createFolders(applicationBase, ["DTOs", "UseCases"]);
createFolders(infraBase, [
    "Http/Requests",
    "Http/Controllers",
    "Http/Routes",
    "Persistence/Eloquent",
    "Persistence/Repositories",
    "Providers"
]);

if (withTests) {
    createFolders(testsBase, ["Unit", "Feature"]);
}

// ================= Domain Layer =================

console.log("📦 Domain Layer:");

createFileIfNotExists(
    path.join(domainBase, `Entities/${moduleName}.php`),
    entityTemplate(baseNamespace, moduleName)
);

createFileIfNotExists(
    path.join(domainBase, `Repositories/${moduleName}RepositoryInterface.php`),
    repositoryInterfaceTemplate(baseNamespace, moduleName)
);

createFileIfNotExists(
    path.join(domainBase, `Exceptions/${moduleName}NotFoundException.php`),
    notFoundExceptionTemplate(baseNamespace, moduleName)
);

createFileIfNotExists(
    path.join(domainBase, `Exceptions/${moduleName}ValidationException.php`),
    validationExceptionTemplate(baseNamespace, moduleName)
);

// ================= Application Layer =================

console.log("\n🎯 Application Layer:");

createFileIfNotExists(
    path.join(applicationBase, `DTOs/List${moduleName}DTO.php`),
    listDto(baseNamespace, moduleName)
);

createFileIfNotExists(
    path.join(applicationBase, `DTOs/${moduleName}ResponseDTO.php`),
    responseDto(baseNamespace, moduleName)
);

createFileIfNotExists(
    path.join(applicationBase, `UseCases/List${moduleName}UseCase.php`),
    listUseCase(baseNamespace, moduleName)
);

if (isCrud) {
    createFileIfNotExists(
        path.join(applicationBase, `DTOs/Create${moduleName}DTO.php`),
        createDto(baseNamespace, moduleName)
    );

    createFileIfNotExists(
        path.join(applicationBase, `DTOs/Update${moduleName}DTO.php`),
        updateDto(baseNamespace, moduleName)
    );

    createFileIfNotExists(
        path.join(applicationBase, `UseCases/Create${moduleName}UseCase.php`),
        createUseCase(baseNamespace, moduleName)
    );

    createFileIfNotExists(
        path.join(applicationBase, `UseCases/Update${moduleName}UseCase.php`),
        updateUseCase(baseNamespace, moduleName)
    );

    createFileIfNotExists(
        path.join(applicationBase, `UseCases/Delete${moduleName}UseCase.php`),
        deleteUseCase(baseNamespace, moduleName)
    );
}

// ================= Infrastructure Layer =================

console.log("\n🔧 Infrastructure Layer:");

createFileIfNotExists(
    path.join(infraBase, `Persistence/Eloquent/${moduleName}Model.php`),
    eloquentModelTemplate(baseNamespace, moduleName, fullTableName)
);

createFileIfNotExists(
    path.join(infraBase, `Persistence/Repositories/Eloquent${moduleName}Repository.php`),
    repositoryImplementationTemplate(baseNamespace, moduleName)
);

if (isCrud) {
    createFileIfNotExists(
        path.join(infraBase, `Http/Requests/Create${moduleName}Request.php`),
        createRequest(baseNamespace, moduleName)
    );

    createFileIfNotExists(
        path.join(infraBase, `Http/Requests/Update${moduleName}Request.php`),
        updateRequest(baseNamespace, moduleName)
    );
}

createFileIfNotExists(
    path.join(infraBase, `Http/Controllers/${moduleName}Controller.php`),
    controllerTemplate(baseNamespace, moduleName, isCrud)
);

createFileIfNotExists(
    path.join(infraBase, `Http/Routes/api.php`),
    routesTemplate(baseNamespace, moduleName, modulePath, isCrud)
);

createFileIfNotExists(
    path.join(infraBase, `Providers/${moduleName}ServiceProvider.php`),
    providerTemplate(baseNamespace, moduleName, modulePath)
);

// ================= Tests =================

if (withTests) {
    console.log("\n🧪 Tests:");
    
    createFileIfNotExists(
        path.join(testsBase, `Unit/${moduleName}Test.php`),
        unitTestTemplate(baseNamespace, moduleName)
    );

    createFileIfNotExists(
        path.join(testsBase, `Feature/${moduleName}ControllerTest.php`),
        featureTestTemplate(baseNamespace, moduleName, modulePath, isCrud)
    );
}

// ================= Instructions =================

console.log(`\n✅ Módulo ${moduleName} generado exitosamente\n`);
console.log("📋 Pasos siguientes:\n");
console.log("1️⃣  Registra el ServiceProvider en config/app.php:");
console.log(`   ${baseNamespace}\\Infrastructure\\Providers\\${moduleName}ServiceProvider::class,\n`);

console.log("2️⃣  Agrega el autoload en composer.json:");
console.log(`   "autoload": {`);
console.log(`     "psr-4": {`);
console.log(`       "Src\\\\": "src/"`);
console.log(`     }`);
console.log(`   }\n`);

console.log("3️⃣  Ejecuta:");
console.log(`   composer dump-autoload\n`);

console.log("4️⃣  Crea la migración:");
console.log(`   php artisan make:migration create_${tableName}_table\n`);

console.log("5️⃣  Completa los TODOs en:");
console.log(`   - src/${moduleName}/Domain/Entities/${moduleName}.php`);
console.log(`   - src/${moduleName}/Application/DTOs/*.php`);
console.log(`   - src/${moduleName}/Application/UseCases/*.php`);
console.log(`   - src/${moduleName}/Infrastructure/Persistence/Repositories/*.php`);
if (isCrud) {
    console.log(`   - src/${moduleName}/Infrastructure/Http/Requests/*.php`);
}

console.log("\n6️⃣  Ejecuta los tests:");
console.log(`   php artisan test src/${moduleName}/Tests\n`);

console.log("🌐 Endpoints disponibles:");
console.log(`   GET    /api/${moduleName.toLowerCase()}`);
if (isCrud) {
    console.log(`   POST   /api/${moduleName.toLowerCase()}`);
    console.log(`   GET    /api/${moduleName.toLowerCase()}/{id}`);
    console.log(`   PUT    /api/${moduleName.toLowerCase()}/{id}`);
    console.log(`   DELETE /api/${moduleName.toLowerCase()}/{id}`);
}
console.log("\n7️⃣  Ejecuta el servidor:");
console.log(`   php artisan serve\n`);