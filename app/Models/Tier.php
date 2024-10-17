<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'tagline',
        'quantity',
        'price',
        'duration',
        'package_id'
    ];

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function Package()
    {
        return $this->belongsTo(Package::class);
    }
}
