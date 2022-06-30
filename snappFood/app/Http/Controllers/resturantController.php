<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Validation\validator;
class resturantController extends Controller
{
    
    public function showResturantProfile(){


        $categories=DB::table('categories')
        ->where('type','=','resturant')
        ->select('*')
        ->get()
        ->toArray();
           // dd($categories);
        return view('resturant.reseturantProfile',compact('categories'));
    }
    public function ResturantProfile(Request $request){

       
            $request->validate([
            'name' => 'required|unique:resturants|max:20',
            'phone' => 'required|unique:resturants',
            'bankAccount' => 'required',
            "type"=> 'required'
            ]);

            $name= $request->get('name');
            $phone= $request->get('phone');
            $bankAccount= $request->get('bankAccount');
            $type=$request->get('type');


        Resturant::create([
            'name'=>$name,
            'phone'=>$phone,
            'bankAccount'=>$bankAccount,
            'category_id'=>$type,
            'user_id'=>1,
            'is_open'=>0,
        ]);

        return view('resturant/resturantHome');
    }
    public function showResturantMenu(){

        // $foods=DB::table('food')
        // ->where('resturant_id','=','1')
        // ->select('*')
        // ->get();
        // dd($foods);
       $foods =Food::all()->load('category');
        // return $foods;
       // dd($foods);
    
    return view('resturant/resturantMenu',compact('foods'));
    }
    public function showResturantAddFood(){
        $categories=DB::table('categories')
        ->where('type','=','food')
        ->select('*')
        ->get()
        ->toArray();

        $discounts=DB::table('discounts')
        ->select('*')
        ->get()
        ->toArray();
         $data=[$categories,$discounts];
         //dd($data);
        return view('resturant/resturantAddFood',compact('data'));
    
    }
    public function ResturantAddFood(Request $request){

        $foodName=$request->get('name');
        $foodPrice=$request->get('price');
        $foodDescription=$request->get('description');
        $foodDiscount=$request->get('discount');
        $foodCategory=$request->get('type');
        $foodParty=$request->get('foodParty');
        
        Food::create([
            'name'=>$foodName,
            'price'=>$foodPrice,
            'description'=>$foodDescription,
            'discount'=>$foodDiscount,
            'category_id'=>$foodCategory,
            'discount_id'=>$foodDiscount,
            'is_foodParty'=>$foodParty,
            'resturant_id'=>1
        ]);

    return redirect()->route('resturantMenu');
    }
    public function ResturantDeleteFood(request $request){
        
        $food_id=$request->get('food_id');
        $food= DB::table('food')
        ->where('id','=',$food_id)
        ->delete();

        return redirect()->route('resturantMenu');
    }
}
