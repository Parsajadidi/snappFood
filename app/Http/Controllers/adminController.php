<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    public function showComments()
    {

        $comments = Comment::with(['cart' => fn ($cart) => $cart->with(['cartItems' => fn ($cartItem) => $cartItem->with('food')])])->where('status', 'deleteRequest')->get();

        return view('admin/resturantComments', compact('comments'));
    }
    public function deleteComment(Request $request)
    {

        $commentID = $request->comment_ID;
        $comment = Comment::find($commentID);
        $comment->status = 'acceptdeleteRequest';
        $comment->save();
        return redirect()->route('adminComments');
    }
    public function acceptComment(Request $request)
    {
        $commentID = $request->comment_ID;
        $comment = Comment::find($commentID);
        $comment->status = 'active';
        $comment->save();
        return redirect()->route('adminComments');
    }
    public function showReports()
    {
        //carbon data
        $yesterday = Carbon::yesterday()->format('Y-m-d H:i:s');
        $twoDayAgo = Carbon::now()->subDay(2)->format('Y-m-d H:i:s');
        $threeDayAgo = Carbon::now()->subDay(3)->format('Y-m-d H:i:s');
        $fourDayAgo = Carbon::now()->subDay(4)->format('Y-m-d H:i:s');
        $fiveDayAgo = Carbon::now()->subDay(3)->format('Y-m-d H:i:s');
        $sixDayAgo = Carbon::now()->subDay(6)->format('Y-m-d H:i:s');
        $sevenDayAgo = carbon::now()->subDays(7)->format('Y-m-d H:i:s');
        $lastMonth = carbon::now()->subMonth()->format('Y-m-d H:i:s');
        $lastYear = carbon::now()->subYear()->format('Y-m-d H:i:s');

        //resturantdata
        $allTimeCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->get();
        $lastYearCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $lastYear)->get();
        $lastMonthCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $lastMonth)->get();
        $lastWeekCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $sevenDayAgo)->get();
        $yesterdayCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $yesterday)->get();
        $twoDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $twoDayAgo)->where('created_at', '<=', $yesterday)->get();
        $threeDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $threeDayAgo)->where('created_at', '<=', $twoDayAgo)->get();
        $fourDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $fourDayAgo)->where('created_at', '<=', $threeDayAgo)->get();
        $fiveDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $fiveDayAgo)->where('created_at', '<=', $fourDayAgo)->get();
        $sixDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $sixDayAgo)->where('created_at', '<=', $fiveDayAgo)->get();
        $sevenDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $sevenDayAgo)->where('created_at', '<=', $sixDayAgo)->get();
        //earn data  
        $allTimeEarn = $this->sumfinalPrice($allTimeCarts);
        $lastYearEarn = $this->sumfinalPrice($lastYearCarts);
        $lastMonthEarn = $this->sumfinalPrice($lastMonthCarts);
        $lastWeekEarn = $this->sumfinalPrice($lastWeekCarts);
        $yesterdayEarn = $this->sumfinalPrice($yesterdayCarts);
        $twoDayAgoEarn = $this->sumfinalPrice($twoDayAgoCarts);
        $threeDayAgoEarn = $this->sumfinalPrice($threeDayAgoCarts);
        $fourDayAgoEarn = $this->sumfinalPrice($fourDayAgoCarts);
        $fiveDayAgoEarn = $this->sumfinalPrice($fiveDayAgoCarts);
        $sixDayAgoEarn = $this->sumfinalPrice($sixDayAgoCarts);
        $sevenDayAgoEarn = $this->sumfinalPrice($sevenDayAgoCarts);



        // return $allTimeEarn;

        $data = [
            'allTimeEarn' => $allTimeEarn,
            'lastYearEarn' => $lastYearEarn,
            'lastMonthEarn' => $lastMonthEarn,
            'lastWeekEarn' => $lastWeekEarn,
            'yesterdayEarn' => $yesterdayEarn,
            'twoDayAgoEarn' => $twoDayAgoEarn,
            'threeDayAgoEarn' => $threeDayAgoEarn,
            'fourDayAgoEarn' => $fourDayAgoEarn,
            'fiveDayAgoEarn' => $fiveDayAgoEarn,
            'sixDayAgoEarn' => $sixDayAgoEarn,
            'sevenDayAgoEarn' => $sevenDayAgoEarn,
        ];


        return view('admin.adminReports', compact('data'));
    }
    public function sumfinalPrice($a)
    {
        $Earn = 0;
        foreach ($a as $b) {
            $Earn += (float)$b->payment->finalPrice;
        }
        return $Earn;
    }
}
