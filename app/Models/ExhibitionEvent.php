<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'start_day',  //ngày bắt đầu sự kiện
        'end_day',  // ngày kết thúc sự kiện
        'event_manager',    //người quản lý sự kiện
        'desc'
    ];
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function exhibitionlocation(): BelongsTo
    {
        return $this->belongsTo(ExhibitionLocation::class, 'exhibition_location_id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
