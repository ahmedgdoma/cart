<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 100);
            $table->foreign('product_name')->references('name')->on('products');
            $table->smallInteger('product_count');
            $table->string('offer_product', 100)->nullable();
            $table->foreign('offer_product')->references('name')->on('products');
            $table->smallInteger('offer_product_count')->default(1);
            $table->smallInteger('sale');
            $table->timestamps();
        });
        $offers = [
            ['product_name' => 'T-shirt', 'product_count'=>1,'offer_product'=> 'Jacket','offer_product_count'=>1  , 'sale' => 50],
            ['product_name' => 'Shoes', 'product_count'=>1, 'sale' => 10],
        ];
        foreach ($offers as $offer)
            \App\Offer::create($offer);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
