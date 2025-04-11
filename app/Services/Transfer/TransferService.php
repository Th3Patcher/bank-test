<?php

namespace App\Services\Transfer;

use App\DTOs\Transfer\ResultDTO;
use App\Exceptions\DomainException;
use App\Models\Account;
use App\Services\Currency\CurrencyService;
use Illuminate\Support\Facades\DB;

class TransferService
{
    /**
     * @param string $fromNumber
     * @param string $toNumber
     * @param float $amount
     * @return ResultDTO
     */
    public function transfer(string $fromNumber, string $toNumber, float $amount): ResultDTO
    {
        return DB::transaction(function () use ($fromNumber, $toNumber, $amount) {
            $from = Account::where('number', $fromNumber)->lockForUpdate()->firstOrFail();
            $to = Account::where('number', $toNumber)->lockForUpdate()->firstOrFail();

            if ($from->balance < $amount) {
                throw new DomainException('Not enough balance', 400, 'transfer');
            }

            $convertedAmount = app()->make(CurrencyService::class)->convert($from->currency, $to->currency, $amount);

            $from->balance -= $amount;
            $to->balance += $convertedAmount;

            $from->save();
            $to->save();

            return new ResultDTO($from, $to, round($convertedAmount, 2));
        });
    }
}
