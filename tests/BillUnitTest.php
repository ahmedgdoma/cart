<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BillUnitTest extends TestCase
{


    public function testEGPBill()
    {
        $cart = \App\src\Cart::makeCart("EGP", "T-shirt T-shirt Shoes");
        $this->assertStringContainsString('Total', $cart->checkout());
        $this->assertStringContainsString('LE', $cart->checkout());

    }
    public function testDollarBill()
    {
        $cart = \App\src\Cart::makeCart("Dollar", "T-shirt T-shirt Shoes");
        $this->assertStringContainsString('Total', $cart->checkout());
        $this->assertStringContainsString('$', $cart->checkout());

    }
    public function testEurBill()
    {
        // Euro currency not supported so return into dollar
        $cart = \App\src\Cart::makeCart("Eur", "T-shirt T-shirt Shoes");
        $this->assertStringContainsString('Total', $cart->checkout());
        $this->assertStringContainsString('$', $cart->checkout());

    }
}
