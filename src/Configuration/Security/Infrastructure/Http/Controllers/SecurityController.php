<?php

namespace Src\Configuration\Security\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Configuration\Security\Application\UseCases\ListSecurityUseCase;
use Src\Configuration\Security\Application\DTOs\ListSecurityDTO;
use Src\Configuration\Security\Domain\Exceptions\SecurityNotFoundException;
use Src\Configuration\Security\Domain\Exceptions\SecurityValidationException;
use Src\Configuration\Security\Infrastructure\Http\Requests\CreateSecurityRequest;
use Src\Configuration\Security\Infrastructure\Http\Requests\UpdateSecurityRequest;
use Src\Configuration\Security\Application\UseCases\CreateSecurityUseCase;
use Src\Configuration\Security\Application\UseCases\UpdateSecurityUseCase;
use Src\Configuration\Security\Application\UseCases\DeleteSecurityUseCase;

final class SecurityController
{
    public function index(ListSecurityUseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new ListSecurityDTO());
            
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

    public function store(CreateSecurityRequest $request, CreateSecurityUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => 'Security created successfully'
            ], 201);
        } catch (SecurityValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create Security',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id, ListSecurityUseCase $useCase): JsonResponse
    {
        try {
            // TODO: Implement GetSecurityUseCase for single item
            return response()->json([
                'message' => 'Not implemented yet'
            ], 501);
        } catch (SecurityNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, UpdateSecurityRequest $request, UpdateSecurityUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());
            
            return response()->json([
                'data' => $response->toArray(),
                'message' => 'Security updated successfully'
            ]);
        } catch (SecurityNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (SecurityValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update Security',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, DeleteSecurityUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);
            
            return response()->json([
                'message' => 'Security deleted successfully'
            ], 204);
        } catch (SecurityNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete Security',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
