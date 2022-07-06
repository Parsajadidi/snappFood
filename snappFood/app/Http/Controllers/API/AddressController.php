<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {

        $addresses = DB::table('addresses')
            ->where('addressable_id', '=', auth()->user()->id)
            ->get();

        $addresses2 = User::query()->find(auth()->id())->addresses;

        return $addresses;
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string',
            'address' => 'required|string',
            "latitiude" => 'numeric|between:-90,90',
            "longitude" => 'numeric|between:-180,180',
        ]);

        Address::create([
            'title' => $request->title,
            'address' => $request->address,
            'latitiude' => $request->latitiude,
            'longitude' => $request->longitude,
            'addressable_id' => auth()->id(),
            'addressable_type' => 'buyer',
        ]);
        $respone = ['message' => 'address added'];
        return response($respone);
    }
    public function show($id)
    {
        $addresses2 = User::query()->find(auth()->id())->addresses()->find($id);
    }

    public function setActiveAddress($address_id)
    {

        Address::where("addressable_id", auth()->user()->id)
            ->update(["is_active" => 0]);

        $result = Address::where([["id", $address_id], ["addressable_id", auth()->user()->id]])
            ->update(["is_active" => 1]);
        if ($result == 1) {
            return response(['message' => "$address_id is activated"]);
        } else
            return response(['message' => "error"], 403);
    }
}
