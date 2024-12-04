<?php

namespace App\Admin\Http\Requests\ElectricalEquipment;

use App\Admin\Enums\Contract\ContractStatus;
use App\Admin\Enums\ElectricalEquipment\Discount;
use App\Core\Http\Requests\Request;
use App\Models\CustomerType;
use Illuminate\Validation\Rules\Enum;

class ElectricalEquipmentOrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'electricalequipment.admin_id'              => ['required', 'exists:App\Models\Admin,id'],
            'electricalequipment.customer_id'           => ['required', 'exists:App\Models\Customer,id'],
            'electricalequipment.exhibition_event_id'   => ['required', 'exists:App\Models\ExhibitionEvent,id'],
            'electricalequipment.code'                  => ['required', 'string', 'unique:App\Models\ElectricalEquipmentOrder,code'],
            'electricalequipment.booth_no'              => ['required','string'],
            'electricalequipment.discount'              => ['required',new Enum(Discount::class)],
            'electricalequipment.vat'                   => ['nullable','numeric'],
            'electricalequipment.amount'                => ['nullable','numeric'],
            'electricalequipment.total_amount'          => ['nullable','numeric'],
            'electricalequipment.contact_fullname'      => ['required','string'],
            'electricalequipment.contact_phone'         => ['required','string'],
            'electricalequipment.status'                => ['required',new Enum(ContractStatus::class)],
            'electricalequipment.desc'                  => ['nullable', 'string']
        ];
    }

    protected function methodPut()
    {
        return [
            'id'                                        => ['required', 'exists:App\Models\ElectricalEquipmentOrder,id'],
            'electricalequipment.customer_id'           => ['required','exists:App\Models\Customer,id'],
            'electricalequipment.exhibition_event_id'   => ['required', 'exists:App\Models\ExhibitionEvent,id'],
            'electricalequipment.code'                  => ['required', 'string', 'unique:App\Models\ElectricalEquipmentOrder,code'],
            'electricalequipment.booth_no'              => ['required','string'],
            'electricalequipment.discount'              => ['required',new Enum(Discount::class)],
            'electricalequipment.vat'                   => ['nullable','numeric'],
            'electricalequipment.amount'                => ['nullable','numeric'],
            'electricalequipment.total_amount'          => ['nullable','numeric'],
            'electricalequipment.contact_fullname'      => ['required','string'],
            'electricalequipment.contact_phone'         => ['required','string'],
            'electricalequipment.status'                => ['required',new Enum(ContractStatus::class)],
            'electricalequipment.desc'                  => ['nullable', 'string']
        ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['electricalequipment']['admin_id'] = auth('admin')->id();

        $data['electricalequipment']['amount'] = format_to_number($data['electricalequipment']['amount'] ?? 0);
        $data['electricalequipment']['total_amount'] = format_to_number($data['electricalequipment']['total_amount'] ?? 0);

        $this->replace($data);
        // dd($data);
        $this->mergeIfMissing([
            'admin_id' => auth('admin')->id()
        ]);
    }
    protected function passedValidation(): void
    {
        $data = $this->validator->getData();
        if($this->isMethod('post'))
        {
            $data['electricalequipment']['code'] = electricalequipment_code($data['contract']['code'], CustomerType::find($data['electricalequipment']['customter_type_id'], ['short_name'])->short_name);
        }

        $this->validator->setData($data);
    }
}
