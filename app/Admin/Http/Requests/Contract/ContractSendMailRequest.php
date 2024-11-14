<?php

namespace App\Admin\Http\Requests\Contract;

use App\Core\Http\Requests\Request;

class ContractSendMailRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'contract_payment_id' => ['required', 'exists:App\Models\ContractPayment,id'],
            'title' => ['required', 'string'],
            'content' => ['required'],
            'email' => ['nullable', 'json'],
            'files' => ['nullable', 'array'],
        ];
    }
}