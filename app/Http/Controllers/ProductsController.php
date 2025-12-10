<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            Auth::loginUsingId(2);
        }
        $products = Product::all();
        return inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return inertia::render('Products/CreateProduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required'
        ]);

        Product::create(
            [
                'name' => $request->name,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity
            ]);
        return redirect()->route('products.index')->with('message', $request->name.' created successfully.');;

    }
}
