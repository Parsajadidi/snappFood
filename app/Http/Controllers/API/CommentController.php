<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //data
        $cart_ID=$request->cart_ID;
        $score=$request->score;
        $comment=$request->comment;
        $cartUser=cart::find($cart_ID);
        //............
        if(auth()->user()->id==$cartUser->user_id  ){
            if($cartUser->is_pay == true){

               $result= Comment::create([
                    'cart_id'=>$cart_ID,
                    'score'=>$score,
                    'comment'=>$comment
                ]);
                
                return ['massege'=> 'comment added '];
            }
            else return['massege'=>'undeliverded'];
        }else return abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($resturant_id)
    {
        //data
        $resturant_id=$resturant_id;
        $comments=Comment::with(['cart'=>fn ($cart)=>$cart -> with(['cartItems'=> fn ($cartItem) => $cartItem->with('food')])])->whereRelation("cart","resturant_id" ,"=" ,$resturant_id)->where('status','active')->get();
        //.....
        return  CommentResource::collection($comments);
    }

   
}
