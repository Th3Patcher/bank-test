<?php

namespace App\Services\Currency;

use App\Services\ExternalApi\CurrencyApi;
use Illuminate\Support\Facades\Cache;

readonly class CurrencyService
{
    /**
     * @param CurrencyApi $currencyApi
     */
    public function __construct(
        private CurrencyApi $currencyApi,
    ) {}

    /**
     * @return array|null
     */
    public function getListOfCurrencies(): ?array
    {
        // Update once per hour
        return Cache::remember('currencies', 3600, function () {
            return $this->currencyApi->get();
        });
    }

    /**
     * @param string $from
     * @param string $to
     * @param float $amount
     * @return float
     */
    public function convert(string $from, string $to, float $amount): float
    {
        if ($from === $to) {
            return $amount;
        }

        return Cache::remember($from.'_'.$to, 60, function () use ($from, $to) {
            return $this->getCurrencyByCode($from)[$from][$to];
        });
    }

    /**
     * @param string $code
     * @return array|null
     */
    public function getCurrencyByCode(string $code): ?array
    {
        return $this->currencyApi->get($code);
    }
}
