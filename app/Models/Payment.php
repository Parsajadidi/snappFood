<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=[
        'cart_id',
        'finalPrice',
        'staus'
    ];

    public function cart(){
    return $this->belongsTo(Cart::class);
    }
}
