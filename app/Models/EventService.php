<?php

namespace App\Models;

use App\Admin\Enums\EventService\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventService extends Model
{
    use HasFactory;

    protected $table = 'event_services';

    protected $fillable = [
        'admin_id',
        'name',
        'event_service_type_id',
        'unit',
        'price',
        'desc'
    ];
    public function casts():  array
    {
        return[
            'unit' => Unit::class
        ];
    }
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
