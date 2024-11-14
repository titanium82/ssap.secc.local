<?php

namespace App\Admin\Http\Requests\Customer;

use App\Core\Http\Requests\Request;

class CustomerTypeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'name' => ['required', 'string', 'unique:App\Models\CustomerType,name'],
            'position' => ['nullable', 'integer']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\CustomerType,id'],
            'name' => ['required', 'string', 'unique:App\Models\CustomerType,name,'.$this->id],
            'position' => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}