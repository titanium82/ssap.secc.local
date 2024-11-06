<?php

namespace App\Admin\Http\Requests\Customer;

use App\Core\Enums\Gender;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class CustomerContactRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'customer_id' => ['required', 'exists:App\Models\Customer,id'],
            'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'fullname' => ['required', 'string', 'unique:App\Models\CustomerContact,fullname'],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'phone_second' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'phone_third' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'email' => ['required', 'string'],
            'position' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(Gender::class)],
            'desc' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\CustomerContact,id'],
            // 'customer_id' => ['required', 'exists:App\Models\Customer,id'],
            'fullname' => ['required', 'string'],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'phone_second' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'phone_third' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'email' => ['nullable', 'email'],
            'position' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(Gender::class)],
            'desc' => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
