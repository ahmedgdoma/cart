<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    public function testFalseCreateProduct()
    {
        $user = \App\User::find(1);
        // try to add existing product
        $response = $this
            ->actingAs($user)
            ->call('POST', '/admin/createProduct', ['name' => 'T-shirt', 'price'=> 4.5]);
        $this->assertEquals(422, $response->status());

    }
    public function testTrueCreateProduct()
    {
        $user = \App\User::find(1);
        $response = $this
            ->actingAs($user)
            ->call('POST', '/admin/createProduct', ['name' => 'Glovesy', 'price'=> 4.5]);
        $this->assertEquals(200, $response->status());

    }
    public function testFalseCreateOffer()
    {
        $user = \App\User::find(1);
        // try to add existing product
        $response = $this
            ->actingAs($user)
            ->call('POST', '/admin/createProduct', ['product_name' => 'T']);
        $this->assertEquals(422, $response->status());

    }
    public function testTrueCreateOffer()
    {
        $user = \App\User::find(1);
        $response = $this
            ->actingAs($user)
            ->call('POST', '/admin/createOffer',
                [
                    "product_name" => "Jacket",
                    "offer_product"=> "T-shirt",
                    'product_count' => 100,
                    "sale" => 50
                ]);
        $this->assertEquals(200, $response->status());

    }

}
