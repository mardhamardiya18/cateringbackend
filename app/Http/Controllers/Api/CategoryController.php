<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\CategoryResource;
use App\Http\Controllers\Controller;
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

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $category->load(['packages', 'packages.city', 'packages.category', 'packages.tiers']);
        $category->loadCount('packages');

        return new CategoryResource($category);
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
            ->where('city_id', $city)
            ->with(['city', 'kitchen', 'tiers', 'category'])
            ->get();

        return Package::collection($cateringPackages);
    }
}
