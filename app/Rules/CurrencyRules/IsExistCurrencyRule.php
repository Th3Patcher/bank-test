<?php

namespace App\Rules\CurrencyRules;

use App\Services\Currency\CurrencyService;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class IsExistCurrencyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *
     * @throws BindingResolutionException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currencies = app()->make(CurrencyService::class)->getListOfCurrencies();

        if (is_null($currencies)) {
            $fail('Creating an account is not available right now. Please try again later.');
        }

        if (! array_key_exists(Str::lower($value), $currencies)) {
            $fail("The selected $attribute is not a valid currency.");
        }
    }
}
