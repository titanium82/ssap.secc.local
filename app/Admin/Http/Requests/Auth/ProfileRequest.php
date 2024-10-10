<?php

namespace App\Admin\Http\Requests\Auth;

use App\Core\Enums\Gender;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class ProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone,'.auth('admin')->user()->id],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(Gender::class)],
            'avatar' => ['nullable', 'file', 'mimes:jpeg,png,jpg'],
        ];
    }
}