<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateRequest;
use App\Http\Resources\Orders\CreateResource;
use App\Http\Resources\Orders\ShowResource;
use App\Models\Order;
use App\Services\OrderService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    #[OA\Post(
        path: "/api/orders",
        summary: "Store details of an order",
        security: [[
            "bearerAuth" => []
        ]],
        tags: ["Orders"]
    )]
    #[OA\RequestBody(
        description: "Order data",
        required: true,
        content: new OA\JsonContent(
            required: ["products"],
            properties: [
                new OA\Property(
                    property: "secret_api_key",
                    description: "The secret api key",
                    type: "string",
                ),
                new OA\Property(
                    property: "products",
                    type: "array",
                    items: new OA\Items(
                        required: ["id", "quantity"],
                        properties: [
                            new OA\Property(
                                property: "id",
                                description: "Product ID",
                                type: "string",
                                format: "uuid"
                            ),
                            new OA\Property(
                                property: "quantity",
                                description: 2,
                                type: "integer"
                            )
                        ],
                        type: "object"
                    )
                )
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "The details of stored order",
        content: new OA\JsonContent(
            example: [
                "status" => true,
                "message" => "Success",
                "data" => [
                    "order_id" => "9073ce10-8f19-11ef-a061-5b53d1e59c8b"
                ]
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
                    "products" => [
                        "The products field is required"
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
    public function store(CreateRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $result = $this->orderService->save($request->validated());
            DB::commit();
            return $this->successResponse(CreateResource::make($result));
        } catch (Exception $e) {
            DB::rollBack();
            $this->logExceptionErrorWithData(__('Error happened while creating an order'), $e, $request->validated());
            return $this->serverErrorResponse();
        }
    }

    #[OA\Get(
        path: "/api/orders/{id}",
        summary: "Retrieve details of an order",
        security: [[
            "bearerAuth" => []
        ]],
        tags: ["Orders"]
    )]
    #[OA\QueryParameter(
        name: "secret_api_key",
        description: "The secret api key",
        in: "query",
        required: true,
        schema: new OA\Schema(
            type: "string",
            example: "The secret api key"
        )
    )]
    #[OA\QueryParameter(
        name: "id",
        description: "The id of the order",
        in: "query",
        required: true,
        schema: new OA\Schema(
            type: "string",
            format: "uuid",
            example: "a6f10f30-909e-11ef-8061-172d99c0bf7d"
        )
    )]
    #[OA\Response(
        response: 200,
        description: "The details of an order",
        content: new OA\JsonContent(
            example: [
                "status" => true,
                "message" => "Success",
                "data" => [
                    "id" => "9073ce10-8f19-11ef-a061-5b53d1e59c8b",
                    "user" => [
                        "id" => "9073ce10-8f19-11ef-a061-5b53d1e59c8b",
                        "name" => "Test User"
                    ],
                    "total_price" => 199.99,
                    "stock" => 20,
                    "products" => [
                        [
                            "id" => "550e8400-e29b-41d4-a716-446655440000",
                            "name" => "Electronics",
                            "quantity" => 5
                        ]
                    ]
                ]
            ]
        )
    )]
    #[OA\Response(
        response: 401,
        description: "unauthorized",
        content: new OA\JsonContent(
            example: [
                "status" => false,
                "message" => "unauthorized"
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
    public function show(Order $order): JsonResponse
    {
        try {
            $order->loadMissing(['user:id,name', 'products:id,name,quantity']);
            return $this->successResponse(ShowResource::make($order));
        } catch (Exception $e) {
            $this->logExceptionErrorWithData(__('Error happened while reading details of an order'), $e);
            return $this->serverErrorResponse();
        }
    }
}
