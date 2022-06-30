<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //dd($categories);
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
    return view('resturant/resturantHome');
    }
   
}
