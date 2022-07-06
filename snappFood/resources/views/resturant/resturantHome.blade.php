@extends('layouts/resturantLayout')

@section('title')
adminPage
@endsection

@section('content')

<div class="grid grid-cols-2 gap-4 content-center ml-10">
  @can('created_resturant')
  <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><a href="/resturant/menu">my Menu</a> </button>
@endcan
    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><a href="/resturant/profile">my Profile</a> </button>
  </div>

@endsection
