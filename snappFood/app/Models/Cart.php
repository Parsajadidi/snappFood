<?php

namespace App\Models;

use App\Models\CartItem;
use App\Models\Resturant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_pay',
        'finalPrice',
        'staus',
        'resturant_id',
        'user_id'
    ];
    public function user()
    {

        return $this->belongsTo(User::class);
    }
    public function resturant()
    {

        return $this->belongsTo(Resturant::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function cartItems()
    {
        return  $this->hasMany(CartItem::class);
    }
}
