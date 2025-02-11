<?php

namespace App\Http\Controllers\Api;

use App\Modules\Key\Actions\ShowKeyAction;
use Illuminate\Http\JsonResponse;

final class KeyController extends ApiController
{
    public function __construct(
        private readonly ShowKeyAction $showKeyAction,
    )
    {
        //
    }

    public function index(string $key): JsonResponse
    {
        try {
            $keyData = ($this->showKeyAction)($key);
        } catch (\Throwable $exception) {
            return $this->sendError('Not Found', 404);
        }

        return $this->sendSuccess($keyData);
    }
}
