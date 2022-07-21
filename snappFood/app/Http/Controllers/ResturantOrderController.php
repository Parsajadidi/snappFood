<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;

class ResturantOrderController extends Controller
{

    public function showOrders()
    {
        $carts = Cart::with(['user', 'payment', 'cartItems' => fn ($cartItem) => $cartItem->with('food')])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment","staus" ,"!=" ,"delivered")->get();

        return view('resturant/resturantOrders', compact('carts'));
    }
    public function showOrdersInfo(Request $request)
    {
        $cart_ID = $request->get('cart_ID');
        $cart = Cart::with(['user', 'payment', 'cartItems' => fn ($cartItem) => $cartItem->with('food')])->find($cart_ID)->toArray();
        return view('resturant/resturantOrederInfo', compact('cart'));
    }
    public function OrdersInfoUpdate(Request $request)
    {
        $newStatus = $request->get('status');
        $paymentId = $request->get('paymentId');

        $payment = Payment::find($paymentId);
        $payment->staus = $newStatus;
        $payment->save();
        return redirect()->route('resturantOrders');
    }
    public function showArchive()
    {
        $carts = Cart::with(['user' => fn ($user) => $user->with('addresses'), 'payment', 'cartItems' => fn ($cartItem) => $cartItem->with('food')])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment","staus" ,"=" ,"delivered")->get();

        return view('resturant/resturantArchive', compact('carts'));
    }
}
