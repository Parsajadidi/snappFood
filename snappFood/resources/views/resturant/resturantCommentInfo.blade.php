@extends('layouts/resturantLayout')

@section('title')
resturantMenu
@endsection

@section('content')
<h1 class="shadow-md font-mono text-center font-extrabold text-5xl">USER INFO</h1>
<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full">
                    <thead class="border-b">
                        <th scope="col" class="text-bold text-lg font-medium text-gray-900 px-6 py-4 text-left">
                            ID
                        </th>
                        <td scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$comment->cart->user->id}}
                        </td>

                        </tr>
                        <th scope="col" class="text-bold text-lg font-medium text-gray-900 px-6 py-4 text-left">
                            PHONE
                        </th>
                        <td scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$comment->cart->user->phone}}
                        </td>

                        </tr>
                        <tr>
                            <th scope="col" class="text-bold text-lg font-medium text-gray-900 px-6 py-4 text-left">
                                Name
                            </th>
                            <td scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{$comment->cart->user->name}}
                            </td>

                        </tr>
                    </thead>
                    <tbody>
                        <th scope="col" class="text-bold text-lg font-medium text-gray-900 px-6 py-4 text-left">
                            Comment
                        </th>
                        <td scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$comment->comment}}
                        </td>
                        </tr>
                        <th scope="col" class="text-bold text-lg font-medium text-gray-900 px-6 py-4 text-left">
                            Score
                        </th>
                        <td scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            {{$comment->score}}
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<h1 class="shadow-md font-mono text-center font-extrabold text-5xl">FOOD INFO</h1>


<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                FOOD
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                COUNT
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comment->cart->cartItems as $cartItem)
                        <tr class="border-b">
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$cartItem->food->name}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$cartItem->count}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<h1 class="shadow-md font-mono text-center font-extrabold text-5xl">ANSWER</h1>
<form action="/resturant/comment/info/answer" method='POST'>
    @csrf
    <div class="ml-5">

        <input type="hidden" name="comment_ID" value="{{$comment->id}}">
        <input type="text" name="answer" placeholder="answer to the comment">
        <button type=" submit" class="mt-4 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">ANSWER
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </button>
    </div>

</form>

@endsection