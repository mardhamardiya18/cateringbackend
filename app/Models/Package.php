<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Package extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'is_popular',
        'category_id',
        'city_id',
        'kitchen_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug']   = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function tiers()
    {
        return $this->hasMany(Tier::class);
    }
}
