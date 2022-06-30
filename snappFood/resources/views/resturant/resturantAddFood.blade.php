@extends('layouts/resturantLayout')

@section('title')
resturantAddFood
@endsection

@section('content')
<form method="POST" action="/resturant/add/food/save">
    @csrf
        <div class="grid h-screen place-items-center">
        <input class="my-2 rounded-lg" type="text" name="name" placeholder="Food name"  required>
        <input  class="mt-2 mb-16  rounded-lg" type="number" name="price" placeholder="Food price (toman)"  required>
        <textarea class="my-5 resize-none" name="description" id="" cols="30" rows="5" placeholder="description"></textarea>
        <label class="mt-10" for="">Choose dicount for your resturant</label>
        <select class="my-5 " name="discount" id="5" required>
            @foreach($data[1] as $discount)
                <option value="{{$discount->id}}">{{$discount->discountPercent}}</option>
            @endforeach
        </select>
        <label for="">Choose category for your food</label>
        <select class="mt-5" name="type" id="5" required>
            @foreach($data[0] as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <label class="mt-5" for="">Food party</label>
        <input     type="checkbox"  name="foodParty" value="1">
        <button type="submit" class="mt-4 ml-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
    </form> 
    </div>


@endsection