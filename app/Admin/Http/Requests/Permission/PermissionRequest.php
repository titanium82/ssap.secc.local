<?php

namespace App\Admin\Http\Requests\Permission;

use App\Core\Http\Requests\Request;

class PermissionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string', 'unique:App\Models\Permission,name'],
            'route_names' => ['required', 'array'],
            'route_names.*' => ['required', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Permission,id'],
            'name' => ['required', 'string', 'unique:App\Models\Permission,name,'.$this->id],
            'route_names' => ['required', 'array'],
            'route_names.*' => ['required', 'string']
        ];
    }
}