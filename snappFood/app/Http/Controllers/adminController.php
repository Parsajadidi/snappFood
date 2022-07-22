<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    public function addCategory(Request $request)
    {
        //data from request
        $categoryName = $request->get('name');
        $categoryType = $request->get('type');
        //insert into DB
        Category::create([
            'name' => $categoryName,
            'type' => $categoryType
        ]);

        return redirect()->route('adminCategory');
    }
    public function deleteCategory(Request $request)
    {
        //data from request
        $categoryId = $request->get('id');

        //delete from DB
        $category = DB::table('categories')
            ->where('id', '=', $categoryId)
            ->delete();

        return redirect()->route('adminCategory');
    }
    public function editCategory(Request $request)
    {
        $categoryId = $request->get('id');

        $myCategory = DB::table('categories')
            ->where('id', '=', $categoryId)
            ->get()
            ->toArray();

        return view('admin/editCategory', compact('myCategory'));
    }
    public function editCategorySave(Request $request)
    {

        $id = $request->get('id');
        $name = $request->get('name');
        $type = $request->get('type');

        //...................................................

        $category = Category::find($id);
        $category->name = $name;
        $category->type = $type;
        $category->save();

        return redirect()->route('adminCategory');
    }
    public function addDiscount(Request $request)
    {
        $discountPercent = $request->get('discountPercent');

        Discount::create([
            'discountPercent' => $discountPercent,
        ]);

        //..................................
        return redirect()->route('adminDiscount');
    }

    public function deleteDiscount(Request $request)
    {
        $discountId = $request->get('id');
        $discount = DB::table('discounts')
            ->where('id', '=', $discountId)
            ->delete();
        return redirect()->route('adminDiscount');
    }
    public function editDisount(Request $request)
    {
        $discountId = $request->get('id');
        $myDiscount = DB::table('discounts')
            ->where('id', '=', $discountId)
            ->get()
            ->toArray();

        return view('admin/editDiscount', compact('myDiscount'));
    }
    public function editDiscountSave(Request $request)
    {
        $id = $request->get('id');
        $discountPercent = $request->get('discountPercent');

        //...................................................
        
        $discount = Discount::find($id);
        $discount->discountPercent = $discountPercent;
        $discount->save();

        return redirect()->route('adminDiscount');
    }
    public function showComments(){
    
        $comments = Comment::with(['cart' => fn ($cart) => $cart->with(['cartItems' => fn ($cartItem) => $cartItem->with('food')])])->where('status', 'deleteRequest')->get();

        return view('admin/resturantComments', compact('comments'));
    }
    public function deleteComment(Request $request){
    
        $commentID = $request->comment_ID;
        $comment = Comment::find($commentID);
        $comment->status = 'acceptdeleteRequest';
        $comment->save();
        return redirect()->route('adminComments');
    }
    public function acceptComment(Request $request){
        $commentID = $request->comment_ID;
        $comment = Comment::find($commentID);
        $comment->status = 'active';
        $comment->save();
        return redirect()->route('adminComments');
    }
}
