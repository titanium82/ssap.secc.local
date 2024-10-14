<?php

namespace App\Admin\Http\Requests\EventService;

use App\Admin\Enums\EventService\led_locations;
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
            'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'event_service_type_id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'name' => ['required', 'string', 'unique:App\Models\EventServiceUnit,name'],
            'unit'=>['required', new Enum(Unit::class)],
            'dimenssions'=>['required','string'],
            'banner_status'=>['required','string'],
            'banner_sides'=>['required','string'],
            'vertical_banner'=>['required','string'],
            'horizontal_banner'=>['required','string'],
            'led_locations'=>['required','required', new Enum(led_locations::class)],
            'desc' => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                    => ['required', 'exists:App\Models\EventServiceUnit,id'],
            'event_service_type_id' => ['required', 'exists:App\Models\EventServiceType,id'],
            'name'                  => ['nullable', 'string'],
            'unit'                  => ['required', new Enum(Unit::class)],
            'dimenssions'           => ['nullable','string'],
            'banner_status'         => ['nullable','string'],
            'banner_sides'          => ['nullable','string'],
            'vertical_banner'       => ['nullable','string'],
            'horizontal_banner'     => ['nullable','string'],
            'led_locations'         => ['nullable','required', new Enum(led_locations::class)],
            'desc'                  => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
