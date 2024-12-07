<?php

namespace App\Admin\Enums\Contract;

use App\Core\Supports\Enum;

enum ContractStatus: int
{
    use Enum;

    case Pending = 10;

    case Processing = 20;

    case Completed = 30;

    public function badge()
    {
        return match($this)
        {
            ContractStatus::Pending         => 'bg-yellow',
            ContractStatus::Processing      => 'bg-cyan',
            ContractStatus::Completed       => 'bg-green',
        };
    }
}
