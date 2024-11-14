<?php

namespace App\Admin\Http\Requests\Admin;

use App\Core\Enums\Gender;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class AdminRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin.email' => ['required', 'email', 'unique:App\Models\Admin,email'],
            'admin.fullname' => ['required', 'string'],
            'admin.phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone'],
            'admin.password' => ['required', 'string', 'confirmed'],
            'admin.birthday' => ['nullable', 'date_format:Y-m-d'],
            'admin.gender' => ['required', new Enum(Gender::class)],
            'admin.is_superadmin' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'exists:App\Models\Permission,id'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'exists:App\Models\Role,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Admin,id'],
            'admin.email' => ['required', 'email', 'unique:App\Models\Admin,email,'.$this->id],
            'admin.fullname' => ['required', 'string'],
            'admin.phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone,'.$this->id],
            'admin.password' => ['nullable', 'string', 'confirmed'],
            'admin.birthday' => ['nullable', 'date_format:Y-m-d'],
            'admin.gender' => ['required', new Enum(Gender::class)],
            'admin.is_superadmin' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'exists:App\Models\Permission,id'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'exists:App\Models\Role,id']
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $data = $this->validator->getData();

        if(empty($data['admin']['password']))
        {
            unset($data['admin']['password']);
        }

        if($this->input('admin.is_superadmin', false))
        {
            $data['roles'] = $data['permissions'] = [];

            $this->validator->setData($data);
        }else {
            if($this->isMethod('put'))
            {
                $data['admin']['is_superadmin'] = false;

                $this->validator->setData($data);
            }
        }
    }
}
