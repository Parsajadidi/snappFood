<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\ResturantResource;
use App\Models\Schedule;

class resturantController extends Controller
{
    public function index(){
        return  ResturantResource::collection(Resturant::all());
    }
    
    public function show($id){
        return new ResturantResource(Resturant::find($id));
    }
    public function food($resturant_id){
    
     return  FoodResource::collection(Food::where('resturant_id',$resturant_id)->get());

    }
}
