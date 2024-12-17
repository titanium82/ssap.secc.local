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
            'admin_id' => ['required', 'exists:App\Models\Admin,id'],
            'name' => ['required', 'string'],
            'stretch' => ['nullable', 'integer'],
            'position' => ['nullable', 'integer']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\ExhibitionLocation,id'],
            'name' => ['required', 'string'],
            'stretch' => ['nullable', 'integer'],
            'position' => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
}