<?php

namespace App\Admin\Enums\ExhibitionLocation;

use App\Core\Supports\Enum;

enum ScreenProjector: string
{
    use Enum;
    case inch300 = '300 inch';
    case inch84 = '84 inch';
    case inch150 = '150 inch';

}
