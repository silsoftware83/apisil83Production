<?php

namespace Src\Employee\Directory\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Employee\Directory\Application\UseCases\ListDirectoryUseCase;
use Src\Employee\Directory\Application\DTOs\ListDirectoryDTO;
use Src\Employee\Directory\Domain\Exceptions\DirectoryNotFoundException;
use Src\Employee\Directory\Domain\Exceptions\DirectoryValidationException;
use Src\Employee\Directory\Infrastructure\Http\Requests\CreateDirectoryRequest;
use Src\Employee\Directory\Infrastructure\Http\Requests\UpdateDirectoryRequest;
use Src\Employee\Directory\Application\UseCases\CreateDirectoryUseCase;
use Src\Employee\Directory\Application\UseCases\UpdateDirectoryUseCase;
use Src\Employee\Directory\Application\UseCases\DeleteDirectoryUseCase;

final class DirectoryController
{
    public function index(ListDirectoryUseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new ListDirectoryDTO());
            
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

    public function store(CreateDirectoryRequest $request, CreateDirectoryUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => 'Directory created successfully'
            ], 201);
        } catch (DirectoryValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create Directory',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id, ListDirectoryUseCase $useCase): JsonResponse
    {
        try {
            // TODO: Implement GetDirectoryUseCase for single item
            return response()->json([
                'message' => 'Not implemented yet'
            ], 501);
        } catch (DirectoryNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, UpdateDirectoryRequest $request, UpdateDirectoryUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => 'Directory updated successfully'
            ]);
        } catch (DirectoryNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (DirectoryValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update Directory',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, DeleteDirectoryUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);
            
            return response()->json([
                'message' => 'Directory deleted successfully'
            ], 204);
        } catch (DirectoryNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete Directory',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
