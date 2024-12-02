<?php

namespace App\Admin\Http\Requests\ElectricalEquipment;

use App\Core\Http\Requests\Request;
use App\Admin\Enums\ElectricalEquipment\Unit;
use Illuminate\Validation\Rules\Enum;

class ElectricalEquipmentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id'                      => ['required', 'exists:App\Models\Admin,id'],
            'name'                          => ['required', 'string','unique:App\Models\ElectricalEquipment,name'],
            'shortname'                     => ['nullable', 'string'],
            'unit'                          => ['required', new Enum(Unit::class)],
            'cost'                          => ['nullable','numeric','min:0'],
            'price'                         => ['nullable','numeric','min:0'],
            'electrical_equipment_type_id'  => ['required','exits:App\Models\ElectricalEquipmentType,id'],
            'warehouse_id'                  => ['required','exits:App\Models\Warehouse,id'],
            'desc'                          => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                            => ['required', 'exists:App\Models\ElectricalEquipmentType,id'],
            'name'                          => ['required', 'string','unique:App\Models\ElectricalEquipment,name,'.$this->id],
            'shortname'                     => ['nullable', 'string'],
            'unit'                          => ['required', new Enum(Unit::class)],
            'cost'                          => ['nullable','numeric','min:0'],
            'price'                         => ['nullable','numeric','min:0'],
            'electrical_equipment_type_id'  => ['required','exits:App\Models\ElectricalEquipmentType,id'],
            'warehouse_id'                  => ['required','exits:App\Models\Warehouse,id'],
            'desc'                          => ['nullable', 'string']
         ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
