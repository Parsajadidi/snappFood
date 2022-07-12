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
@can('created_resturant')
<div class=" flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="  table-fixed  min-w-full text-center">
          <thead class="border-b">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                SATURDAY
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                SUNDAY
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                MONDAY
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                TUESDAY
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                WEDNESDAY
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                THURSDAY
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                FRIDAY
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b bg-gray-800 boder-gray-900">
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                {{$data[1][0]->saturday}}
              </td>
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                {{$data[1][0]->sunday}}
                  
              </td>
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
              {{$data[1][0]->monday}}
                
              </td>
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
              {{$data[1][0]->tuesday}}
                
              </td>
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
              {{$data[1][0]->wednesday}}
                
              </td>
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
              {{$data[1][0]->thursday}}
               
              </td>
              <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
              {{$data[1][0]->friday}}
               
              </td>
            </tr>
           
          </tbody>
        </table>
<div class="mt-5 w-[95%] m-auto relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">
          name
        </th>
        <th scope="col" class="px-6 py-3">
          status
        </th>
        <th scope="col" class="px-6 py-3">
          phone
        </th>
        <th scope="col" class="px-6 py-3">
          category
        </th>
        <th scope="col" class="px-6 py-3">
          bank Account
        </th>
        <th scope="col" class="px-6 py-3">
          Edit status
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
        {{$data[0][0]->name}}
        </th>
        <td class="px-6 py-4">
          <?php
          if ($data[0][0]->is_open == 1) {
            echo 'open';
          } else
            echo 'close';
          ?>

        </td>
        <td class="px-6 py-4">
          {{$data[0][0]->phone}}
        </td>
        <td class="px-6 py-4">
          {{$data[0][0]->category->name}}
        </td>
        <td class="px-6 py-4 ">
        {{$data[0][0]->bankAccount}}
        </td>
        <td class="px-6 py-4 ">
          <form action="/resturant/home/update/status" method="POST">
            @csrf
            <select name="status" id="">
              <option value="1">open</option>
              <option value="0">close</option>

            </select>
            
          </td>
        </tr>
      </tbody>
    </table>
   
  <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">update status </button>

  </form>
</div>

@endcan

@endsection