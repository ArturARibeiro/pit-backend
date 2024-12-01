<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressStoreRequest $request): AddressResource
    {
        $address = new Address();
        $address->user_id = $request->user()->id;
        $address->name = $request->input('name');
        $address->zip_code = preg_replace('/\D/', '', $request->input('zip_code'));
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->district = $request->input('district');
        $address->street = $request->input('street');
        $address->number = $request->input('number');
        $address->complement = $request->input('complement');
        $address->save();

        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address): AddressResource
    {
        return new AddressResource($address);
    }
}
