<?php

namespace App\Http\Requests\TransferRequests;

use App\Repositories\AccountRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TransferRequest extends FormRequest
{
    /**
     * @param Request $request
     * @param AccountRepository $repository
     * @return bool
     */
    public function authorize(Request $request, AccountRepository $repository): bool
    {
        return $repository->isOwner($request->user(), $request->get('sender'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sender' => ['required', 'string', 'exists:accounts,number'],
            'getter' => ['required', 'string', 'exists:accounts,number'],
            'amount' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
