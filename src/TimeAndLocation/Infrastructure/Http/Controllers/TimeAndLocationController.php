<?php

namespace Src\TimeAndLocation\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\TimeAndLocation\Application\UseCases\ListTimeAndLocationUseCase;
use Src\TimeAndLocation\Application\DTOs\ListTimeAndLocationDTO;
use Src\TimeAndLocation\Domain\Exceptions\TimeAndLocationNotFoundException;
use Src\TimeAndLocation\Domain\Exceptions\TimeAndLocationValidationException;
use Src\TimeAndLocation\Infrastructure\Http\Requests\CreateTimeAndLocationRequest;
use Src\TimeAndLocation\Infrastructure\Http\Requests\UpdateTimeAndLocationRequest;
use Src\TimeAndLocation\Application\UseCases\CreateTimeAndLocationUseCase;
use Src\TimeAndLocation\Application\UseCases\UpdateTimeAndLocationUseCase;
use Src\TimeAndLocation\Application\UseCases\DeleteTimeAndLocationUseCase;

final class TimeAndLocationController
{
    public function index(ListTimeAndLocationUseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new ListTimeAndLocationDTO());

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

    public function store(CreateTimeAndLocationRequest $request, CreateTimeAndLocationUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());

            return response()->json([
                'data' => $response->toArray(),
                'message' => 'TimeAndLocation created successfully'
            ], 201);
        } catch (TimeAndLocationValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create TimeAndLocation',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id, ListTimeAndLocationUseCase $useCase): JsonResponse
    {
        try {
            $data = $useCase->execute(new ListTimeAndLocationDTO($id));

            return response()->json([
                'data' => $data,
                'message' => 'TimeAndLocation retrieved successfully'
            ]);
        } catch (TimeAndLocationNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, UpdateTimeAndLocationRequest $request, UpdateTimeAndLocationUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->toDTO());

            return response()->json([
                'data' => $response->toArray(),
                'message' => 'TimeAndLocation updated successfully'
            ]);
        } catch (TimeAndLocationNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (TimeAndLocationValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update TimeAndLocation',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, DeleteTimeAndLocationUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id);

            return response()->json([
                'message' => 'TimeAndLocation deleted successfully'
            ], 204);
        } catch (TimeAndLocationNotFoundException $e) {
            return response()->json([
                'error' => 'Not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete TimeAndLocation',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
