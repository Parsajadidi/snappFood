<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;

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
        $schedule=Schedule::where('resturant_id',$id)->get()->toArray();

        $response=[
            'id'=>$resturant->id,
            'name'=>$resturant->name,
            'category'=>$resturant->category->name,
            'phone'=>$resturant->phone,
            'resturant bank account'=>$resturant->bankAccount,
            'open status'=>$resturant->is_open,
            'Open Time:'=>[
                'saturday'=>$schedule[0]['saturday'],
                'sunday'=>$schedule[0]['sunday'],
                'monday'=>$schedule[0]['monday'],
                'tuesday'=>$schedule[0]['tuesday'],
                'wednesday'=>$schedule[0]['wednesday'],
                'thursday'=>$schedule[0]['thursday'],
                'friday'=>$schedule[0]['friday'],
            ]
        ];
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
