@extends('layouts/resturantLayout')

@section('title')
adminPage
@endsection

@section('content')

<div class="grid grid-cols-2 gap-4 content-center ml-10">
  <button type="button" class="inline-block w-3/4   my-4 px-6 py-2.5 bg-green-700 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out"><a href="/resturant/menu">my Menu</a> </button>
  <button type="button" class="w-3/4 my-4 inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md  hover:shadow-lg  hover:bg-blue-600 focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out"><a href="/resturant/profile">my Profile</a> </button>
  </div>

@endsection
