<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductPhoto extends Model
{
    protected $fillable = ['image'];

    public function product() {

        return $this->belongsTo('App\Models\Product');

    }
}
