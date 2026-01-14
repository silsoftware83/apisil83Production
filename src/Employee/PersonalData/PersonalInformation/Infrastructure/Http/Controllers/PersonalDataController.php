<?php

namespace Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\ListPersonalDataUseCase;
use Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions\PersonalDataNotFoundException;
use Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions\PersonalDataValidationException;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Requests\CreatePersonalDataRequest;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Requests\UpdatePersonalDataRequest;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\CreatePersonalDataUseCase;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\UpdatePersonalDataUseCase;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\DeletePersonalDataUseCase;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Requests\ListPersonalDataRequest;

use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\SearchPersonalDataUseCase;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Requests\SearchPersonalDataRequest;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\FindByIdPersonalDataUseCase;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\GetImmeditedBossAndDepartmentsUseCase;
use Src\Employee\PersonalData\PersonalInformation\Application\UseCases\DesactivatePersonalDataUseCase;

final class PersonalDataController
{

    public function index(ListPersonalDataRequest $request, ListPersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $dto = $request->toDTO();
            $response = $useCase->execute($dto);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve list',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function search(SearchPersonalDataRequest $request, SearchPersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $dto = $request->toDTO();
            $response = $useCase->execute($dto);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve list',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CreatePersonalDataRequest $request, CreatePersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());

            return response()->json([
                'data' => $response->toArray(),
                'message' => 'PersonalData created successfully'
            ], 201);
        } catch (PersonalDataValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create PersonalData',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(int $id, FindByIdPersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($id);

            return response()->json([
                'data' => $response->toArray(),
                'message' => 'PersonalData retrieved successfully'
            ], 200);
        } catch (PersonalDataNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, UpdatePersonalDataRequest $request, UpdatePersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());

            return response()->json([
                'data' => $response->toArray(),
                'message' => 'PersonalData updated successfully'
            ]);
        } catch (PersonalDataNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (PersonalDataValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update PersonalData',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, DeletePersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);

            return response()->json([
                'message' => 'PersonalData deleted successfully'
            ], 204);
        } catch (PersonalDataNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete PersonalData',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function desactivate(int $id, DesactivatePersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);

            return response()->json([
                'message' => 'PersonalData desactivated successfully'
            ], 200);
        } catch (PersonalDataNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to desactivate PersonalData',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function getImmeditedBossAndDepartments(GetImmeditedBossAndDepartmentsUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute();

            return response()->json([
                'data' => $response,
                'message' => 'PersonalData retrieved successfully'
            ], 200);
        } catch (PersonalDataNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (PersonalDataValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve PersonalData',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
