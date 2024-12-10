<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\SubscriptionResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\Tier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    public function store(SubscriptionRequest $request)
    {
        $validateData = $request->validate();

        $cateringPackage = Package::find($validateData['package_id']);

        if (!$cateringPackage) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $cateringTier = Tier::find($validateData['tier_id']);

        if (!$cateringTier) {
            return response()->json(['message' => 'Tier not found'], 404);
        }

        if ($request->hasFile('proof')) {
            $filePath = $request->file('proof')->store('payment/proofs', 'public');
            $validateData['proof'] = $filePath;
        }

        $startedAt = Carbon::parse($validateData['started_at']);
        $endedAt = $startedAt->copy()->addDays($cateringTier->duration);

        $price = $cateringTier->price;
        $tax = 0.11;
        $totalTax = $tax * $price;
        $grandTotal = $price + $tax;

        $validateData['price'] = $price;
        $validateData['total_tax_amount'] = $totalTax;
        $validateData['total_amount'] = $grandTotal;

        $validateData['quantity'] = $cateringTier->quantity;
        $validateData['duration'] = $cateringTier->duration;
        $validateData['city'] = $cateringPackage->city->name;
        $validateData['delivery_time'] = "lunch time";

        $validateData['started_at'] = $startedAt->format('Y-m-d');
        $validateData['ended_at']   = $endedAt->format('Y-m-d');

        $validateData['is_paid'] = false;

        $validateData['booking_trx_id'] = Subscription::generateUniqueTrxId();

        $bookingTransaction = Subscription::create($validateData);

        $bookingTransaction->load(['packages', 'tiers']);

        return new SubscriptionResource($bookingTransaction);
    }

    public function booking_details(Request $request)
    {
        $request->validate([
            'phone'     => 'required|string',
            'booking_trx_id'    => 'required|string',
        ]);

        $booking = Subscription::where('phone', $request->phone)
            ->where('booking_trx_id', $request->booking_trx_id)
            ->with([
                'packages',
                'packages.kitchen',
                'tiers'
            ])
            ->first();

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return new SubscriptionResource($booking);
    }
}
