<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::latest()->paginate(5);
        return view('products', compact('products'));
    }
    // add product
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required',
        ], [
            'name.required' => 'Name is required',
            'name.unique' => 'Product already exists',
            'price.required' => 'Price is required',
        ]);

    
       $product = new Product();
       $product->name = $request->name;
       $product->price = $request->price;
       $product->save();
       return response()->json([
        'status' => 'success',
       ]);
    }
}
