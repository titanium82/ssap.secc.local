<?php

namespace App\Admin\Http\Requests\ElectricalEquipment;

use App\Core\Http\Requests\Request;

class ElectricalEquipmentTypeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id'          => ['required', 'exists:App\Models\Admin,id'],
            'name'              => ['required', 'string','unique:App\Models\ElectricalEquipmentType,name'],
            'desc'              => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                => ['required', 'exists:App\Models\ElectricalEquipmentType,id'],
            'name'              => ['required', 'string','unique:App\Models\ElectricalEquipmentType,name,'.$this->id],
            'desc'              => ['nullable', 'string']
         ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
