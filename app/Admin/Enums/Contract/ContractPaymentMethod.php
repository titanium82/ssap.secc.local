<?php

namespace App\Admin\Enums\Contract;

use App\Core\Supports\Enum;

enum ContractPaymentMethod: int
{
    use Enum;

    case Banking = 10;

    case Cash = 20;
}
