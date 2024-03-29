@extends('layouts/resturantLayout')

@section('title')
resturantMenu
@endsection

@section('content')
<div class="my-4 grid grid-cols-1 content-center">
    <button type="button" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><a href="/resturant/add/food">Add Food</a> </button>
    <div class="ml-10">
    <form action="/resturant/menu" method="POST">
            @csrf
            <select name="category" id="">
            <option value="all">all</option>
                @foreach($category as $key=>$value)
                <option value="{{$category[$key]->id}}">{{$category[$key]->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">filter</button>
</form>
    </div>

</div>


<div class="grid grid-cols-3 gap-2">
@foreach($foods as $food)
<div>
    
<div class="ml-4 mt-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
   
        <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
   
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$food->name}}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$food->description}}</p>
        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$food->price}}T</span>
        <form action="/resturant/menu/edit/food" method="POST">
            @csrf
            <input type="hidden" name="food_id" value="{{$food->id}}">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit
            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>

            </button>
        </form>
        <form action="/resturant/menu/delete/food" method="POST">
            @csrf
            <input type="hidden" name="food_id" value="{{$food->id}}">
        <button type=" submit" class="mt-4 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
        </form>
        
        <span class="mt-4 inline-block bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{$food->category->name}}</span>
        <span class="mt-4 inline-block bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">discount:{{$food->discount->discountPercent}}%</span>

    </div>
</div>
</div>
@endforeach
</div>
<div class="mt-10">

</div>

@endsection