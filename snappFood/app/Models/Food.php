<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'price',
        'description',
        'id_foodParty',
        'discount_id',
        'category_id',
        'resturant_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function discount(){
    return $this->belongsTo(Discount::class);
    }
}
