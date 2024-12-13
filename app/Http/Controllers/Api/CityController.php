<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityApiResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function index()
    {
        $cities = City::with('packages')->get();
        return CityApiResource::collection($cities);
    }

    public function show(City $city)
    {
        $city->load(['packages', 'packages.category', 'packages.tiers']);
        $city->loadCount('packages');

        return new CityApiResource($city);
    }
}
