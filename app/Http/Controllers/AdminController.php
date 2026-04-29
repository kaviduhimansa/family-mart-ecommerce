<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    /**
     *  (SRS 4.6 - Category Integration)
     */
    public function create()
    {
        // Fetch all categories from the database and pass them to the view.
        $categories = Category::all();
        return view('admin.create_product', compact('categories'));
    }

    /**
     * Create a new product and store it in the database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload the image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }

    /**
     * Delete an existing product
     */
    public function destroy(Product $product)
    {
        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.edit_product', compact('product', 'categories'));
    }

    /**
     * Update the specified product in the database
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image.
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $product->image,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    public function categoriesIndex() 
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }
}