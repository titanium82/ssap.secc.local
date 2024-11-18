<?php

namespace App\Admin\Http\Requests\Exhibition;

use App\Admin\Enums\ExhibitionLocation\EventManager;
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
            'event.admin_id'                  => ['required', 'exists:App\Models\Admin,id'],
            'exhibition_location_id.*'        => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'exhibition_location_id'          => ['required', 'array'],
            'event.customer_id'               => ['required', 'exists:App\Models\Customer,id'],
            'event.name'                      => ['required', 'string'],
            'event.shortname'                 => ['required', 'string'],
            'event.day_begin'                 => ['required', 'date_format:Y-m-d'],
            'event.day_end'                   => ['required', 'date_format:Y-m-d'],
            'event.event_manager'             => ['nullable', new Enum(EventManager::class)],
            'event.desc'                      => ['nullable','string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                              => ['required', 'exists:App\Models\ExhibitionEvent,id'],
            'exhibition_location_id.*'        => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'exhibition_location_id'          => ['required', 'array'],
            'event.customer_id'               => ['required', 'exists:App\Models\Customer,id'],
            'event.name'                      => ['required', 'string'],
            'event.shortname'                 => ['required', 'string'],
            'event.day_begin'                 => ['required', 'date_format:Y-m-d'],
            'event.day_end'                   => ['required', 'date_format:Y-m-d'],
            'event.event_manager'             => ['nullable', new Enum(EventManager::class)],
            'event.desc'                      => ['nullable','string'],
         ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
