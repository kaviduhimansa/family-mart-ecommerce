<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Function to display all products on the home page
    public function index()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('welcome', compact('products'));
    }
}