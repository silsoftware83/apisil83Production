<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases\ListDepartmentsAndPositionsUseCase;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\ListDepartmentsAndPositionsDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsNotFoundException;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsValidationException;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Requests\CreateDepartmentsAndPositionsRequest;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Requests\UpdateDepartmentsAndPositionsRequest;
use Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases\CreateDepartmentsAndPositionsUseCase;
use Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases\UpdateDepartmentsAndPositionsUseCase;
use Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases\DeleteDepartmentsAndPositionsUseCase;

final class DepartmentsAndPositionsController
{
    public function index(ListDepartmentsAndPositionsUseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new ListDepartmentsAndPositionsDTO());
            
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

    public function store(CreateDepartmentsAndPositionsRequest $request, CreateDepartmentsAndPositionsUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => 'DepartmentsAndPositions created successfully'
            ], 201);
        } catch (DepartmentsAndPositionsValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create DepartmentsAndPositions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id, ListDepartmentsAndPositionsUseCase $useCase): JsonResponse
    {
        try {
            // TODO: Implement GetDepartmentsAndPositionsUseCase for single item
            return response()->json([
                'message' => 'Not implemented yet'
            ], 501);
        } catch (DepartmentsAndPositionsNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, UpdateDepartmentsAndPositionsRequest $request, UpdateDepartmentsAndPositionsUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => 'DepartmentsAndPositions updated successfully'
            ]);
        } catch (DepartmentsAndPositionsNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (DepartmentsAndPositionsValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update DepartmentsAndPositions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, DeleteDepartmentsAndPositionsUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);
            
            return response()->json([
                'message' => 'DepartmentsAndPositions deleted successfully'
            ], 204);
        } catch (DepartmentsAndPositionsNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete DepartmentsAndPositions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
