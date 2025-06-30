<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        
        return view('admin.dashboard',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(ProductStoreRequest $request)
{
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->short_description = $request->short_description;
    $product->qty = $request->qty;
    $product->sku = $request->sku;
    $product->description = $request->description;
    $product->save();

    // insert main image
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = $image->store('uploads', 'public');
        
        // assuming product has `image` column
        $product->image = $filename;
        $product->save();
    }

    // insert multiple images
    if ($request->hasFile('images')) {
        foreach ($request->images as $image) {
            $filename = $image->store('uploads', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $filename,
            ]);
        }
    }

    // insert colors
    if ($request->filled('productColors')) {
        foreach ($request->productColors as $productColor) {
            ProductColor::create([
                'product_id' => $product->id,
                'name' => $productColor,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product added successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
         $color = $product->colors->pluck('name')->toArray();      
        return view('admin.product.edit',compact('product','color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
