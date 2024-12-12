<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request-> price,
            'image' => $request->imagePath,
        ]);

        return redirect() -> route('products.index')->with('succes', 'Product created succesfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=> 'required',
            'description' => 'required|string|max:1000',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Gunakan gambar lama jika tidak ada gambar baru
            $imagePath = $product->image;
        }

        $product->update([
            'name'=> $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);
        
        return redirect()->route('products.index')->with('success', 'Product updated succesfully');
    }

    public function destroy(Product $product){
        if ($product->image) {
            Storage::disk('public')->delete($product->image); // Menghapus gambar dari storage
        }

        $product->delete();

        return redirect()->route('product.indeex')->with('success', 'Product deleted successfully');
    }
}
