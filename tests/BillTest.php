<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BillTest extends TestCase
{

    public function testFalseBill()
    {
        $user = \App\User::find(2);
        $response = $this
            ->actingAs($user)
            ->call('POST', '/makeCart', ["currency"=> "EGP", "items"=> "x T-shirt T-shirt Shoes"]);
        $this->assertEquals(422, $response->status());
        $this->assertStringContainsString('not found', $response->getContent());

    }

    public function testTrueBill()
    {
        $user = \App\User::find(2);
        $response = $this
            ->actingAs($user)
            ->call('POST', '/makeCart', ["currency"=> "EGP", "items"=> "T-shirt T-shirt Shoes"]);
        $this->assertEquals(200, $response->status());
        $this->assertStringContainsString('Total', $response->getContent());

    }
}
