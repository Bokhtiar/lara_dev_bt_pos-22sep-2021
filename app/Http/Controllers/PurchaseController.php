<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
        $suppliers = Contact::where('contact_info', 'Supplier')->get();
        $products = Product::Active()->get();
        return view('modules.purchase.create', compact('products', 'suppliers'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product, 200);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}