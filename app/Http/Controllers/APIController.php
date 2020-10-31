<?php

namespace App\Http\Controllers;


use App\Product;
use App\src\Cart;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function makeCart(Request $request){
//        dd(Product::with('offer')->get());
        $cart =   Cart::makeCart($request->get('currency'), $request->get('items'));
        return $cart->checkout();
    }
}
