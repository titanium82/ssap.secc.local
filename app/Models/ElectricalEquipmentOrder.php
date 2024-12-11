<?php

namespace App\Models;

use App\Admin\Enums\Contract\ContractStatus;
use App\Admin\Enums\ElectricalEquipment\Discount;
use App\Admin\Enums\ElectricalEquipment\Surcharge;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ElectricalEquipmentOrder extends Model
{
    use HasFactory;

    protected $table = 'electrical_equipment_orders';

    protected $fillable = [
        'admin_id',
        'customer_id',
        'customer_type_id',
        'exhibition_event_id',
        'exhibition_location_id',
        'code',
        'booth_no',
        'surcharge',
        'taxrate',
        'payment_method',
        'amount',
        'total_amount',
        'contact_fullname',
        'contact_phone',
        'approved_by',
        'status',
        'desc'
    ];
    public function casts():  array
    {
        return[
            'surcharge' => Surcharge::class,
            'status' => ContractStatus::class,

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
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, foreignKey:'customer_id');
    }
    public function type()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
    }
    public function exhibitionevent(): BelongsTo
    {
        return $this->belongsTo(ExhibitionEvent::class, foreignKey:'exhibition_event_id');
    }
    public function exhibitionlocation(): BelongsTo
    {
        return $this->belongsTo(ExhibitionLocation::class, foreignKey:'exhibition_location_id');
    }
    public function electricalequipments(): BelongsToMany
    {
        return $this->belongsToMany(ElectricalEquipment::class,'electrical_equipments_to_orders','electrical_equipment_id', 'electrical_equipment_order_id');
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
