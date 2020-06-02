<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class DatePurchaseSaleRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        
        $date = DateTime::createFromFormat('d-m-Y',$value);
        $yearValue = $date->format('Y');
        $monthValue = $date->format('m');
        
        if($year === $yearValue && $month === $monthValue) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La campo :attribute no puede pertenecer a un mes y año distinto al actual.';
    }
}
