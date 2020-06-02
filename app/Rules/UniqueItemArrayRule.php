<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueItemArrayRule implements Rule
{
    protected $column;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($column = null)
    {
        $this->column = $column;
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
        if(is_null($this->column))
        {
            $items = $value;
        } else {
            $items = array_column($value, $this->column);
        }
        $itemsUnique = array_unique($items);
        $itemsDiffAsoc = array_diff_assoc($items, $itemsUnique);
        if(count($itemsDiffAsoc) > 0)
        {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Uno o varios elementos del campo :attribute se encuentran repetidos.';
    }
}
