@extends('layouts/resturantLayout')

@section('title')
resturantEditFood
@endsection

@section('content')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    NAME
                </th>
                <th scope="col" class="px-6 py-3">
                    PRICE
                </th>
                <th scope="col" class="px-6 py-3">
                    CATEGORY
                </th>
                <th scope="col" class="px-6 py-3">
                    DISCOUNT
                </th>
                <th scope="col" class="px-6 py-3">
                    DESCRIPTION
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{$data[0][0]->name}}
                </th>
                <td class="px-6 py-4">
                    {{$data[0][0]->price}}
                </td>
                <td class="px-6 py-4">
                    {{$data[0][0]->category->name}}
                </td>
                <td class="px-6 py-4">
                {{$data[0][0]->discount->discountPercent}}%
                    
                </td>
                <td class="px-6 py-4 text-right">
                {{$data[0][0]->description}}

                </td>
            </tr>
            <form action="/resturant/menu/edit/food/save" method="POST">
                @csrf
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    <input class="w-3/4" type="text" value="{{$data[0][0]->name}}" name="name">
                </th>
                <td class="px-6 py-4">
                    <input class="w-3/4"  type="number" name="price" value="{{$data[0][0]->price}}">
                </td>
                <td class="px-6 py-4">
                    <select name="category" id="">
                        @foreach($data[1] as $key=>$category)
                            <option value="{{$data[1][$key]->id}}">{{$data[1][$key]->name}}</option>
                        @endforeach 
                    </select>
                </td>
                <td class="px-6 py-4">
                <select name="discount" id="">
                        @foreach($data[2]  as $key=>$discount)
                            <option value="{{$data[2][$key]->id}}">{{$data[2][$key]->discountPercent}}</option>
                        @endforeach 
                    </select>
                </td>
                <td class="px-6 py-4 text-right">
                    <textarea name="description" id="" cols="25" rows="3" >{{$data[0][0]->description}}</textarea>
                </td>
            </tr>

        </tbody>
    </table>
    <input type="hidden" value="{{$data[0][0]->id}} " name="resturanId">
    <button type="submit" class="ml-4 mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save


    </form>

</div>



@endsection