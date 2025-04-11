<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class DomainException extends Exception
{
    /**
     * @param $message
     * @param int $statusCode
     * @param string $type
     */
    public function __construct(
        protected $message = 'Error',
        protected int $statusCode = 401,
        protected string $type = 'default'
    ) {
        parent::__construct($message);
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => [
                'type' => $this->type,
                'message' => $this->message,
            ],
        ], $this->statusCode);
    }
}
