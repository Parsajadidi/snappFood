@extends('layouts/resturantLayout')

@section('title')
resturantProfile
@endsection

@section('content')
<div>
  <hr class="mt-4">
  <hr>
  <h1 class="text-center font-sans font-bold text-dark">Compelete Profile</h1>
  <hr>
  <hr>
</div>
<form action="/resturant/profile/save" method="POST">
  @csrf
  <div class=" grid h-screen place-items-center">
    <input class="my-2 rounded-lg" type="text" value="{{old('name')}}" name="name" placeholder="Resturant name" required>
    <input class="my-2 rounded-lg" type="number" name="phone" placeholder="Resturant phone" required>
    <input class="my-2 rounded-lg" type="number" name="bankAccount" placeholder="Resturant bankAccount " required>
    <label class="my-10" for="5">Choose type for your resturant</label>
    <select class="mb-10" name="type" id="5" required>
      @foreach($categories as $category)
      <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
    <div w-64>




      <label class="mt-10" for="">-------------------------Choose a location for your resturant:----------------------</label>
      <x-maps-leaflet :centerPoint="['lat' => 35.7219, 'long' => 51.3347]"></x-maps-leaflet>



    </div>

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="table-fixed  min-w-full text-center">
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
                    <input name="sat-start" class="w-16 text-slate-900" type="number">
                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="sun-start" class="w-16 text-slate-900" type="number">
                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="mon-start" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="tue-start" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="wed-start" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="thu-start" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="fri-start" class="w-16 text-slate-900" type="number">

                  </td>
                </tr>
                <tr class="border-b bg-gray-800 boder-gray-900">
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="sat-end" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="sun-end" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="mon-end" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="tue-end" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="wed-end" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="thu-end" class="w-16 text-slate-900" type="number">

                  </td>
                  <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                    <input name="fri-end" class="w-16 text-slate-900" type="number">

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
          <span class="font-medium"></span> {{$error}}
        </div>
        @endforeach
      </ul>
    </div>
    @endif



    <button type="submit" class=" inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save</button>
  </div>
</form>
@endsection