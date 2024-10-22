<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Custom Paginated Response
     *
     * @param mixed $data
     * @return JsonResponse
     */
    public function paginatedResponse(mixed $data): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $data->items(),
            'meta' => [
                'total'        => $data->total(),
                'per_page'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'next_page_url'=> $data->nextPageUrl(),
                'prev_page_url'=> $data->previousPageUrl(),
            ]
        ]);
    }

    /**
     * Cursor Paginated Response
     *
     * @param mixed $data
     * @return JsonResponse
     */
    public function cursorPaginationResponse(mixed $data): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $data,
            'meta' => [
                'next_cursor' => $data->nextCursor(),
                'prev_cursor' => $data->previousCursor(),
                'total_items' => $data->count()
            ]
        ]);
    }

    /**
     * Success Response
     *
     * @param mixed $data
     * @return JsonResponse
     */
    public function successResponse(array $data): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $data,
        ]);
    }

    /**
     * Server Error Response
     *
     * @return JsonResponse
     */
    public function serverErrorResponse(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => 'Server Error',
            'data' => [],
        ], 500);
    }

    /**
     * Unauthorized Response
     *
     * @param $message
     * @return JsonResponse
     */
    public function UnAuthorizedResponse($message): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => [],
        ], 403);
    }

    /**
     * Server Error Response
     *
     * @return JsonResponse
     */
    public function canNotAccessResponse(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => 'You can not access the api',
            'data' => [],
        ], 403);
    }
}
