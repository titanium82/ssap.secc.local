<?php

use Illuminate\Support\Str;

if (! function_exists('uniqid_real')) {
    function uniqid_real($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return Str::upper(substr(bin2hex($bytes), 0, $lenght));
    } 
}

if (! function_exists('format_price')) {
    function format_price($price, $positionCurrent = '', $currency = '') {
        if($positionCurrent == ''){
            $positionCurrent = config('core.format.position_currency');
        }

        if($currency == ''){
            $currency = config('core.currency');
        }
        return $positionCurrent == 'left' ? $currency.number_format($price) : number_format($price).$currency;
    } 
}

if (! function_exists('format_date')) {
    function format_date($date, $format = null) {
        if($date){
            $format = $format ?: config('core.format.date');
            return date($format, strtotime($date));
        }
        return null;
    } 
}

if (! function_exists('format_datetime')) {
    function format_datetime($datetime, $format = null) {
        if($datetime){
            $format = $format ?: config('core.format.datetime');
            return date($format, strtotime($datetime));
        }
        return null;
    } 
}

if (! function_exists('contract_code')) {
    function contract_code(string $code, string $contract_type_shortname = null)
    {
        return $code . '/' . date('Y'). '-' . $contract_type_shortname . '-' . config('core.project_name');
    } 
}

if (! function_exists('format_to_number')) {
    function format_to_number($number, string $separator = ',')
    {
        return str_replace($separator, '',  $number);
    }
}