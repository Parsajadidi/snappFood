<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Food;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartItemResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts=Cart::where('user_id',auth()->id())->get();
        return  CartResource::collection($carts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $food_id=$request->food_id;
        $resturant_id=Food::find($food_id)->resturant_id;
        $count=$request->count;
        //.....
        $cart=Cart::where('resturant_id',$resturant_id)->where('user_id',auth()->id())->where('is_pay',false)->first();
    
        if(! $cart){
           $cart= Cart::create([
                'user_id'=>auth()->id(),
                'resturant_id'=> $resturant_id,
            ]);
        }
        $cartItem=CartItem::where('food_id',$food_id)->where('cart_id',$cart->id)->first();
        if(!$cartItem){
            $cartItem=CartItem::create([
            'cart_id'=>$cart->id,
            'food_id'=>$food_id,
            'count'=>$count
        ]); 
        }else{

            $cartItem->update([
                'count'=>$cartItem->count+$count
            ]);

        }
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
