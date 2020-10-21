<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Product;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile_phone',
        'slug',
        'logo',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user() {

       return $this->belongsTo('App\User');
    }

    public function products() {

        return $this->hasMany('App\Models\Product');
    }
}
