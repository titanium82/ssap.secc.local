<?php

namespace App\Admin\Http\Requests\Admin;

use App\Core\Http\Requests\Request;

class DepartmentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            // 'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'name' => ['required', 'string', 'unique:App\Models\Department,name']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Department,id'],
            'name' => ['required', 'string', 'unique:App\Models\Department,name']
        ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();
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
