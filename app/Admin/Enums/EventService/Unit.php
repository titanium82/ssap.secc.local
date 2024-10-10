<?php

namespace App\Admin\Enums\EventService;

use App\Core\Supports\Enum;

enum    Unit: string
{
    use Enum;
        case Cable = 'Cable';
        case Pieces = 'Pieces';
        case set = 'Set';
}
