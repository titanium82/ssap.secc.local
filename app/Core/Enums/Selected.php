<?php

namespace App\Core\Enums;

use App\Core\Supports\Enum;

enum Selected: string
{
    use Enum;

    case Yes   = 'Yes';

    case No = 'No';

}
