<?php

namespace App\Jobs;

use App\Enums\Transactions\StatusEnums;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\Currency\CurrencyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly int $transactionId
    ) {}

    public function handle(CurrencyService $currencyService): void
    {
        $transaction = Transaction::where('id', $this->transactionId)->lockForUpdate()->firstOrFail();

        if ($transaction->status !== StatusEnums::PENDING) {
            return;
        }

        $amount = $transaction->amount;
        $from = Account::where('id', $transaction->from_account_id)->lockForUpdate()->firstOrFail();
        $to = Account::where('id', $transaction->to_account_id)->lockForUpdate()->firstOrFail();

        if ($from->balance < $amount) {
            $transaction->update([
                'status' => StatusEnums::FAILED,
            ]);
        }

        $convertedAmount = $currencyService->convert(
            $from->currency,
            $to->currency,
            $amount
        );

        DB::transaction(function () use ($to, $from, $convertedAmount, $amount, $transaction) {
            $from->balance -= $amount;
            $to->balance += $convertedAmount;

            $from->save();
            $to->save();

            $transaction->update([
                'status' => StatusEnums::COMPLETED,
            ]);
        });
    }
}
