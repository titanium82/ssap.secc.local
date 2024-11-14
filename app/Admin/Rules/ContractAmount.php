<?php

namespace App\Admin\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ContractAmount implements ValidationRule
{

    public function __construct(
        public $payment,
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
        if(is_array($this->payment) && count($this->payment) > 0)
        {
            $subTotal = 0;

            foreach($this->payment as $item)
            {
                $subTotal += $item['amount'];
            }
            
            if($subTotal > $value)
            {
                $fail('Total amount deposit + contract payment greaterThan total amount contract.');
            }
        }
    }
}
