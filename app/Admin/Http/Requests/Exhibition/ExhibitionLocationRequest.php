<?php

namespace App\Admin\Http\Requests\ExhibitionLocation;

use App\Core\Http\Requests\Request;

class ExhibitionLocationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id'          => ['required', 'exists:App\Models\Admin,id'],
            'name'              => ['required', 'string'],
            'stretch'           => ['nullable', 'integer'],
            'location'          => ['nullable', 'string'],
            'classroom'         => ['nullable', 'string'],
            'theater'           => ['nullable', 'string'],
            'screen_projector'  => ['nullable', 'string'],
            'screen_backdrop'   => ['nullable','string'],
            'sound'             => ['nullable', 'string'],
            'light'             => ['nullable', 'string'],
            'wifi'              => ['nullable', 'string'],
            'air_conditioner'   => ['nullable','string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'name'              => ['required', 'string'],
            'stretch'           => ['nullable', 'integer'],
            'location'          => ['nullable', 'string'],
            'classroom'         => ['nullable', 'string'],
            'theater'           => ['nullable', 'string'],
            'screen_projector'  => ['nullable', 'string'],
            'screen_backdrop'   => ['nullable','string'],
            'sound'             => ['nullable', 'string'],
            'light'             => ['nullable', 'string'],
            'wifi'              => ['nullable', 'string'],
            'air_conditioner'   => ['nullable','string']
         ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}
