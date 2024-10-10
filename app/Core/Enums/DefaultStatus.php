<?php

namespace App\Core\Enums;

use App\Core\Supports\Enum;

enum DefaultStatus: int
{
    use Enum;

    case Published = 10;

    case Draft = 20;
}
