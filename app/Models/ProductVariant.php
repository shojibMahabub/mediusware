<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    public function product () {
        return $this->hasOne(Product::class, 'product_id');
    }

    public function variant () {
        return $this->hasOne(Product::class, 'variant_id');
    }
}
