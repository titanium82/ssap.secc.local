<?php

namespace App\Admin\Http\Requests\Warehouse;

use App\Core\Http\Requests\Request;

class WarehouseRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id'      => ['required', 'exists:App\Models\Admin,id'],
            'department_id' => ['nullable','exists:App\Models\Department,id'],
            'name'          => ['required', 'string', 'unique:App\Models\Warehouse,name'],
            'short_name'     => ['nullable', 'string'],
            'desc'          => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'            => ['required', 'exists:App\Models\Warehouse,id'],
            'name'          => ['required', 'string', 'unique:App\Models\Warehouse,name,'.$this->id],
            'short_name'     => ['nullable', 'string'],
            'desc'          => ['nullable', 'string']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
