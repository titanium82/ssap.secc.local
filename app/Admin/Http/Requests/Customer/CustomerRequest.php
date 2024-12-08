<?php

namespace App\Admin\Http\Requests\Customer;

use App\Core\Enums\Gender;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class CustomerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        if($this->routeIs('admin.customer.import_excel'))
        {
            return [
                'file' => ['required', 'file', 'mimes:xls,xlsx']
            ];
        }

        return [
            'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'customer_type_id' => ['required', 'exists:App\Models\CustomerType,id'],
            'customer_sector_id' => ['required', 'array'],
            'customer_sector_id.*' => ['required', 'exists:App\Models\CustomerSector,id'],
            'fullname' => ['required', 'string'],
            'short_name' => ['nullable', 'string'],
            'gender' => ['required', new Enum(Gender::class)],
            'phone' => ['required', 'regex:/((0[2|9|3|7|8|5]|[4|8])+([0-9]{8})\b)/'],
            'fax' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\Customer,email'],
            'taxcode' => ['nullable', 'unique:App\Models\Customer,taxcode'],
            'logo' => ['nullable'],
            'address' => ['nullable'],
            'address_vat' => ['nullable'],
            'delegate' => ['nullable'],
            'website' => ['nullable'],
            'note' => ['nullable']

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Customer,id'],
            'customer_type_id' => ['required', 'exists:App\Models\CustomerType,id'],
            'customer_sector_id' => ['required', 'array'],
            'customer_sector_id.*' => ['required', 'exists:App\Models\CustomerSector,id'],
            'fullname' => ['required', 'string'],
            'short_name' => ['nullable', 'string'],
            'gender' => ['required', new Enum(Gender::class)],
            'phone' => ['required', 'regex:/((0[2|9|3|7|8|5]|[4|8])+([0-9]{8})\b)/'],
            'fax' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\Customer,email,'.$this->id],
            'taxcode' => ['nullable', 'unique:App\Models\Customer,taxcode,'.$this->id],
            'logo' => ['nullable'],
            'address' => ['nullable'],
            'address_vat' => ['nullable'],
            'delegate' => ['nullable'],
            'website' => ['nullable'],
            'note' => ['nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
