<?php

namespace App\Admin\Http\Requests\Contract;

use App\Core\Http\Requests\Request;

class UploadLicenseRequest extends Request
{

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\ContractPayment,id'],
            'license' => ['required']
        ];
    }

    protected function passedValidation(): void
    {
        $data = $this->validator->getData();

        $data['license'] = empty($data['license']) ? [] : explode(',', $data['license']);

        $this->validator->setData($data);
    }
}