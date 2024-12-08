<?php

namespace App\Admin\Http\Requests\Exhibition;

use App\Admin\Enums\ExhibitionEvent\EventManager;
use App\Admin\Enums\ExhibitionEvent\EventStatus;
use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rules\Enum;

class ExhibitionEventRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'exhibitionevent.admin_id'                  => ['required', 'exists:App\Models\Admin,id'],
            'exhibition_location_id.*'                  => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'exhibition_location_id'                    => ['required', 'array'],
            'exhibitionevent.customer_id'               => ['required', 'exists:App\Models\Customer,id'],
            'exhibitionevent.name'                      => ['required', 'string'],
            'exhibitionevent.short_name'                 => ['required', 'string'],
            'exhibitionevent.day_begin'                 => ['required', 'date_format:Y-m-d'],
            'exhibitionevent.day_end'                   => ['required', 'date_format:Y-m-d'],
            'exhibitionevent.event_manager'             => ['nullable', new Enum(EventManager::class)],
            'exhibitionevent.status'                    => ['nullable', new Enum(EventStatus::class)],
            'exhibitionevent.desc'                      => ['nullable','string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                                        => ['required', 'exists:App\Models\ExhibitionEvent,id'],
            'exhibition_location_id.*'                  => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'exhibition_location_id'                    => ['required', 'array'],
            'exhibitionevent.customer_id'               => ['required', 'exists:App\Models\Customer,id'],
            'exhibitionevent.name'                      => ['required', 'string'],
            'exhibitionevent.short_name'                 => ['required', 'string'],
            'exhibitionevent.day_begin'                 => ['required', 'date_format:Y-m-d'],
            'exhibitionevent.day_end'                   => ['required', 'date_format:Y-m-d'],
            'exhibitionevent.event_manager'             => ['nullable', new Enum(EventManager::class)],
            'exhibitionevent.status'                    => ['nullable', new Enum(EventStatus::class)],
            'exhibitionevent.desc'                      => ['nullable','string'],
         ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();

        $data['exhibitionevent']['admin_id'] = auth('admin')->id();
        $this->replace($data);
        // dd(vars: $data);
    }
    protected function passedValidation(): void
    {
        $data = $this->validator->getData();
        $this->validator->setData($data);

    }
}
