<?php

namespace App\Admin\Rules;

use App\Models\Contract;
use App\Models\ContractType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ContractCodeUnique implements ValidationRule
{

    public function __construct(
        public $contract_type_id
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
        $contractType = ContractType::find($this->contract_type_id, ['short_name']);

        if($contractType)
        {
            $contractCode = contract_code($value, $contractType->short_name);

            if(Contract::where('code', $contractCode)->exists())
            {
                $fail('The :attribute must be unique.');
            }
        }else {
            $fail('The contract type not exists.');
        }
    }
}
