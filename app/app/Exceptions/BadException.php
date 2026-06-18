<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BadException extends Exception
{
    public function __construct(
        string $message = 'Application error',
        public int $status = 400,
        public ?array $data = null
    ) {
        parent::__construct($message);
    }

    public function render($request): JsonResponse
    {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }
        return response()->json([
            'message' => $this->message,
            'code' => $this->status,
            'data' => $this->data,
        ], $this->status);
    }
}
