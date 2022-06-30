<?php

namespace App\Models;

use App\Models\Food;
use App\Models\Resturant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

        protected $fillable=['name','type'];

    public function resturants(){

        return $this->hasMany(Resturant::class);
        }

        public function food(){

            return $this->hasMany(Food::class);
            }
      
}
