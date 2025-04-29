<?php

namespace App\Models;

use App\Enums\Transactions\StatusEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $from_account_id
 * @property int $to_account_id
 * @property float $amount
 * @property StatusEnums $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|Transaction newModelQuery()
 * @method static Builder<static>|Transaction newQuery()
 * @method static Builder<static>|Transaction query()
 * @method static Builder<static>|Transaction whereAmount($value)
 * @method static Builder<static>|Transaction whereCreatedAt($value)
 * @method static Builder<static>|Transaction whereFromAccountId($value)
 * @method static Builder<static>|Transaction whereId($value)
 * @method static Builder<static>|Transaction whereStatus($value)
 * @method static Builder<static>|Transaction whereToAccountId($value)
 * @method static Builder<static>|Transaction whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'from_account_id' => 'int',
        'to_account_id' => 'int',
        'amount' => 'float',
        'status' => StatusEnums::class,
    ];
}
