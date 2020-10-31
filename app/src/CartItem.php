<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/30/20
 * Time: 8:52 PM
 */

namespace App\src;


use App\Product;

class CartItem extends Product
{
    protected $table = 'products';
    public $items_count = 0;
    public function total(){
        return $this->items_count * $this->price;
    }
}
