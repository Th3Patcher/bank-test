<?php

namespace App\Services\ExternalApi;

use Illuminate\Support\Facades\Http;

class CurrencyApi
{
    private const array POSTFIX = [
        '.min.json',
        '.json',
    ];

    /**
     * Get data from the first url that works otherwise get null
     *
     * @param string|null $currency
     * @return array|null
     */
    public function get(?string $currency = null): ?array
    {
        foreach (config('currency.api') as $link) {
            foreach (self::POSTFIX as $postfix) {
                $url = $currency ? $link.'/'.$currency.$postfix : $link.$postfix;
                $result = Http::get($url)->json();

                if (! is_null($result)) {
                    return $result;
                }
            }
        }

        return null;
    }
}
