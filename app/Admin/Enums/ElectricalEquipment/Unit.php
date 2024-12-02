<?php

namespace App\Admin\Enums\ElectricalEquipment;

use App\Core\Supports\Enum;
enum    Unit: string
{
    use Enum;
        case Pieces = 'Pieces';
        case Set = 'Set';
        case cabinet = 'cabinet';
}
