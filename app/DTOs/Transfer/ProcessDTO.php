<?php

namespace App\DTOs\Transfer;

readonly class ProcessDTO
{
    /**
     * @param string $sender
     * @param string $getter
     * @param float $amount
     */
    public function __construct(
        public string $sender,
        public string $getter,
        public float  $amount,
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
