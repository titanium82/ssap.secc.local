<?php

namespace App\Admin\Http\Requests\EventService;

use App\Admin\Enums\EventService\Unit;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class EventServiceUnitRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id'              => ['required', 'exists:App\Models\Admin,id'],
            'event_service_type_id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'unit'                  => ['required', new Enum(Unit::class)],
            'desc'                  => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                    => ['required', 'exists:App\Models\EventServiceUnit,id'],
            'event_service_type_id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'unit'                  => ['required', new Enum(Unit::class)],
            'desc'                  => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
    protected function passedValidation(): void
    {
        $data = $this->validator->getData();
        $this->validator->setData($data);
    }
}
