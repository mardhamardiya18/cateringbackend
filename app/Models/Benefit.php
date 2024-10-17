<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Benefit extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'tier_id'
    ];
}
