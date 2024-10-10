<?php

namespace App\Admin\Rules;

use App\Models\Contract;
use App\Models\ContractPayment;
use App\Models\ContractType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ContractPaymentAmount implements ValidationRule
{

    public function __construct(
        public $contract_id
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
        $contract = Contract::find($this->contract_id);

        $totalAmountCP = ContractPayment::where('contract_id', $contract->id)->sum('amount');

        $subTotal = $totalAmountCP + $value;
        if($contract->sub_total_amount == null)
         {
            if($subTotal > $contract->total_amount)
            {
                $fail('Total amount contract payment greaterThan total amount contract.');
            }
         }
        else{
            if($subTotal > $contract->sub_total_amount)
            {
                $fail('Total amount contract payment greaterThan total amount contract.');
            }
        }
        // if($subTotal > $contract->total_amount)
        // {
        //     $fail('Total amount contract payment greaterThan total amount contract.');
        // }
    }
}
