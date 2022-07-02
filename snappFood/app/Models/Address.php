<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'is_active',
        'addressable_type',
        'addressable_id' ,
        'latitiude' ,
        'longitude',
        'address'
    ];
    public function addressable()
    {
        return $this->morphTo();
    }
}
