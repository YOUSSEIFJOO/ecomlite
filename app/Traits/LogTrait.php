<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    /**
     * Log Exception Error
     *
     * @param $message
     * @param $e
     * @return void
     */
    public function logExceptionError($message, $e): void
    {
        Log::error($message, [
            'exception' => [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'track_as_string' => $e->getTraceAsString()
            ],
        ]);
    }

    /**
     * Log Exception Error with data
     *
     * @param $message
     * @param $e
     * @param array $data
     * @return void
     */
    public function logExceptionErrorWithData($message, $e, array $data = []): void
    {
        Log::error($message, [
            'exception' => [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'track_as_string' => $e->getTraceAsString()
            ],
            'data' => $data
        ]);
    }


    /**
     * Log Exception Error
     *
     * @param $message
     * @param array $data
     * @return void
     */
    public function logErrorWithData($message, array $data = []): void
    {
        Log::error($message, [
            'data' => $data
        ]);
    }
}
