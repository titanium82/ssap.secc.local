<?php

namespace App\Admin\Enums\ExhibitionEvent;

use App\Core\Supports\Enum;

enum EventStatus: string
{
    use Enum;
    case upcoming = "Sắp diễn ra";
    case ongoing = "Đang diễn ra";
    case ended = "Kết thúc";
    case cancelled = "Hủy";
    case postponed = "Tạm hoãn";

    public  function badge():string //class badge để add class badge vào css
    {
        return match ($this){
            EventStatus::upcoming  => 'bg-success',
            EventStatus::ongoing   => 'bg-primary',
            EventStatus::ended     => 'bg-info',
            EventStatus::cancelled => 'bg-danger',
            EventStatus::postponed => 'bg-warning',
        };
    }

}
