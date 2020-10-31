<?php

namespace App\Http\Controllers;


use App\Offer;
use App\Product;
use App\Rules\itemsInProducts;
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
      $this->validate($request, [
            'currency' => 'required|string',
            'items' => ['bail', 'required', 'string', new itemsInProducts],
        ]);
        $cart =   Cart::makeCart($request->get('currency'), $request->get('items'));
        return $cart->checkout();
    }


    /**
     * create Product for admin
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createProduct(Request $request){
      $this->validate($request, [
            'name' => 'required|string|unique:products,name',
            'price' => 'required|numeric',
        ]);
      try{
          Product::create($request->all());
      }catch (\Exception $e){
          return response()->json(['message' => 'error creating Product'], 400);
      }
        return response()->json(['message' => "Product {$request->get('name')} created Successfully"], 200);

    }

    /**
     * create Product for admin
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createOffer(Request $request){
      $this->validate($request, [
            'product_name' => 'required|string|exists:products,name',
            'product_count' => 'required|integer',
            'offer_product' => 'nullable|string|exists:products,name',
            'offer_product_count' => 'nullable|integer',
            'sale' => 'required|integer|between:0,100',
      ]);
      try{
          Offer::create($request->all());
      }catch (\Exception $e){
          return response()->json(['message' => 'error creating Offer'], 400);
      }
        return response()->json(['message' => "Offer {$request->get('name')} created Successfully"], 200);

    }
}
