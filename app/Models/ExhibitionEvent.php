<?php

namespace App\Models;

use App\Admin\Enums\ExhibitionEvent\EventManager;
use App\Admin\Enums\ExhibitionEvent\EventStatus;
use App\Observers\ExhibitionEventObserver;
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
        'customer_id',  //Khách hàng
        'name', //tên sự kiện
        'short_name', // tên viết tắt
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
    public $observing = true;
    protected static function boot()
    {
        parent::boot();
        static::observe(ExhibitionEventObserver::class);
    }
    
    public function isCreator()
    {
        return $this->admin_id === auth('admin')->id();
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
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
