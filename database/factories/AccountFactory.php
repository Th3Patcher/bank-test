<?php

namespace Database\Factories;

use App\Models\User;
use App\Services\Currency\CurrencyService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws BindingResolutionException
     */
    public function definition(): array
    {
        $currency = 'EUR';
        $currencies = app()->make(CurrencyService::class)->getListOfCurrencies();

        if (! is_null($currencies)) {
            $currency = array_keys($currencies)[mt_rand(0, count($currencies) - 1)];
        }

        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'number' => Str::of(Str::random(5).(mt_rand(10, 100) ** mt_rand(3, 8)))->upper()->take(15)->value(),
            'balance' => $this->faker->randomFloat(2, 1, 1000),
            'currency' => $currency,
        ];
    }
}
