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
                                discount percent
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Edit discount percent
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="border-b">
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$myDiscount[0]->discountPercent}}
                            </td>
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                               <form action="/admin/discount/edit/save" method="POST">
                                   @csrf
                                   <input class="text-gray-900 " name="discountPercent" type="number" placeholder="   Edit discountPercent">
                            </td>
                  

                        </tr>


                    </tbody>
                </table>
                <input name="id" type="hidden" value={{$myDiscount[0]->id}}>
                <button type="submit" class="mt-4 ml-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
                </form>
@endsection