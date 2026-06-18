<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
class UnauthorizedException extends Exception
{
    public function __construct(
        string $message = 'Application error',
        public int $status = 401,
        public ?array $data = null
    ) {
        parent::__construct($message);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'code' => $this->status,
            'data' => $this->data,
        ], $this->status);
    }
}
