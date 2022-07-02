<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resturant extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'phone',
        'bankAccount',
        'category_id',
       'user_id',
       'is_open'
    ];

    public function user(){

    return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function addressable()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    public function foods(){
    return $this->hasMany(Food::class);
    }
}
