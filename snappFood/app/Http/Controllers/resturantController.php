<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Schedule;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use illuminate\Validation\validator;

class resturantController extends Controller
{
    public function ResturantStatus(Request $request)
    {

        $status = $request->get('status');
        //update status
        Resturant::where('user_id', auth()->user()->id)->update([
            'is_open' => $status,

        ]);

        return redirect()->route('resturantHome');
    }

    public function showResturantProfile()
    {


        $categories = DB::table('categories')
            ->where('type', '=', 'resturant')
            ->select('*')
            ->get()
            ->toArray();


        if (Gate::allows('created_resturant')) {
            $resturantInfo = Resturant::where('user_id', auth()->user()->id)->first();
            return view('resturant.reseturantProfile', compact('resturantInfo','categories'));
        }

        return view('resturant.reseturantProfile', compact('categories'));
    }
    public function ResturantProfile(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|unique:resturants|max:20',
            'phone' => 'required|unique:resturants',
            'bankAccount' => 'required',
            "type" => 'required',
            'sat_start' => 'numeric|between:0,24',
            'sat_end' => 'numeric|between:0,24',
            'sun_start' => 'numeric|between:0,24',
            'sun_end' => 'numeric|between:0,24',
            'mon_start' => 'numeric|between:0,24',
            'mon_end' => 'numeric|between:0,24',
            'tue_start' => 'numeric|between:0,24',
            'tue_end' => 'numeric|between:0,24',
            'wed_start' => 'numeric|between:0,24',
            'wed_end' => 'numeric|between:0,24',
            'thu_start' => 'numeric|between:0,24',
            'thu_end' => 'numeric|between:0,24',
            'fri_start' => 'numeric|between:0,24',
            'fri_end' => 'numeric|between:0,24',
        ]);
        //info
        $name = $request->get('name');
        $phone = $request->get('phone');
        $bankAccount = $request->get('bankAccount');
        $type = $request->get('type');
        //days......................................
        $sat_start = $request->get('sat-start');
        $sat_end = $request->get('sat-end');

        $sun_start = $request->get('sun-start');
        $sun_end = $request->get('sun-end');

        $mon_start = $request->get('mon-start');
        $mon_end = $request->get('mon-end');

        $tue_start = $request->get('tue-start');
        $tue_end = $request->get('tue-end');

        $wed_start = $request->get('wed-start');
        $wed_end = $request->get('wed-end');

        $thu_start = $request->get('thu-start');
        $thu_end = $request->get('thu-end');

        $fri_start = $request->get('fri-start');
        $fri_end = $request->get('fri-end');
        //insert into dataBase
        if (Resturant::where('user_id', auth()->user()->id)->get()->toArray() != []) {
            $resturantInfo = Resturant::where('user_id', auth()->user()->id)->update([
                'name' => $name,
                'phone' => $phone,
                'bankAccount' => $bankAccount,
                'category_id' => $type,
                'user_id' => auth()->user()->id,
                'is_open' => 1,

            ]);
            $resturantid = Resturant::where('user_id', auth()->user()->id)->get()->toArray();
            $result = Schedule::where('resturant_id', $resturantid[0]['id'])->update([
                'saturday' => "$sat_start _ $sat_end",
                'sunday' => "$sun_start _ $sun_end",
                'monday' => "$mon_start _ $mon_end",
                'tuesday' => "$tue_start _ $tue_end",
                'wednesday' => "$wed_start _ $wed_end",
                'thursday' => "$thu_start _ $thu_end",
                'friday' => "$fri_start _ $fri_end"
            ]);
        } else {
            $resturantInfo = Resturant::create([
                'name' => $name,
                'phone' => $phone,
                'bankAccount' => $bankAccount,
                'category_id' => $type,
                'user_id' => auth()->user()->id,
                'is_open' => 1,

            ]);
            Schedule::create([
                'resturant_id' => $resturantInfo->id,
                'saturday' => "$sat_start _ $sat_end",
                'sunday' => "$sun_start _ $sun_end",
                'monday' => "$mon_start _ $mon_end",
                'tuesday' => "$tue_start _ $tue_end",
                'wednesday' => "$wed_start _ $wed_end",
                'thursday' => "$thu_start _ $thu_end",
                'friday' => "$fri_start _ $fri_end"
            ]);
        }



        return redirect()->route('resturantHome');
    }
    public function showResturantMenu(Request $request)
    {

        //info
        $foods = Food::with('category', 'discount')->where('resturant_id', auth()->user()->resturant->id)->get();
        $category = $request->get('category');
        $category = DB::table('categories')
            ->select('*')
            ->where("type", '=', 'food')
            ->get()
            ->toArray();


        return view('resturant/resturantMenu', ['category' => $category], compact('foods'));
    }
    public function showResturantAddFood()
    {
        $categories = DB::table('categories')
            ->where('type', '=', 'food')
            ->select('*')
            ->get()
            ->toArray();

        $discounts = DB::table('discounts')
            ->select('*')
            ->get()
            ->toArray();
        $data = [$categories, $discounts];
        return view('resturant/resturantAddFood', compact('data'));
    }
    public function ResturantAddFood(Request $request)
    {
        $request->validate([
            'price' => 'numeric',
        ]);

        $foodName = $request->get('name');
        $foodPrice = $request->get('price');
        $foodDescription = $request->get('description');
        $foodDiscount = $request->get('discount');
        $foodCategory = $request->get('type');
        $foodParty = $request->get('foodParty');

        Food::create([
            'name' => $foodName,
            'price' => $foodPrice,
            'description' => $foodDescription,
            'discount' => $foodDiscount,
            'category_id' => $foodCategory,
            'discount_id' => $foodDiscount,
            'is_foodParty' => $foodParty,
            'resturant_id' => auth()->user()->resturant->id
        ]);

        return redirect()->route('resturantMenu');
    }
    public function ResturantDeleteFood(request $request)
    {
        $food_id = $request->get('food_id');

        $food = DB::table('food')
            ->where('id', '=', $food_id)
            ->delete();

        return redirect()->route('resturantMenu');
    }
    public function ResturantEditFood(request $request)
    {
        $food_id = $request->get('food_id');


        $food = Food::with(['category', 'discount'])->where('id', $food_id)->get();

        $category = Category::where('type', 'food')->get();
        $discount = Discount::all();

        $data = [$food, $category, $discount];

        return view('resturant/editFood', compact('data'));
    }
    public function ResturantMenu(Request $request)
    {
        $categoryId = $request->get('category');
        if ($categoryId == 'all') {

            $foods = Food::with(['category', 'discount'])
                ->where('resturant_id', auth()->user()->resturant->id)
                ->get();
        } else {

            $foods = Food::with(['category', 'discount'])
                ->where([['resturant_id', auth()->user()->resturant->id], ['category_id', $categoryId]])->get();
        }
        $category = DB::table('categories')
            ->select('*')
            ->where("type", '=', 'food')
            ->get()
            ->toArray();


        return view('resturant/resturantMenu', ['category' => $category], compact('foods'));
    }
    public function ResturantEditFoodSave(Request $request)
    {

        $foodId = $request->get('resturanId');
        $foodName = $request->get('name');
        $foodPrice = $request->get('price');
        $foodCategoty = $request->get('category');
        $fooddiscount = $request->get('discount');
        $foodDescription = $request->get('description');



        $food = Food::find($foodId);
        $food->name = $foodName;
        $food->price = $foodPrice;
        $food->category_id = $foodCategoty;
        $food->discount_id = $fooddiscount;
        $food->description = $foodDescription;
        $food->save();
        return redirect()->route('resturantMenu');
    }
    public function showComments()
    {
        $comments = Comment::with(['cart' => fn ($cart) => $cart->with(['cartItems' => fn ($cartItem) => $cartItem->with('food')])])->whereRelation("cart", "resturant_id", "=", auth()->user()->resturant->id)->where('status', 'waiting')->orderBy('created_at', 'desc')->get();

        return view('resturant/resturantComments', compact('comments'));
    }
    public function commentDeleteReq(Request $request)
    {
        $commentID = $request->comment_ID;
        $comment = Comment::find($commentID);
        $comment->status = 'deleteRequest';
        $comment->save();
        return redirect()->route('resturantComments');
    }
    public function commentAccept(Request $request)
    {
        $commentID = $request->comment_ID;
        $comment = Comment::find($commentID);
        $comment->status = 'active';
        $comment->save();
        return redirect()->route('resturantComments');
    }
    public function commentInfo(Request $request)
    {

        $commentID = $request->comment_ID;

        $comment = $comments = Comment::with(['cart' => fn ($cart) => $cart->with(['cartItems' => fn ($cartItem) => $cartItem->with('food')])])->find($commentID);
        return view('resturant/resturantCommentInfo', compact('comment'));
    }
    public function commentAnswer(Request $request)
    {
        $commentID = $request->comment_ID;
        $answer = $request->answer;
        $comment = Comment::find($commentID);
        $comment->answer = $answer;
        $comment->save();
        return redirect()->route('resturantComments');
    }
    public function sumfinalPrice($a)
    {
        $Earn = 0;
        foreach ($a as $b) {
            $Earn += (float)$b->payment->finalPrice;
        }
        return $Earn;
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
        $allTimeCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->get();
        $lastYearCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $lastYear)->get();
        $lastMonthCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $lastMonth)->get();
        $lastWeekCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $sevenDayAgo)->get();
        $yesterdayCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $yesterday)->get();
        $twoDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $twoDayAgo)->where('created_at', '<=', $yesterday)->get();
        $threeDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $threeDayAgo)->where('created_at', '<=', $twoDayAgo)->get();
        $fourDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $fourDayAgo)->where('created_at', '<=', $threeDayAgo)->get();
        $fiveDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $fiveDayAgo)->where('created_at', '<=', $fourDayAgo)->get();
        $sixDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $sixDayAgo)->where('created_at', '<=', $fiveDayAgo)->get();
        $sevenDayAgoCarts = Cart::with(['payment'])->where('is_pay', true)->where('resturant_id', auth()->user()->resturant->id)->whereRelation("payment", "staus", "=", "delivered")->where('created_at', '>=', $sevenDayAgo)->where('created_at', '<=', $sixDayAgo)->get();
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
        return view('resturant/resturantReports', compact('data'));
    }
}
