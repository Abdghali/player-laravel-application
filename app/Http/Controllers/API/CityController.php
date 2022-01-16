<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Http\Resources\City\GeneralResource;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GeneralResource::collection(
            City::orderBy('updated_at')->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return new GeneralResource($city);
    }
}
