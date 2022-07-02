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
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save</button>
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