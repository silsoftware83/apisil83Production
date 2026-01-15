<?php

namespace Src\Configuration\Security\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Configuration\Security\Application\UseCases\ListSecurityUseCase;
use Src\Configuration\Security\Application\DTOs\ListSecurityDTO;
use Src\Configuration\Security\Infrastructure\Http\Requests\CreateSecurityRequest;
use Src\Configuration\Security\Infrastructure\Http\Requests\UpdateSecurityRequest;
use Src\Configuration\Security\Application\UseCases\CreateSecurityUseCase;
use Src\Configuration\Security\Application\UseCases\DeleteSecurityUseCase;
use Src\Configuration\Security\Infrastructure\Http\Requests\AddUserRequest;
use Src\Configuration\Security\Application\UseCases\AddUserUseCase;
use Src\Configuration\Security\Infrastructure\Http\Requests\GetEmployeeWhitOutUserRequest;
use Src\Configuration\Security\Application\UseCases\GetEmployeeWhitOutUserUseCase;
use Src\Configuration\Security\Infrastructure\Http\Requests\GetPermissionRequest;
use Src\Configuration\Security\Application\UseCases\GetPermisionsUseCase;
use Src\Configuration\Security\Infrastructure\Http\Requests\ShowPermisionRequest;
use Src\Configuration\Security\Application\UseCases\ShowPasswordUseCase;
use Src\Configuration\Security\Infrastructure\Http\Requests\RestorePasswordRequest;
use Src\Configuration\Security\Application\UseCases\RestorePasswordUseCase;

final class SecurityController
{
    public function index(ListSecurityUseCase $useCase): JsonResponse
    {
        try {
            return response()->json(
                $useCase->execute(new ListSecurityDTO())
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al listar los registros',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(GetPermissionRequest $request, GetPermisionsUseCase $useCase): JsonResponse
    {
        try {
            return response()->json(
                $useCase->execute($request->toDTO())
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al listar los registros',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CreateSecurityRequest $request, CreateSecurityUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($request->toDTO());
            return response()->json([], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to store permissions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(CreateSecurityRequest $request, CreateSecurityUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($request->toDTO());
            return response()->json([]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update permissions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, DeleteSecurityUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);
            return response()->json([], 244);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete Security',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function gestionpermissions(CreateSecurityRequest $request, CreateSecurityUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($request->toDTO());
            return response()->json([], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to manage permissions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function showPassword(ShowPermisionRequest $request, ShowPasswordUseCase $useCase): JsonResponse
    {
        try {
            return response()->json(
                $useCase->execute($request->toDTO())
            );
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al mostrar la contraseña',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function showPasswordRestore(RestorePasswordRequest $request, RestorePasswordUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($request->toDTO());
            return response()->json(['success' => true, 'message' => 'Restauración exitosa'], 200);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al restaurar la contraseña',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function getEmployeeWhitOutUser(GetEmployeeWhitOutUserRequest $request, GetEmployeeWhitOutUserUseCase $useCase): JsonResponse
    {
        try {
            return response()->json(
                $useCase->execute($request->toDTO())
            );
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al listar los registros',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function addUser(AddUserRequest $request, AddUserUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($request->toDTO());
            return response()->json(['success' => true, 'message' => 'Creación exitosa'], 201);
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario',
                'errors' => $th->getMessage()
            ], 500);
        }
    }
}
