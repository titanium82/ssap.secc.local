<?php

namespace App\Observers;

use App\Admin\Enums\ExhibitionEvent\EventStatus;
use App\Models\ExhibitionEvent;
use Carbon\Carbon;

class ExhibitionEventObserver
{
    public function saving(ExhibitionEvent $exhibitionevent)
    {
         // Kiểm tra nếu sự kiện hiện đang có trạng thái "Hủy" hoặc "Hoãn"
         if (in_array($exhibitionevent->status, [EventStatus::cancelled, EventStatus::postponed])) {
            // Không tự động thay đổi trạng thái
            return;
        }
        $now = Carbon::now();

        if ($now->lt($exhibitionevent->day_begin)) {
            $exhibitionevent->status = EventStatus::upcoming;
        }
        elseif ($now->between($exhibitionevent->day_begin, $exhibitionevent->day_end))
        {
            $exhibitionevent->status = EventStatus::ongoing;
        }
        else {
            $exhibitionevent->status = EventStatus::ended;
        }
    }
}
