<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Discount;

class adminController extends Controller
{
    public function addCategory(Request $request)
    {

        $categoryName = $request->get('name');
        $categoryType = $request->get('type');
        //dd($categoryType);
        //...................
        // $category = new Category;
        // $category->name = $categoryName;
        // $category->type = $categoryType;
        // $category->save;
        Category::create([
            'name'=>$categoryName,
            'type'=>$categoryType
        ]);
        //dd($category);
        //..................................
        return redirect()->route('adminCategory');
    }
    public function deleteCategory(Request $request){
        $categoryId=$request->get('id');
        $category= DB::table('categories')
        ->where('id','=', $categoryId)
        ->delete();
        return redirect()->route('adminCategory');
    }
    public function editCategory(Request $request){
        $categoryId=$request->get('id');
       $myCategory=DB::table('categories')
       ->where('id','=',$categoryId)
       ->get()
       ->toArray();
        //dd($myCategory);
        return view('admin/editCategory',compact('myCategory'));
    }
    public function editCategorySave(Request $request){
    $id=$request->get('id');
    $name=$request->get('name');
    $type=$request->get('type');
    //...................................................
    $category = Category::find($id);
 
    $category->name = $name;
    $category->type = $type;
    $category->save();

        return redirect()->route('adminCategory');
    }
    public function addDiscount(Request $request){
        $discountPercent = $request->get('discountPercent');
      
        Discount::create([
            'discountPercent'=>$discountPercent,
        ]);
        //dd($category);
        //..................................
        return redirect()->route('adminDiscount');
    }

    public function deleteDiscount(Request $request){
        $discountId=$request->get('id');
        $discount= DB::table('discounts')
        ->where('id','=', $discountId)
        ->delete();
        return redirect()->route('adminDiscount');

    }
    public function editDisount(Request $request){
        $discountId=$request->get('id');
        $myDiscount=DB::table('discounts')
        ->where('id','=',$discountId)
        ->get()
        ->toArray();
         //dd($myCategory);
         return view('admin/editDiscount',compact('myDiscount'));  
    
    }
    public function editDiscountSave(Request $request){
        $id=$request->get('id');
    $discountPercent=$request->get('discountPercent');
    //...................................................
    $discount = Discount::find($id);
    //dd($discount->discountPercent);
    $discount -> discountPercent = $discountPercent;
    $discount->save();

        return redirect()->route('adminDiscount');
    }
}
