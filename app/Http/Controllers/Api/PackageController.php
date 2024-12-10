<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\PackageResource;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
    public function index()
    {
        $cateringPackages = Package::with(['city', 'kitchen', 'category', 'tiers', 'tiers.benefits'])->get();

        return PackageResource::collection($cateringPackages);
    }

    public function show(Package $package)
    {
        $package->load([
            'city',
            'photos',
            'bonuses',
            'category',
            'kitchen',
            'testimonials',
            'tiers',
            'tiers.benefits'
        ]);

        $package->loadCount('packages');

        return new PackageResource($package);
    }
}
