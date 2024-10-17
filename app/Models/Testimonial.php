<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'message',
        'photo',
        'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
