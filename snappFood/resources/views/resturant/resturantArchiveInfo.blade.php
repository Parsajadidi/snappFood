@extends('layouts/resturantLayout')

@section('Info')
resturantMenu
@endsection

@section('content')
<hr><hr>
<h1 class="font-bold text-center mt-5 text-lime-600 font-sans">{{$cart['user']['name']}}</h1>
<h1 class="font-bold text-center mt-5 text-lime-600 font-sans">{{$cart['user']['phone']}}</h1>
<h1 class="font-bold text-center mt-5 text-lime-600 font-sans">{{$cart['user']['email']}}</h1>
<h1 class="font-bold text-center mt-5 text-lime-800 font-sans">FOODS:</h1>
<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full">
          <thead class="bg-white border-b">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                FOOD
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                PRICE
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                COUNT
              </th>
            </tr>
          </thead>
          <tbody>
              @foreach($cart['cart_items'] as $cartItem)
            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{$cartItem['food']['name']}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{$cartItem['food']['price']}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{$cartItem['count']}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="ml-5"> 
</div>


@endsection
