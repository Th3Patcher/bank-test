<?php

namespace App\Enums\Transactions;

enum StatusEnums: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'fail';
}
