<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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


public function update(ProductUpdateRequest $request, string $id)
{
    $product = Product::findOrFail($id);

    // Update basic fields
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'short_description' => $request->short_description,
        'qty' => $request->qty,
        'sku' => $request->sku,
        'description' => $request->description,
    ]);

    // Update single image
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image && File::exists(public_path('uploads/' . $product->image))) {
            File::delete(public_path('uploads/' . $product->image));
        }

        $image = $request->file('image');
        $filename = $image->store('uploads', 'public');
        $product->image = $filename;
        $product->save();
    }

    // Add new multiple images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = $image->store('uploads', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $filename,
            ]);
        }
    }

    // Update colors: first delete existing then insert new
    if ($request->filled('productColors')) {
        // Delete old colors
        ProductColor::where('product_id', $product->id)->delete();

        // Add new colors
        foreach ($request->productColors as $color) {
            ProductColor::create([
                'product_id' => $product->id,
                'name' => $color,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    // Optional: Delete image file if stored locally
    if ($product->image && File::exists(public_path('uploads/' . $product->image))) {
        File::delete(public_path('uploads/' . $product->image));
    }

    $product->delete(); // Deletes the product from the database

    return redirect()->back()->with('success', 'Product deleted successfully!');
}
}
