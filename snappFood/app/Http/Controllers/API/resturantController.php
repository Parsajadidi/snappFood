<?php

namespace App\Http\Controllers\API;

use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class resturantController extends Controller
{
    public function index(){

    return Resturant::all();
    }
    
    public function show($id){
    
        return Resturant::find($id);
    }
}
