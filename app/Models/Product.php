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

    // function to get variants from product
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'product_variants');
    }

    // implement function vatiant prices from controller
    public function variants_prices()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id');
    }
    
    public function createProductVariantPriceNow($request)
    {

        $product = Product::create($request);

        $product = $this->attachVariant($product, (object) $request);

        $product = $this->attachStockPrice($product, (object) $request);

        return $product;
    
    }

    public function attachStockPrice($product, $request)
    {
        foreach ($request->product_variant_prices as $price) {
            $productVariantPrice = new ProductVariantPrice();
            $productVariantPrice->product_id = $product->id;
            $productVariantPrice->product_variant_one = $request->product_variant[0]['option'] ?? null;
            $productVariantPrice->product_variant_two = $request->product_variant[1]['option'] ?? null;
            $productVariantPrice->product_variant_three = $request->product_variant[2]['option'] ?? null;
            $productVariantPrice->price = $price['price'];
            $productVariantPrice->stock = $price['stock'];
            $productVariantPrice->save();
        }  
        
        return $product;
    }

    public function attachVariant($product, $request)
    {

        foreach ($request->product_variant as $variant) {
            $variantModel = Variant::findorFail($variant['option']);
            foreach ($variant['tags'] as $tag) {
                $product->variants()->attach($variantModel, ['variant' => $tag]);
            }
        }
        return $product;
    
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['date'])) {
            $query->where('created_at', 'like', '%' . $filters['date'] . '%');
        } 
    }

}
