<?php

namespace App\Admin\Http\Requests\Contract;

use App\Core\Http\Requests\Request;

class ContracShareRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'contract_id' => ['required', 'exists:App\Models\Contract,id'],
            'admin_id' => ['nullable', 'array'],
            'admin_id.*' => ['nullable', 'exists:App\Models\Admin,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => []
        ]);
    }
}