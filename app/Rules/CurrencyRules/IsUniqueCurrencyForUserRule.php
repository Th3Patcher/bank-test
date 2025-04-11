<?php

namespace App\Rules\CurrencyRules;

use App\Models\Account;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class IsUniqueCurrencyForUserRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exist = Account::query()
            ->where('user_id', Auth::user()->id)
            ->where('currency', $value)
            ->exists();

        if ($exist) {
            $fail('Currency \''.strtoupper($value).'\' already exists.');
        }
    }
}
