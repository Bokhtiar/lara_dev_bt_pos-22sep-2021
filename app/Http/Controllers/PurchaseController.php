<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index( )
    {
        return view('modules.purchase.index');
    }
    public function create()
    {
        $products = Product::Active()->get();
        return view('modules.purchase.create', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product, 200);
    }
}