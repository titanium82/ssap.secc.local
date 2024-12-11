<?php

namespace App\Admin\Enums\ElectricalEquipment;

use App\Core\Supports\Enum;
enum    Surcharge: int
{
    use Enum;
        case TenPercent = 10;
        case TwentyPercent = 20;
        case ThirtyPercent = 30;
        public function getDescription(): string
        {
            return match($this) {
                self::TenPercent => '10%',
                self::TwentyPercent => '20%',
                self::ThirtyPercent => '30%',
            };
        }


}
