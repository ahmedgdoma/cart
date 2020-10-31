<?php

namespace App\src\factory;

use App\src\MyCart;

class EGPCart extends MyCart
{
    public $currency = 'LE';
    public $currency_change = 15;
    public function __construct($items)
    {
        parent::__construct($items);
    }
    public function writeBill(){
        $sub_total = $this->subtotal * $this->currency_change;
        $bill = "Subtotal: {$sub_total}{$this->currency}\n";
        $taxes = $sub_total * $this->tax;
        $this->total = $sub_total + $taxes;
        $bill .= "Taxes: {$taxes}{$this->currency}\n";
        $bill .= (count($this->offers) > 0)? "Discounts\n": '';
        foreach ($this->offers as $key => $value){
            $discount = $value['price'] * $this->currency_change;
            $bill .= "{$value['sale']}% off {$key}: -{$discount}{$this->currency}\n";
            $this->total -= $discount;
        }
        $bill .= (count($this->notes) > 0)? "Notes\n": '';
        foreach ($this->notes as $note){
            $bill .= $note;
        }
        $bill .= "Total: {$this->total}{$this->currency}\n";
        return $bill;
    }
}
