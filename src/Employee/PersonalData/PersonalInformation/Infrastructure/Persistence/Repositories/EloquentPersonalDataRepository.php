<?php

namespace Src\Employee\PersonalData\PersonalInformation\Infrastructure\Persistence\Repositories;

use Src\Employee\PersonalData\PersonalInformation\Domain\Entities\PersonalData;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;
use Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions\PersonalDataNotFoundException;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Persistence\Eloquent\PersonalDataModel;
use Illuminate\Support\Facades\Log;

final class EloquentPersonalDataRepository implements PersonalDataRepositoryInterface
{


    public function __construct(protected PersonalDataModel $model) {}

    public function save(PersonalData $entity): PersonalData
    {
        $model = $entity->getId()
            ? PersonalDataModel::findOrFail($entity->getId())
            : new PersonalDataModel();

        $data = $entity->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);

        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): PersonalData
    {
        $model = PersonalDataModel::find($id);

        if (!$model) {
            throw new PersonalDataNotFoundException($id);
        }

        return $this->mapToFullEntity($model);
    }

    public function delete(PersonalData $entity): void
    {
        if (!$entity->getId()) {
            throw new PersonalDataNotFoundException(0);
        }

        PersonalDataModel::destroy($entity->getId());
    }

    public function all(int $perPage, int $active, int $page = 1): array
    {
        $paginator = PersonalDataModel::where('activo', $active)
            ->paginate($perPage, ['*'], 'page', $page);

        $paginator->getCollection()->transform(fn($model) => $this->mapToEntity($model));

        return $paginator->toArray();
    }

    public function exists(int $id): bool
    {
        return PersonalDataModel::where('id', $id)->exists();
    }

    private function mapToEntity(PersonalDataModel $model): PersonalData
    {

        return new PersonalData(
            id: $model->id,
            name: $model->name,
            lastName: $model->lastName,
            email: $model->email,
        );
    }

    private function mapToFullEntity(PersonalDataModel $model): PersonalData
    {
        return new PersonalData(
            id: $model->id,
            actualContract: $model->actualContract,
            dateContractFinish: $model->dateContractFinish ? $model->dateContractFinish->format('Y-m-d') : null,
            name: $model->name,
            lastName: $model->lastName,
            activo: $model->activo,
            idCheck: $model->id_check ? $model->id_check->format('Y-m-d') : null,
            direction: $model->direction,
            cp: $model->cp,
            phone: $model->phone,
            birthday: $model->birthday ? $model->birthday->format('Y-m-d') : null,
            rfc: $model->rfc,
            curp: $model->curp,
            nss: $model->nss,
            school: $model->school,
            ine: $model->ine,
            alergist: $model->alergist,
            personalContact: $model->personalContact,
            phoneContact: $model->phoneContact,
            empresa: $model->empresa,
            ingreso: $model->ingreso ? $model->ingreso->format('Y-m-d') : null,
            idEmpleado: $model->id_empleado,
            idJefeInmediato: $model->id_jefe_inmediato,
            idDepartamento: $model->id_departamento,
            idPuesto: $model->id_puesto,
            inmBoss: $model->inmBoss,
            wArea: $model->wArea,
            infonavit: $model->infonavit,
            numCart: $model->numCart,
            company: $model->company,
            idLicNum: $model->idLicNum,
            documents: $model->documents,
            contracts: $model->contracts,
            documentsCompany: $model->documentsCompany,
            removeColaborator: $model->removeColaborator,
            img: $model->img,
            numExt: $model->numExt,
            utalla: $model->utalla,
            numCarttwo: $model->numCarttwo,
            email: $model->email,
            emailCompany: $model->emailCompany,
            checkCode: $model->checkCode,
            extTel: $model->ext_tel,
            createdBy: $model->created_by,
            updatedBy: $model->updated_by,
            createdAt: $model->created_at ? \DateTimeImmutable::createFromMutable($model->created_at) : null,
            updatedAt: $model->updated_at ? \DateTimeImmutable::createFromMutable($model->updated_at) : null,
            departamento: $model->departamento,
            puestoRel: $model->puestoRel,
            puesto: $model->getAttributeValue('puesto'),
        );
    }

    public function search(string $search): array
    {
        $personalData = PersonalDataModel::where('name', 'like', "%{$search}%")
            ->orWhere('lastName', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();

        $personalData->transform(fn($model) => $this->mapToEntity($model));

        return $personalData->toArray();
    }

    public function activos(): array
    {
        return $this->model->activos()
            ->with(['departamento', 'puestoRel'])
            ->get()
            ->toArray();
    }
}
