<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function resturants(){

        return $this->hasMany(Resturant::class,);
        }
        public function food(){

            return $this->hasMany(Food::class,);
            }
      
}
