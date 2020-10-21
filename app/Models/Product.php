<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Models\ProductPhoto;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'body',
        'price',
        'slug'
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

    public function store() {
        
        return $this->belongsTo('App\Models\Store');

    }

    public function categories() {

        return $this->belongsToMany('App\Models\Category');
    }

    public function photos() {

        return $this->hasMany('App\Models\ProductPhoto');

    }
}
