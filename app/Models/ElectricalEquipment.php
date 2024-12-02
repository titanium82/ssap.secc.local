<?php

namespace App\Models;

use App\Admin\Enums\ElectricalEquipment\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElectricalEquipment extends Model
{
    use HasFactory;

    protected $table = 'electrical_equipments';

    protected $fillable = [
        'admin_id',
        'name',
        'shortname',
        'unit',
        'cost',
        'price',
        'electrical_equipment_type_id',
        'warehouse_id',
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
        return $this->belongsTo(ElectricalEquipmentType::class, foreignKey:'electrical_equipment_type_id');
    }
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, foreignKey:'warehouse_id');
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
