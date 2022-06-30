<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function addressable()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
