<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function product () {
        return $this->belongsToMany(Product::class, 'product_id');
    }
    
    // public function product () {
    //     return $this->belongsToMany(Product::class)->using(ProductVariant::class);
    // }

    // public function variants_prices_with_variants()
    // {
    //     return $this->hasMany(ProductVariantPrice::class, 'product_id')->with('color', 'size', 'style');
    // }

}
