<?php

namespace App\Services\Transfer;

use App\Jobs\ProcessTransactionJob;
use App\Models\Account;
use App\Models\Transaction;

class TransferService
{
    public function transfer(string $fromNumber, string $toNumber, float $amount): Transaction
    {
        $transaction = Transaction::create([
            'from_account_id' => Account::firstWhere('number', $fromNumber)->id,
            'to_account_id' => Account::firstWhere('number', $toNumber)->id,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        ProcessTransactionJob::dispatch($transaction->id);

        return $transaction;
    }
}
