<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'comment',
        'score',
        'answer',
        'status',
        'cart_id'
    ];
    protected $with=["cart"];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
