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
}
