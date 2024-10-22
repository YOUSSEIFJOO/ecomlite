<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    #[OA\Post(
        path: "/api/auth/login",
        summary: "User Login",
        tags: ["Auth"]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: "secret_api_key",
                    type: "string",
                    example: "The secret api key"
                ),
                new OA\Property(
                    property: "email",
                    type: "string",
                    example: "user@example.com"
                ),
                new OA\Property(
                    property: "password",
                    type: "string",
                    example: "your_password"
                )
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Successful login",
        content: new OA\JsonContent(
            example: [
                "status" => true,
                "message" => "Success",
                "data" => [
                    "token" => "the_token",
                    "user" => [
                        "id" => "550e8400-e29b-41d4-a716-446655440000",
                        "name" => "John Doe",
                        "email" => "user@example.com"
                    ]
                ]
            ]
        )
    )]
    #[OA\Response(
        response: 401,
        description: "Unauthorized",
        content: new OA\JsonContent(
            example: [
                "status" => false,
                "message" => "Unauthorized"
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: "Validation Errors",
        content: new OA\JsonContent(
            example: [
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [
                        "The email field is required"
                    ]
                ]
            ]
        )
    )]
    #[OA\Response(
        response: 500,
        description: "Server Error",
        content: new OA\JsonContent(
            example: [
                "status" => false,
                "message" => "Server Error",
                "data" => []
            ]
        )
    )]
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->login($request->validated());
            return $this->successResponse($data);
        } catch (Exception $e) {
            $this->logExceptionErrorWithData(__('auth.error_login'), $e, $request->validated());
            return $this->serverErrorResponse();
        }
    }
}
