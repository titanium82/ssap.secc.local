<?php

namespace App\Admin\Http\Requests\Auth;

use App\Core\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }
}