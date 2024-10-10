<?php

namespace App\Admin\Http\Requests\Role;

use App\Core\Http\Requests\Request;

class RoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'role.name' => ['required', 'string', 'unique:App\Models\Role,name'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:App\Models\Permission,id']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Role,id'],
            'role.name' => ['required', 'string', 'unique:App\Models\Role,name,'.$this->id],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:App\Models\Permission,id']
        ];
    }
}