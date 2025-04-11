<?php

namespace App\Http\Controllers;

use App\Actions\Transfer\ProcessTransfer;
use App\DTOs\Transfer\ProcessDTO;
use App\Exceptions\DomainException;
use App\Http\Requests\TransferRequests\TransferRequest;
use Illuminate\Http\JsonResponse;

class TransferController extends Controller
{
    /**
     * Process transfer from one account to another
     *
     * @param TransferRequest $request
     * @param ProcessTransfer $action
     * @return JsonResponse
     * @throws DomainException
     */
    public function __invoke(TransferRequest $request, ProcessTransfer $action): JsonResponse
    {
        return $action->handle(ProcessDTO::fromArray($request->validated()));
    }
}
