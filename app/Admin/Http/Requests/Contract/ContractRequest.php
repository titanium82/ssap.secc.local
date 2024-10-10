<?php

namespace App\Admin\Http\Requests\Contract;

use App\Admin\Enums\Contract\ContractPaymentMethod;
use App\Admin\Rules\ContractAmount;
use App\Admin\Rules\ContractCodeUnique;
use App\Core\Http\Requests\Request;
use App\Models\ContractType;
use Illuminate\Validation\Rules\Enum;

class ContractRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'contract.admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'contract.contract_type_id' => ['required', 'string', 'exists:App\Models\ContractType,id'],
            'contract.customer_id' => ['required', 'string', 'exists:App\Models\Customer,id'],
            'contract.currency_id' => ['required', 'string', 'exists:App\Models\Currency,id'],
            'contract.code' => ['required', 'string', new ContractCodeUnique($this->input('contract.contract_type_id'))],
            'contract.name' => ['required', 'string'],
            'contract.day_begin' => ['required', 'date_format:Y-m-d'],
            'contract.day_end' => ['required', 'date_format:Y-m-d'],
            'contract.deposit' => ['nullable', 'numeric', 'min:0'],
            'contract.total_amount' => ['nullable', 'numeric', 'min:0', new ContractAmount($this->input('payment'))],
            'contract.sub_total_amount' => ['nullable', 'numeric'],
            'contract.payment_method' => ['required', new Enum(ContractPaymentMethod::class)],
            'contract.annex' => ['nullable', 'array'],
            'contract.annex.*' => ['nullable', 'json'],
            'contract.files' => ['nullable', 'array'],
            'contract.files.*' => ['nullable', 'json'],
            'contract.note' => ['nullable'],
            'exhibition_location_id' => ['required', 'array'],
            'exhibition_location_id.*' => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'sector_id' => ['required', 'array'],
            'sector_id.*' => ['required', 'exists:App\Models\CustomerSector,id'],
            'payment' => ['required', 'array'],
            'payment.*.expired_at' => ['required', 'date_format:Y-m-d'],
            'payment.*.amount' => ['required', 'numeric', 'min:0'],
            'payment.*.file_send_mail' => ['nullable', 'json'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Contract,id'],
            'contract.name' => ['required', 'string'],
            'contract.day_begin' => ['required', 'date_format:Y-m-d'],
            'contract.day_end' => ['required', 'date_format:Y-m-d'],
            'contract.deposit' => ['nullable', 'numeric', 'min:0'],
            'contract.payment_method' => ['required', new Enum(ContractPaymentMethod::class)],
            'contract.sub_total_amount' => ['nullable', 'numeric'],
            'contract.annex' => ['nullable', 'array'],
            'contract.annex.*' => ['nullable', 'json'],
            'contract.files' => ['nullable', 'array'],
            'contract.files.*' => ['nullable', 'json'],
            'contract.note' => ['nullable'],
            'exhibition_location_id' => ['required', 'array'],
            'exhibition_location_id.*' => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'sector_id' => ['required', 'array'],
            'sector_id.*' => ['required', 'exists:App\Models\CustomerSector,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();

        $data['contract']['admin_id'] = auth('admin')->id();
        $data['contract']['deposit'] = format_to_number($data['contract']['deposit'] ?? 0);
        $data['contract']['total_amount'] = format_to_number($data['contract']['total_amount'] ?? 0);
        $data['contract']['sub_total_amount'] = format_to_number($data['contract']['sub_total_amount'] ?? 0);

        if(isset($data['payment']) && is_array($data['payment']))
        {
            foreach($data['payment'] as $key => $item)
            {
                $data['payment'][$key]['amount'] = format_to_number($item['amount']);
            }
        }


        $this->replace($data);
    }

    protected function passedValidation(): void
    {
        $data = $this->validator->getData();

        // $data['contract']['files'] = empty($data['contract']['files']) ? [] : explode(',', $data['contract']['files']);

        // $data['contract']['annex'] = empty($data['contract']['annex']) ? [] : explode(',', $data['contract']['annex']);

        if($this->isMethod('post'))
        {
            $data['contract']['code'] = contract_code($data['contract']['code'], ContractType::find($data['contract']['contract_type_id'], ['short_name'])->short_name);
        }

        $this->validator->setData($data);
    }
}
