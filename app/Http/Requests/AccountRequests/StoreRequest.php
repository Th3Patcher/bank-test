<?php

namespace App\Http\Requests\AccountRequests;

use App\Rules\CurrencyRules\IsExistCurrencyRule;
use App\Rules\CurrencyRules\IsUniqueCurrencyForUserRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currency' => ['required', 'string', new IsExistCurrencyRule, new IsUniqueCurrencyForUserRule],
        ];
    }

    /**
     * Made inputted currency in lowercase 'cause this one in api
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'currency' => strtolower($this->input('currency')),
        ]);
    }
}
