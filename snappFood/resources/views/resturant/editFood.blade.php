@extends('layouts/resturantLayout')

@section('title')
resturantEditFood
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
                                {{$data[0]->category->name}}
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$data[0]->description}}

                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$data[0]->price}}

                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$data[0]->category->name}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="border-b">
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                
                            </td>
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                               <form action="/admin/category/edit/save" method="POST">
                                   @csrf
                                   <input class="text-gray-900 " name="name" type="text" value="">
                            </td>
                            <td class="text-lg font-sans text-slate-50 font-light px-6 py-4 whitespace-nowrap">
                                
                               
                            </td>
                            <td class="text-lg font-sans text-slate-50   text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            
                               
                            </td>

                        </tr>


                    </tbody>
                </table>

@end section