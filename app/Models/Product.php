<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function variants_prices_with_variants()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id')->with('color', 'size', 'style');
    }

}
