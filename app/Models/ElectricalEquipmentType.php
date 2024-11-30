<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricalEquipmentType extends Model
{
    use HasFactory;

    protected $table = 'electrical_equipment_types';

    protected $fillable = [
        'admin_id',
        'name',
        'desc'
    ];
}
