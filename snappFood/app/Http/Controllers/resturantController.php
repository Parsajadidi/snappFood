<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Schedule;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Validation\validator;

class resturantController extends Controller
{
    public function ResturantStatus(Request $request){
    
        $status=$request->get('status');
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
        // dd($categories);
        return view('resturant.reseturantProfile', compact('categories'));
    }
    public function ResturantProfile(Request $request)
    {
        //validation
        // $request->validate([
        //     'name' => 'required|unique:resturants|max:20',
        //     'phone' => 'required|unique:resturants',
        //     'bankAccount' => 'required',
        //     "type" => 'required',
        //     'sat_start' => 'numeric|between:0,24',
        //     'sat_end' => 'numeric|between:0,24',
        //     'sun_start' => 'numeric|between:0,24',
        //     'sun_end' => 'numeric|between:0,24',
        //     'mon_start' => 'numeric|between:0,24',
        //     'mon_end' => 'numeric|between:0,24',
        //     'tue_start' => 'numeric|between:0,24',
        //     'tue_end' => 'numeric|between:0,24',
        //     'wed_start' => 'numeric|between:0,24',
        //     'wed_end' => 'numeric|between:0,24',
        //     'thu_start' => 'numeric|between:0,24',
        //     'thu_end' => 'numeric|between:0,24',
        //     'fri_start' => 'numeric|between:0,24',
        //     'fri_end' => 'numeric|between:0,24',
        // ]);
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
        // dd($category);
        $data = [$food, $category, $discount];
        // dd($data);
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
}
