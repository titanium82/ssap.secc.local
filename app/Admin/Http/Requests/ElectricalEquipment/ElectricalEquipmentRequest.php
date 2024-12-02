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
            'name'                          => ['required', 'string'],
            'shortname'                     => ['nullable', 'string'],
            'unit'                          => ['nullable', new Enum(Unit::class)],
            'cost'                          => ['nullable','numeric'],
            'price'                         => ['nullable','numeric'],
            'electrical_equipment_type_id'  => ['required','exists:App\Models\ElectricalEquipmentType,id'],
            'warehouse_id'                  => ['required','exists:App\Models\Warehouse,id'],
            'desc'                          => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                            => ['required', 'exists:App\Models\ElectricalEquipment,id'],
            'name'                          => ['required', 'string','unique:App\Models\ElectricalEquipment,name,'.$this->id],
            'shortname'                     => ['nullable', 'string'],
            'unit'                          => ['nullable', new Enum(Unit::class)],
            'cost'                          => ['nullable','numeric'],
            'price'                         => ['nullable','numeric'],
            'electrical_equipment_type_id'  => ['required','exists:App\Models\ElectricalEquipmentType,id'],
            'warehouse_id'                  => ['required','exists:App\Models\Warehouse,id'],
            'desc'                          => ['nullable', 'string']
         ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['admin_id'] = auth('admin')->id();
        $data['price'] = format_to_number($data['price'] ?? 0);
        $data['cost'] = format_to_number($data['cost'] ?? 0);
        $this->replace($data);
        // dd($data);
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
    protected function passedValidation(): void
    {
        $data = $this->validator->getData();
        $this->validator->setData($data);
    }
}
