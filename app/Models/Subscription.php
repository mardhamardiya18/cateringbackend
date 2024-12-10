<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'booking_trx_id',
        'name',
        'phone',
        'email',
        'delivery_time',
        'proof',
        'city',
        'post_code',
        'notes',
        'address',
        'total_amount',
        'price',
        'duration',
        'quantity',
        'total_tax_amount',
        'is_paid',
        'started_at',
        'ended_at',
        'package_id',
        'tier_id'
    ];

    protected $cast = [
        'started_at'    => 'date',
        'ended_at'      => 'date'
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'CTR';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
