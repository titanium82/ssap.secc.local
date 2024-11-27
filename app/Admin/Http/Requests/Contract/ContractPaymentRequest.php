<?php

namespace App\Admin\Http\Requests\Contract;

use App\Admin\Rules\ContractPaymentAmount;
use App\Core\Http\Requests\Request;

class ContractPaymentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id'                  => ['required', 'exists:App\Models\Admin,id'],
            'contract_id'               => ['required', 'exists:App\Models\Contract,id'],
            'contract_short_name'       => ['nullable', 'exists:App\Models\Contract,short_name'],
            'period'                    => ['required', 'integer', 'min:1'],
            'amount'                    => ['required', 'numeric', new ContractPaymentAmount($this->input('contract_id'))],
            'expired_at'                => ['required', 'date_format:Y-m-d'],
            'license'                   => ['nullable'],
            'license_files'             => ['nullable'],
            'file_send_mail'            => ['nullable', 'json'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                => ['required', 'exists:App\Models\ContractPayment,id'],
            // 'contract_id' => ['required', 'exists:App\Models\Contract,id'],
            // 'period' => ['required', 'integer', 'min:1'],
            'amount'            => ['required', 'numeric', 'min:1'],
            'expired_at'        => ['required', 'date_format:Y-m-d'],
            'license'           => ['nullable'],
            'license_files'     => ['nullable'],
            'file_send_mail'    => ['nullable', 'json'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);

        $data = $this->all();

        $data['amount'] = format_to_number($data['amount']);

        $this->replace($data);
    }

    protected function passedValidation(): void
    {
        $data = $this->validator->getData();

        $data['license'] = empty($data['license']) ? [] : explode(',', $data['license']);

        $this->validator->setData($data);
    }
}
