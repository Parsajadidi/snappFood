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
    <div class="grid h-screen place-items-center">
        <input class="my-2 rounded-lg" type="text" name="name" placeholder="Resturant name" required>
        <input class="my-2 rounded-lg" type="number" name="phone" placeholder="Resturant phone" required>
        <input class="my-2 rounded-lg" type="number" name="bankAccount" placeholder="Resturant bankAccount " required>
        <label for="">Choose type for your resturant</label>
        <select name="type" id="5" required>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="mt-4 ml-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
    </div>
</form>
<script>
    import mapboxgl from 'mapbox-gl'; // or "const mapboxgl = require('mapbox-gl');"

    // TO MAKE THE MAP APPEAR YOU MUST
    // ADD YOUR ACCESS TOKEN FROM
    // https://account.mapbox.com
    mapboxgl.accessToken = '<your access token here>';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [-74.5, 40], // starting position [lng, lat]
        zoom: 9, // starting zoom
        projection: 'globe' // display the map as a 3D globe
    });
    map.on('style.load', () => {
        map.setFog({}); // Set the default atmosphere style
    });
</script>
@endsection