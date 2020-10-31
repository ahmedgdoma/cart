<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('name', 100)->primary();
            $table->float('price');
            $table->timestamps();
        });
        $products = [
            ['name' => 'T-shirt', 'price' => '10.99'],
            ['name' => 'Pants', 'price' => '14.99'],
            ['name' => 'Jacket', 'price' => '19.99'],
            ['name' => 'Shoes', 'price' => '24.99'],
        ];
        foreach ($products as $product)
            \App\Product::create($product);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
