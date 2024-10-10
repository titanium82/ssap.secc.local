<?php

namespace App\Admin\Http\Requests\EventService;

use App\Admin\Enums\EventService\Unit;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class EventServiceRequest extends Request
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
            'event_service_type_id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'name' => ['required', 'string', 'unique:App\Models\EventService,name'],
            'unit' =>['required', new Enum(Unit::class)],
            'price'=>['nullable','numeric'],
            'desc' => ['nullable', 'string']
        ];
        dd($event_service_type_id);
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\EventService,id'],
            'event_service_type_id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'name' => ['required', 'string', 'unique:App\Models\EventService,name'],
            'unit' =>['required', new Enum(Unit::class)],
            'price'=>['nullable','numeric'],
            'desc' => ['nullable', 'string']
        ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['price'] = format_to_number($data['price'] ?? 0);
        $this->replace($data);
        // dd($data);
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
