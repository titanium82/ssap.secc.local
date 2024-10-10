<?php

namespace App\Admin\Enums\Contract;

use App\Core\Supports\Enum;

enum ContractPaymentStatus: int
{
    use Enum;

    case Unpaid = 10;

    case Paid = 20;
    
    case Late = 30;

    public function badge()
    {
        return match($this)
        {
            ContractPaymentStatus::Unpaid => 'bg-yellow',
            ContractPaymentStatus::Paid => 'bg-green',
            ContractPaymentStatus::Late => 'bg-red',
            default => ''
        };
    }
}
