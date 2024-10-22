<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ListRequest;
use App\Http\Resources\Products\ListResource;
use App\Services\ListingProductsService;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{
    protected ListingProductsService $productService;

    public function __construct(ListingProductsService $productService)
    {
        $this->productService = $productService;
    }

    #[OA\Get(
        path: "/api/products",
        summary: "Retrieve a list of products",
        security: [[
            "bearerAuth" => []
        ]],
        tags: ["Products"]
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
        name: "per_page",
        description: "Number of items per page",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "integer",
            maximum: 100,
            minimum: 1,
            example: 10
        )
    )]
    #[OA\QueryParameter(
        name: "page",
        description: "Page number",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "integer",
            minimum: 1,
            example: 1
        )
    )]
    #[OA\QueryParameter(
        name: "name",
        description: "Product name",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "string",
            maxLength: 255,
            example: "Product Name"
        )
    )]
    #[OA\QueryParameter(
        name: "min_price",
        description: "Minimum price",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "string",
            pattern: "^\d{1,8}(\.\d{1,2})?$",
            example: "10.00"
        )
    )]
    #[OA\QueryParameter(
        name: "max_price",
        description: "Maximum price",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "string",
            pattern: "^\d{1,8}(\.\d{1,2})?$",
            example: "100.00"
        )
    )]
    #[OA\QueryParameter(
        name: "category_id",
        description: "Category ID",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "string",
            format: "uuid",
            example: "550e8400-e29b-41d4-a716-446655440000"
        )
    )]
    #[OA\Response(
        response: 200,
        description: "A list of products",
        content: new OA\JsonContent(
            example: [
                "status" => true,
                "message" => "Success",
                "data" => [
                    [
                        "id" => "9073ce10-8f19-11ef-a061-5b53d1e59c8b",
                        "name" => "Apple iPhone 13 Pro",
                        "price" => 19.99,
                        "stock" => 20,
                        "category" => [
                            "id" => "550e8400-e29b-41d4-a716-446655440000",
                            "name" => "Electronics"
                        ]
                    ]
                ],
                "meta" => [
                    "next_cursor" => "eyJpZCI6M30",
                    "prev_cursor" => null,
                    "total_items" => 100
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
        response: 422,
        description: "Validation Errors",
        content: new OA\JsonContent(
            example: [
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => [
                        "The name format not valid"
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
    public function index(ListRequest $request): JsonResponse
    {
        try {
            $result = $this->productService->getProductsWithPagination($request->validated());
            return $this->cursorPaginationResponse(
                $result->through(function ($product) {
                    return ListResource::make($product);
                })
            );
        } catch (Exception $e) {
            $this->logExceptionErrorWithData(__('products.error_listing_products'), $e, $request->validated());
            return $this->serverErrorResponse();
        }
    }
}
