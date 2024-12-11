<?php

namespace App\Core\Enums;

use App\Core\Supports\Enum;

enum TaxRate: string
{
    use Enum;

    case TEN_PERCENT   = '0.1';

    case EIGHT_PERCENT = '0.08';
    public function label(): string
    {
        return match ($this) {
            self::TEN_PERCENT => '10%',
            self::EIGHT_PERCENT => '8%',
        };
    }
    public function toFloat(): float
    {
        return (float) $this->value;
    }

}
