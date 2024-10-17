<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kitchen extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'year',
        'photo'
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }
}
