<?php

namespace App\Http\Controllers\Api\v1\City;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\City\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index(Request $request)
    {
        $cities = City::with('cinemas')->paginate($request->has('per_page' ? $request->get('per_page') : 20));
        return CityResource::collection($cities);
    }


    public function store(Request $request)
    {
        //
    }


    public function show(City $city)
    {
        return CityResource::make($city->load('cinemas'));
    }


    public function update(Request $request, City $city)
    {
        //
    }


    public function destroy(City $city)
    {
        //
    }
}
