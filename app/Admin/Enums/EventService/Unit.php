<?php

namespace App\Admin\Enums\EventService;

use App\Core\Supports\Enum;
enum    Unit: string
{
    use Enum;
        case Cable = 'Cable';
        case Pieces = 'Pieces';
        case Set = 'Set';
        case Location = 'Location';
        case Plate = 'Plate';

}
enum banner_dimensions: string
{
    use Enum;
    case null = "Nullable";
    case W6mxH9m = "5.95m W x 8.9m H";
    case W5mxH9m = "4.95m W x 8.9m H";
    case W1mxH4m = "1m W x 4m H";
    case W1mxH5m = "1m W x 5m H";
    case W2mxH5m = "2m W x 5m H";
    case W8mxH16m = "7.2m W x 15.5m H";
    case W7mxH16m = "6.9m W x 15.5m H";
    case W6mxH19m = "5.5m W x 10m H";
    case W7mxH2m = "7m W x 1.6m H";
    case W6mxH2m = "6m W x 2.3m H";
    case W5mxH2m = "4.8m W x 1.5m H";
    case W3mxH5m = "3m W x 5m H";           //3m x 5m
    case W16mxH3m = "16m W x 2.23m H";      //Cong M1
    case W2mxH6m = "1.5m W x 6m H";         //Chân cổng
    case W10mxH3m = "9.5m W x 2.23m H";     //Cong M2
    case W5mxH4m = "4.9m W x 3.2m H";       //Backdrop Convention A
    case W4mxH3m = "4m W x 2.65m H";        //Backdrop Meeting room 3F
}

enum banner_sides: string
{
    use Enum;
    case null = "Nullable";
    case oneside = "Một Mặt";               //Banner 1 mặt
    case twosides = "Hai Mặt";               //Banner 2 mặt
}
enum led_locations: string
{
    use Enum;
    case null = "Nullable";
    case Mainlobby = "Main Lobby";
    case EastA1 = "East A1";
    case EastA2 = "East A2";
    case EastB1 = "East B1";
    case EastB2 = "East B2";
    case EastAB = "East A - B";
}
