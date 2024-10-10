<?php

namespace App\Core\Enums;

use App\Core\Supports\Enum;

enum Gender: string
{
    use Enum;

    case Male   = 'Male';

    case Female = 'Female';

    case Mr = 'Mr';

    case Ms = 'Ms';

    case Other = 'Other';
}
