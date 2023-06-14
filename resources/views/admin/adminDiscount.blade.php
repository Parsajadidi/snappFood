@extends('layouts/adminLayout')

@section('title')
discount
@endsection

@section('content')

<div>
    <div class="mt-5 ml-10">
    <form action="/admin/discount/add" method="POST">
        @csrf
        <input name="discountPercent" type="text" placeholder="  discount percent ">
   

        <button type="submit" class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">ADD</button>

    </form>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    discount
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Edit
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                            <tr class="border-b">
                                <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$discount->discountPercent}}  %
                                </td>
  
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="/admin/discount/edit">
                                        @csrf
                                        <input name="id" type="hidden" value={{$discount->id}}>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</button>
                                    </form>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="/admin/discount/delete" >

                                        @csrf
                                        <input name="id" type="hidden" value={{$discount->id}}>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection