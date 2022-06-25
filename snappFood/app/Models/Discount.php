<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
  protected $fillable=['discountPercent'];
  public function food(){
  
    return $this->hasMany(Food::class);
  }
}
