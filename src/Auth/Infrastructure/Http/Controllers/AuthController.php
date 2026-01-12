<?php

namespace Src\Auth\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Auth\Infrastructure\Http\Requests\LoginRequest;
use Src\Auth\Application\UseCases\LoginUseCase;
use Src\Auth\Application\UseCases\LogoutUseCase;
use Src\Auth\Application\UseCases\GetAuthenticatedUserUseCase;
use Src\Auth\Domain\Exceptions\InvalidCredentialsException;
use Src\Auth\Domain\Exceptions\UserNotFoundException;
use Src\Auth\Domain\Exceptions\AuthenticationException;
use Illuminate\Http\Request;

final class AuthController
{
    public function login(LoginRequest $request, LoginUseCase $useCase): JsonResponse
    {
        try {

            $response = $useCase->execute($request->toDTO());

            return response()->json([
                'success' => true,
                'data' => $response->toArray(),
                'message' => 'Login successful'
            ], 200);
        } catch (InvalidCredentialsException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid credentials',
                'message' => $e->getMessage()
            ], 401);
        } catch (AuthenticationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Authentication failed',
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Login failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request, LogoutUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($request->user());

            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Logout failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function me(Request $request, GetAuthenticatedUserUseCase $useCase): JsonResponse
    {
        try {
            $response = $useCase->execute($request->user());

            return response()->json([
                'success' => true,
                'data' => $response->toArray(),
                'message' => 'User retrieved successfully'
            ], 200);
        } catch (UserNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'User not found',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve user',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
