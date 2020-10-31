<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/30/20
 * Time: 7:55 PM
 */

namespace App\src;


use App\src\factory\CartCurrencyFactory;
use App\src\factory\DollarCart;
use App\src\factory\EGPCart;

class Cart implements CartCurrencyFactory
{

    public static function makeCart(string $currency, string $items)
    {
        switch ($currency){
            case ('EGP'):
                return new EGPCart($items);
            break;
            default:
                return new DollarCart($items);
        }
    }



}
