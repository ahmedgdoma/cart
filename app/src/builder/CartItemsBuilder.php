<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/30/20
 * Time: 9:22 PM
 */

namespace App\src\builder;


interface CartItemsBuilder
{
    public function makeItems(string $items);
}
