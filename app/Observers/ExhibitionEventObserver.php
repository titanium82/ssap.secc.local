<?php

namespace App\Observers;

use App\Admin\Enums\ExhibitionEvent\EventStatus;
use App\Models\ExhibitionEvent;
use AWS\CRT\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log as FacadesLog;

class ExhibitionEventObserver
{
    public function updating(ExhibitionEvent $exhibitionevent)
    {
        if (!$exhibitionevent->observing) {
            return;
        }
         if (in_array($exhibitionevent->status, [EventStatus::cancelled, EventStatus::postponed])) {
            return;
        }
        $now = Carbon::now();

        if ($exhibitionevent->day_begin>$now) {
            $exhibitionevent->status = EventStatus::upcoming;
        }
        elseif ($now->between($exhibitionevent->day_begin, $exhibitionevent->day_end))
        {
            $exhibitionevent->status = EventStatus::ongoing;
        }
        else {
            $exhibitionevent->status = EventStatus::ended;
        }
        $exhibitionevent->observing = false;
        $exhibitionevent->saveQuietly(['status']);

        FacadesLog::info('Observe đang hoạt động',[
            'id'=>$exhibitionevent->id,
            'day_begin' =>$exhibitionevent->day_begin,
            'day_end'   =>$exhibitionevent->day_end,
            'status'    =>$exhibitionevent->status,
        ]);
        // dd('Observer hoạt động', $exhibitionevent->toArray());

    }
    public function updated(ExhibitionEvent $exhibitionevent)
    {
        $exhibitionevent->observing = true;
    }
}
