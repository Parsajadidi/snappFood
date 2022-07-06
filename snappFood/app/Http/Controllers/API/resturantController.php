<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class resturantController extends Controller
{
    public function index(){
        
        $resturants =Resturant::all();
        foreach($resturants as $resturant){
              $response[$resturant->id]=[
            'id'=>$resturant->id,
            'name'=>$resturant->name,
            'is_open'=>$resturant->is_open,
            'category'=>$resturant->category->name
        ];    
        }
  

    return response($response);
    }
    
    public function show($id){
        $resturant=Resturant::find($id);
        $response=[
            'id'=>$resturant->id,
            'name'=>$resturant->name,
            'category'=>$resturant->category->name
        ];
       // dd(Resturant::find($id)->category);
        return response($response);
    }
    public function food($resturant_id){
    
        $foods=Food::with(['category','discount'])->where('resturant_id',$resturant_id)->get();
        //->load('category','discount');
        // $foods=Food::all();
       // dd($foods);
        
        // $response=[
        // 'name'=>$foods->name,
        // 'price'=>$foods->price,
        // 'description'=>$foods->description,
        // 'is_foodParty'=>$foods->is_foodParty,
        // 'category'=>$foods->category->name,
        // 'disount'=>$foods->discount->discountPercent,

        // ];
       // return response($response);
        return $foods;

    }
}
