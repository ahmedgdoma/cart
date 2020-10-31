<?php

namespace App\Rules;

use App\Product;
use Illuminate\Contracts\Validation\Rule;

class itemsInProducts implements Rule
{
    public $not_in_table;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $products = Product::pluck('name')->toArray();
        $items = preg_split('/ +/', $value);
        foreach ($items as $item){
            if(!in_array($item, $products)){
                $this->not_in_table = $item;
                return false;
            }
        }
        return $items;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "item {$this->not_in_table} not found";
    }
}
