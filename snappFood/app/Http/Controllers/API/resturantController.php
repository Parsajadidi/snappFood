<?php

namespace App\Http\Controllers\API;

use App\Models\Food;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\ResturantResource;

class resturantController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'category' => $request->category,
            'is_open' => $request->status
        ];



        $resturant = Resturant::with("category", "schedule");
        foreach ($filters as $key => $value) {
            if ($value != null) {
                if ($key == 'category') {
                    $categoryId = Category::where('name', $value)->get()->first();
                    $resturant->where('category_id', $categoryId->id);

                } else {
                    $resturant->where('is_open', $value);
                }
            }
        }
        $resturant_final = $resturant->get();
        return  ResturantResource::collection($resturant_final);
    }
  

    public function show($id)
    {
        return new ResturantResource(Resturant::find($id));
    }
    public function food($resturant_id)
    {

        return  FoodResource::collection(Food::where('resturant_id', $resturant_id)->get());
    }
}
