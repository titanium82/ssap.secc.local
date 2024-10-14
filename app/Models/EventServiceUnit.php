<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventServiceUnit extends Model
{
    use HasFactory;

    protected $table = 'event_service_units';

    protected $fillable = [
        'name',
        'admin_id',
        'unit',
        'dimensions',
        'banner_status',
        'banner_sides',
        'vertical_banner',
        'horizontal_banner',
        'led_locations',
        'desc'
    ];
    public function isCreator()
    {
        return $this->admin_id === auth('admin')->id();
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(EventServiceType::class, foreignKey: 'event_service_type_id');
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
