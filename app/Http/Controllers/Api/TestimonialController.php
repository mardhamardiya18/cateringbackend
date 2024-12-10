<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\TestimonialResource;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        $testimonials = Testimonial::with('packages')->get();

        return TestimonialResource::collection($testimonials);
    }
}
