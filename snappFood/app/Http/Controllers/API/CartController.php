<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Food;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartItemResource;
use App\Models\Payment;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return  CartResource::collection($carts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //data
        $food_id = $request->food_id;
        $resturant_id = Food::find($food_id)->resturant_id;
        $count = $request->count;
        //.....
        $cart = Cart::where('resturant_id', $resturant_id)->where('user_id', auth()->id())->where('is_pay', false)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'resturant_id' => $resturant_id,
            ]);
        }
        $cartItem = CartItem::where('food_id', $food_id)->where('cart_id', $cart->id)->first();
        if (!$cartItem) {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'food_id' => $food_id,
                'count' => $count
            ]);
        } else {

            $cartItem->update([
                'count' => $cartItem->count + $count
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cart_id = $request->cart_id;
        $cart = Cart::findOrFail($cart_id);
      
        return  new CartResource($cart);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartID=$cartItem->cart_id;
        $count=$request->count;

       $cart= Cart::with('cartItems')->where('id',$cartID)->first()->cartItems;

        if($count == 0 ){

            $cartItem->delete();
            if($cart->isEmpty()){
                Cart::where('id',$cartID)->delete();
                return ['messege'=>'cart deleted , nothing to show .'];
            }
        }else{

            $cartItem->update($request->all());
        }


        return new CartItemResource($cartItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function pay(Request $request, $cart_id)
    {
        $finalPrice=0;
        $cart = Cart::with(['cartItems' => fn ($cartItem) => $cartItem->with(['food'=> fn ($food)=> $food->with('discount')])])->findOrFail($cart_id);
        foreach($cart->cartItems as $cartItem){
            $finalPrice+=0.01*(($cartItem->food->price)*(100-($cartItem->food->discount->discountPercent)))*($cartItem->count);
        }
        
        if ($cart->user_id == auth()->id()) {
            $cart->is_pay = true;
            $cart->save();
            Payment::create([
                'cart_id' => $cart->id,
                'finalPrice' => $finalPrice
            ]);
            return 'paid';
        } else abort(403);
    }
}
