<?php

namespace App\Http\Controllers;

use App\Actions\Account\IndexAccount;
use App\Actions\Account\StoreAccount;
use App\Http\Requests\AccountRequests\StoreRequest;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    /**
     * Get list of accounts
     *
     * @param IndexAccount $action
     * @return JsonResponse
     */
    public function index(IndexAccount $action): JsonResponse
    {
        return $action->handle();
    }

    /**
     * Create new account
     *
     * @param StoreRequest $request
     * @param StoreAccount $action
     * @return JsonResponse
     */
    public function store(StoreRequest $request, StoreAccount $action): JsonResponse
    {
        return $action->handle($request->get('currency'));
    }
}
