<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryApiResource;
use App\Http\Resources\Api\PackageApiResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Package;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with(['packages'])->get();

        return CategoryApiResource::collection($categories);
    }

    public function show(Category $category)
    {
        $category->load(['packages', 'packages.city', 'packages.category', 'packages.tiers']);
        $category->loadCount('packages');

        return new CategoryApiResource($category);
    }

    public function filterPackages(Request $request)
    {
        $request->validate([
            'category_slug' => 'required|string',
            'city_slug'     => 'required|string',
        ]);

        $category = Category::where('slug', $request->category_slug)->first();
        $city = City::where('slug', $request->city_slug)->first();

        if (!$category || !$city) {
            return response()->json(['message' => 'Cateory of city not found'], 404);
        }

        $cateringPackages = Package::where('category_id', $category->id)
            ->where('city_id', $city->id)
            ->with(['city', 'kitchen', 'tiers', 'category'])
            ->get();

        return PackageApiResource::collection($cateringPackages);
    }
}
