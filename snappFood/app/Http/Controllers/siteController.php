<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class siteController extends Controller
{

    public function showAdminHome(){
        return view('admin/adminHome');
    
    }
    public function showAdminCategories(){

        $categories=DB::table('categories')
        ->select('*')
        ->get()
        ->toArray();
        return view('admin/adminCategories',compact('categories'));
    
    }
    public function showAdminDiscount(){
        $discounts=DB::table('discounts')
        ->select('*')
        ->get()
        ->toArray();

        return view('admin/adminDiscount',compact('discounts'));
    
    }
    public function showResturantHome(){
        
        if(Gate::allows('created_resturant')){
            $resturantInfo = Resturant::with('category')->where('user_id', auth()->user()->id)->get();
            $resturantSchedule=Schedule::where('resturant_id', $resturantInfo[0]->id)->get();
            $data=[$resturantInfo,$resturantSchedule];
            return view('resturant/resturantHome',compact('data'));
        }
        return view('resturant/resturantHome');
    }
   
}
