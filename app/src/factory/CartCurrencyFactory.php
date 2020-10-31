<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/30/20
 * Time: 7:57 PM
 */

namespace App\src\factory;


interface CartCurrencyFactory
{
    public static function makeCart(string $currency, string $items);
}
