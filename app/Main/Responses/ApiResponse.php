<?php

namespace App\Main\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(array $data = [], array $metadata = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'metadata' => $metadata,
        ], $status);
    }


    public static function error(string $message = '', int $code = 400, array $details = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details
            ],
            'metadata' => [
                'timestamp' => now(),
            ]
        ], $code);
    }
}
