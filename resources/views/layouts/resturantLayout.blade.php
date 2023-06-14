<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />

  <script src="https://cdn.tailwindcss.com"></script>

    <title>$yield('title')</title>
</head>
<body >
<div class="h-1/2">
<x-app-layout>
    <x-slot name="header">
        
 
                    
    </x-slot>
    @yield('content')
</x-app-layout>
</div>



</body>
</html>