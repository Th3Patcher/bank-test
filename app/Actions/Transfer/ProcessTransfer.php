<?php

namespace App\Actions\Transfer;

use App\DTOs\Transfer\ProcessDTO;
use App\Exceptions\AuthExceptions\DomainException;
use App\Services\Transfer\TransferService;
use Illuminate\Http\JsonResponse;

readonly class ProcessTransfer
{
    /**
     * @param TransferService $service
     */
    public function __construct(
        private TransferService $service,
    ) {}

    /**
     * @throws DomainException
     */
    public function handle(ProcessDTO $data): JsonResponse
    {
        if ($data->sender === $data->getter) {
            throw new DomainException('You cannot transfer to the same account', 422, 'transfer');
        }

        $transferData = $this->service->transfer($data->sender, $data->getter, $data->amount);

        return response()->json([
            'message' => "Transfer from '{$transferData->sender->number}' to '{$transferData->getter->number}' has been successfully transferred $transferData->amount {$transferData->getter->currency}",
        ]);
    }
}
