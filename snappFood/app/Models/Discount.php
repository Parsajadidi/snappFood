<?php

namespace App\Models;

use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;
  protected $fillable=['discountPercent'];
  public function food(){
  
    return $this->hasMany(Food::class);
  }
}
