<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $filters = request()->only(['title', 'variant', 'price_from', 'price_to', 'date']);
        $variants = ProductVariant::select('variant')->groupBy('variant')->get();

        if ($filters) 
            $products = Product::with('variants_prices_with_variants')->filter($filters)->paginate(2);
        else 
            $products = Product::with('variants_prices_with_variants')->paginate(2);
        

        return view('products.index', compact('products', 'variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Log::debug($request->all());


        $product = new Product();
        $product = $product->createProductVariantPriceNow($request->all());

        Log::debug($product);
        Log::debug('hello');

        // // create a product instance
        // $product = Product::create($request->all());
        // foreach ($request->product_variant as $variant) {

        //     // Find variant by id
        //     $variantModel = Variant::findorFail($variant['option']);
        //     // attach variant to product
        //     foreach ($variant['tags'] as $tag) {
        //         $product->variants()->attach($variantModel, ['variant' => $tag]);
        //     }
        // }

        // foreach ($request->product_variant_prices as $price) {
        //     // Log::debug($price);
        //     $productVariantPrice = new ProductVariantPrice();
        //     $productVariantPrice->product_id = $product->id;
        //     $productVariantPrice->product_variant_one = $request->product_variant[0]['option'] ?? null;
        //     $productVariantPrice->product_variant_two = $request->product_variant[1]['option'] ?? null;
        //     $productVariantPrice->product_variant_three = $request->product_variant[2]['option'] ?? null;
        //     $productVariantPrice->price = $price['price'];
        //     $productVariantPrice->stock = $price['stock'];
        //     $productVariantPrice->save();
        // }



    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
