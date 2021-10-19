<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('modules.sell.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::Active()->get();
        $contacts = Contact::where('contact_info', 'Customer')->Active()->get();
        return view('modules.sell.create', compact('products', 'contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $product = Product::find($id);
        $sell = Sell::create([
            'product_id' => $id,
            'author' => Auth::id(),
            'discount_percent' => $product->discount_percent,
        ]);
        return response()->json($sell, 200);
    }

    public function sell_author_all()
    {
        $sells = Sell::with('product','purchase')->where('Author', Auth::id())->where('order_id', null)->get();
        return response()->json($sells, 200);
    }

    public function quantity_update(Request $request,$id)
    {
        $sell = Sell::find($id);
        $sell['quantity'] = $request->quantity;
        $sell->save();
        return response()->json($sell, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sells = Sell::find($id)->delete();
        return response()->json($sells, 200);
    }

    public function discount_percentage(Request $request,$id)
    {
        $sell = Sell::find($id);
        $sell['discount_percent'] = $request->discount_percent;
        $sell->save();
        return response()->json($sell, 200);
    }
}
