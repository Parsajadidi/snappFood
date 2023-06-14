@extends('layouts/adminLayout')

@section('title')
edit
@endsection

@section('content')



<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Title
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Edit Title
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Type
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Edit Type
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="border-b">
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$myCategory[0]->name}}
                            </td>
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                               <form action="/admin/category/edit/save" method="POST">
                                   @csrf
                                   <input class="text-gray-900 " name="name" type="text" value="{{$myCategory[0]->name}}">
                            </td>
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$myCategory[0]->type}}
                               
                            </td>
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            
                                <select class="text-gray-900 " name="type" id="">
                                    <option  value="food">Food</option>
                                    <option value="resturant">resturant</option>

                                </select>
                            </td>

                        </tr>


                    </tbody>
                </table>
                <input name="id" type="hidden" value={{$myCategory[0]->id}}>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save</button>
                </form>
                @endsection