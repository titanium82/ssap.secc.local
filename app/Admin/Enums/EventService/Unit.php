<?php

namespace App\Admin\Enums\EventService;

use App\Core\Supports\Enum;

enum    Unit: string
{
    use Enum;
        case Cable = 'Cable';
        case Pieces = 'Pieces';
        case set = 'Set';
        case plate = 'Plate';

}
enum led_locations: string
{
    use Enum;
    case Mainlobby = "Main Lobby";
    case EastA1 = "East A1";
    case EastA2 = "East A2";
    case EastB1 = "East B1";
    case EastB2 = "East B2";
    case EastAB = "Eaast A - B";


}
