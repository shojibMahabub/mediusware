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

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['date'])) {
            $query->where('created_at', 'like', '%' . $filters['date'] . '%');
        } 

        // if (isset($filters['variant'])) {
        //     $query->whereHas('variants', function ($q) use ($filters) {
        //         $q->where('title', 'like', '%' . $filters['variant'] . '%');
        //     });
        // }

        // if (isset($filters['price_from']) && isset($filters['price_to'])) {
        //     $query->whereHas('variants_prices_with_variants', function ($q) use ($filters) {
        //         $q->whereBetween('price', [$filters['price_from'], $filters['price_to']]);
        //     });
        // }
    }

}
