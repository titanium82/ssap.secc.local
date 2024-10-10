<?php

namespace App\Admin\Http\Requests\Contract;

use App\Core\Http\Requests\Request;

class ContractTypeRequest extends Request
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
            'name' => ['required', 'string', 'unique:App\Models\ContractType,name'],
            'short_name' => ['required', 'string', 'unique:App\Models\ContractType,short_name'],
            'position' => ['nullable', 'integer']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\ContractType,id'],
            'name' => ['required', 'string', 'unique:App\Models\ContractType,name,'.$this->id],
            'short_name' => ['required', 'string', 'unique:App\Models\ContractType,short_name,'.$this->id],
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