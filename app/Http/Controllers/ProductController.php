<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('product_kategori', 'asc')->get();
        return view("admin.product.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate(Product::$rules);

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('product_gambar')) {
            // Store the image in the 'public' disk and get the path
            $imagePath = $request->file('product_gambar')->store('images', 'public');
        }

        // Create the catalogue with the uploaded image path
        Product::create([
            'product_gambar' => $imagePath,
            'product_nama' => $request->product_nama,
            'product_deskripsi' => $request->product_deskripsi,
            'product_kategori' => $request->product_kategori,
            'product_harga' => $request->product_harga,
            'status_publish' => $request->status_publish,
            'created_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
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
        return view('admin.product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Product::$rules);

        // Find the catalogue by ID
        $product = Product::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('product_gambar')) {
            $imagePath = $request->file('product_gambar')->store('images', 'public');

            // Delete the old image if it exists
            if ($product->product_gambar) {
                Storage::disk('public')->delete($product->product_gambar);
            }

            // Update the catalogue with the new image path
            $product->update([
                'product_gambar' => $imagePath,
                'product_nama' => $request->product_nama,
                'product_deskripsi' => $request->product_deskripsi,
                'product_kategori' => $request->product_kategori,
                'product_harga' => $request->product_harga,
                'status_publish' => $request->status_publish,
                'created_at' => now(),
            ]);
        } else {
            // Update the catalogue without changing the image path
            $product->update([
                'product_nama' => $request->product_nama,
                'product_deskripsi' => $request->product_deskripsi,
                'product_kategori' => $request->product_kategori,
                'product_harga' => $request->product_harga,
                'status_publish' => $request->status_publish,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // Delete the associated image file if it exists
        if ($product->product_gambar) {
            Storage::disk('public')->delete($product->product_gambar);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Catalogue deleted successfully.');
    }
}
