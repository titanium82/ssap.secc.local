<?php

namespace App\Admin\Rules;

use App\Models\CustomerType;
use App\Models\ElectricalEquipmentOrder;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ElectricalEquipmentCodeUnique implements ValidationRule
{

    public function __construct(
        public $customer_type_id
    )
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $customer_type_id = CustomerType::find($this->customer_type_id, ['short_name']);

        if($customer_type_id)
        {
            $ElectricalEquipmentCode = electricalequipment_code($value, $customer_type_id->short_name);

            if(ElectricalEquipmentOrder::where('code', $ElectricalEquipmentCode)->exists())
            {
                $fail('The :attribute must be unique.');
            }
        }else {
            $fail('The customer type not exists.');
        }
    }
}
