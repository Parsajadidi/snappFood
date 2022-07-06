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
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save</button>
    </form> 
    </div>


@endsection