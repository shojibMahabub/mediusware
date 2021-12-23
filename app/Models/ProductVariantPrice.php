<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }   

    public function color()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_one');
    }

    public function size()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_two');
    }

    public function style()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_three');
    }
}


