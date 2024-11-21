<?php

namespace App\Models;

use App\Admin\Enums\ExhibitionEvent\EventManager;
use App\Admin\Enums\ExhibitionEvent\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class ExhibitionEvent extends Model
{
    use HasFactory;

    protected $table = 'exhibition_events';

    protected $fillable = [
        'admin_id',
        'exhibition_location_id', // Sảnh sự kiện
        'customer_id',  //Khách hàng
        'name', //tên sự kiện
        'shortname', // tên viết tắt
        'day_begin',  //ngày bắt đầu sự kiện
        'day_end',  // ngày kết thúc sự kiện
        'event_manager',
        'status',    //trạng thái sự kiện
        'desc'
    ];
    public function casts(): array
    {
        return [
            'eventmanger'   => EventManager::class,
            'status'        => EventStatus::class,

        ];
    }
    //Cap nhat trang thai cho su kien
    // public function updateStatusByDates()
    // {
    //     $now = now();

    //     if ($now->lt($this->start_date)) {
    //         $this->status = EventStatus::upcoming;
    //     } elseif ($now->between($this->start_date, $this->end_date)) {
    //         $this->status = EventStatus::ongoing    ;
    //     } else {
    //         $this->status = EventStatus::ended;
    //     }

    //     $this->save();
    // }
//     protected static function booted()
// {
//     static::saving(function ($event) {
//         $event->updateStatusByDates(); // Tự động cập nhật status trước khi lưu
//     });
// }

    public function isCreator()
    {
        return $this->admin_id === auth('admin')->id();
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function exhibitionlocation(): BelongsTo
    {
        return $this->belongsTo(ExhibitionLocation::class, 'exhibition_location_id');
    }
    public function exhibitionlocations(): BelongsToMany
    {
        return $this->belongsToMany(ExhibitionLocation::class,'exhibition_events_to_locations','exhibition_event_id','exhibition_location_id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function scopeCurrentAuth($q)
    {
        $auth = auth('admin')->user();
        if(!$auth->managerContract() && !$auth->checkIsSuperAdmin())
        {
            $q->where('admin_id', $auth->id);
        }
    }
}
