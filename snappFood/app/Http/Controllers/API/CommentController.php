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
        $cartUser=cart::find($cart_ID)->user_id;
        //............
        if(auth()->user->id==$cartUser){
            Comment::created([
                'cart_id'=>$cart_ID,
                'score'=>$score,
                'comment'=>$comment
            ]);

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
        $comments=Comment::with(['cart'=>fn ($cart)=>$cart -> with('cartItems')])->whereRelation("cart","resturant_id" ,"=" ,$resturant_id);
        //.....
        return  CommentResource::collection($comments);
    }

   
}
