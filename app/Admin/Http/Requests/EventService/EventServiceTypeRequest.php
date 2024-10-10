<?php

namespace App\Admin\Http\Requests\EventService;

use App\Core\Http\Requests\Request;

class EventServiceTypeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'name' => ['required', 'string', 'unique:App\Models\EventServiceType,name'],
            'desc' => ['nullable', 'integer']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'name' => ['required', 'string', 'unique:App\Models\EventServiceType,name,'.$this->id],
            'desc' => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
