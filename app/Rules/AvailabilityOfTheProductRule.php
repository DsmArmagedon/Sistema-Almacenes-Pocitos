<?php

namespace App\Rules;

use App\Models\InputOutput;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class AvailabilityOfTheProductRule implements Rule {

    protected $quantity;
    protected $description;
    protected $type;

    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($quantity, $type) {
        $this->quantity = $quantity;
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        $product = Product::findOrFail($value);
        if ($this->type === InputOutput::OUTPUT) {
            if (\Request::method() === self::METHOD_PUT) {
                $oldQuantity = InputOutput::findOrFail(\Request::route('inputs_output'))->quantity;
                $stock = $product->stock + $oldQuantity;
                if ($stock >= (integer) $this->quantity) {
                    return true;
                }
            } else {
                if ($product->stock >= (integer) $this->quantity) {
                    return true;
                }
            }
            $this->description = $product->description;
            return false;
        } else {
            if (\Request::method() === self::METHOD_PUT) {
                if ($product->stock <= (integer) $this->quantity) {
                    return true;
                }
                $this->description = $product->description;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Falta disponibilidad en inventario del producto ' . $this->description;
    }

}
