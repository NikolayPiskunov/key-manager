<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Main\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    protected function sendSuccess(array $data = []): JsonResponse
    {
        return ApiResponse::success($data);
    }

    protected function sendError(string $message = 'Unknown Error', int $code = 400): JsonResponse
    {
        return ApiResponse::error($message, $code);
    }
}
