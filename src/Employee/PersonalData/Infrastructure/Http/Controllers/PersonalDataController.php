<?php

namespace Src\Employee\PersonalData\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Employee\PersonalData\Application\UseCases\ListPersonalDataUseCase;
use Src\Employee\PersonalData\Application\DTOs\ListPersonalDataDTO;
use Src\Employee\PersonalData\Domain\Exceptions\PersonalDataNotFoundException;
use Src\Employee\PersonalData\Domain\Exceptions\PersonalDataValidationException;
use Src\Employee\PersonalData\Infrastructure\Http\Requests\CreatePersonalDataRequest;
use Src\Employee\PersonalData\Infrastructure\Http\Requests\UpdatePersonalDataRequest;
use Src\Employee\PersonalData\Application\UseCases\CreatePersonalDataUseCase;
use Src\Employee\PersonalData\Application\UseCases\UpdatePersonalDataUseCase;
use Src\Employee\PersonalData\Application\UseCases\DeletePersonalDataUseCase;

final class PersonalDataController
{
    public function index(ListPersonalDataUseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new ListPersonalDataDTO());
            
            return response()->json([
                'data' => $data,
                'message' => 'List retrieved successfully'
            ]);
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

    public function show(int $id, ListPersonalDataUseCase $useCase): JsonResponse
    {
        try {
            // TODO: Implement GetPersonalDataUseCase for single item
            return response()->json([
                'message' => 'Not implemented yet'
            ], 501);
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

}
