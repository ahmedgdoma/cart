<?php

namespace App\src;


use App\src\builder\CartItemsBuilder;

abstract class MyCart implements CartItemsBuilder
{
    public $items = [];
    public $notes = [];
    public $offers = [];
    public $subtotal = 0;
    public $total = 0;
    public $tax = 0.14;
    public $currency;
    public function __construct($items)
    {
        $this->makeItems($items);

    }

    public function makeItems(string $items) {
        $items = preg_split('/ +/', $items);
        $items = array_count_values($items);
        foreach ($items as $key => $item_count){
            $item = CartItem::find($key);
            if(isset($item)){
                $item->items_count = $item_count;
                $this->items[$key] = $item;
            }
        }
    }

    public function checkout(){
        foreach ($this->items as $item){
            $this->subtotal += $item->total();
            $this->offersCalc($item);
        }
        $this->total = $this->subtotal;
        return $this->writeBill();
    }

    public function offersCalc($item){
        if(isset($item->offer) && $item->items_count % $item->offer->product_count == 0){
            $offer_repeat = floor($item->items_count / $item->offer->product_count);
            if(!isset($item->offer->offer_product)){
                $this->addOffer($item->name,$item->total(), $item->offer->sale, $offer_repeat);
            }else{
                 if (in_array($item->offer->offer_product, array_keys($this->items))
                && $item->offer->offer_product_count ==  $this->items[$item->offer->offer_product]->items_count){
                     $this->addOffer($this->items[$item->offer->offer_product]->name,
                         $this->items[$item->offer->offer_product]->total(), $item->offer->sale, $offer_repeat);
                }else{
                     $note = "add {$item->offer->offer_product} and you will get {$item->offer->sale}% discount \n";
                     array_push($this->notes, $note);
                 }
            }
        }

    }

    public function addOffer($product_name, $price, $sale, $offer_repeat){

        $this->offers[$product_name] = [
            'sale' => $sale,
            'price' => $price * $offer_repeat * $sale / 100
        ];
    }
    public abstract function writeBill();



}
