<?php

namespace App\Http\Controllers;


use App\Product;
use App\src\Cart;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function makeCart(Request $request){
//        dd(Product::with('offer')->get());
        $cart =   Cart::makeCart($request->get('currency'), $request->get('items'));
        return $cart->checkout();
    }
}
