<?php

namespace App\Admin\Imports;

use App\Admin\Enums\ElectricalEquipment\Unit;
use App\Models\ElectricalEquipment;

class ElectricalEquipmentImport extends BaseImport
{
    public function model(array $row)
    {
        if(count(array_filter($row)) > 0)
        {
            $adminId = auth('admin')->id();

            return new ElectricalEquipment([
                'admin_id'                      => $adminId,
                'name'                          => $row['name'],
                'shortname'                     => $row['shortname'],
                'unit'                          => Unit::Pieces,
                'cost'                          => $row['cost'],
                'price'                         => $row['price'],
                'warehouse_id'                  => $row['warehouse'],
                'electrical_equipment_type_id'  => $row['type'],
                'desc' => $row['desc']
            ]);
        }
    }
}
