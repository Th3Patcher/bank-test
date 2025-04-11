<?php

namespace App\DTOs\Transfer;

use App\Models\Account;

readonly class ResultDTO
{
    /**
     * @param Account $sender
     * @param Account $getter
     * @param float $amount
     */
    public function __construct(
        public Account $sender,
        public Account $getter,
        public float   $amount,
    ) {}

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['sender'],
            $data['getter'],
            $data['amount'],
        );
    }
}
