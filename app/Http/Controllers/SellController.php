<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sell;
use App\Models\SellProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Session;

class SellController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sells = Sell::latest()->get();
        return view('modules.sell.index', compact('sells'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'=>'required',
            'invoice_date'=>'required',
            'invoice_no'=>'required',
            'payment_method' => 'required',
            'sell_on_date'=> 'required'
        ]);
        if($validated){
            try{
                DB::beginTransaction();
                 $sell = Sell::create([
                    'customer_id' => $request->customer_id,
                    'invoice_date' => $request->invoice_date,
                    'invoice_no' => $request->invoice_no,
                    'note' => $request->note,
                    'total_amount' => $request->total_amount,
                    'paid_amount' => $request->paid_amount,
                    'user_id' => Auth::id(),
                    'sell_on_date' => $request->sell_on_date,
                    'payment_method' => $request->payment_method,
                    'bkash' => $request->bkash,
                    'rocket' => $request->rocket,
                    'nagud' => $request->nagud,
                    'bank' => $request->bank,
                 ]);



                if (!empty($sell)) {
                    $sell_id = $sell->id;
                    $product_id = $request->product_id;
                    for ($i=0; $i < count($product_id) ; $i++) {
                        $product = new SellProduct;
                        $product->product_id = $request->product_id[$i];
                        $product->sell_quantity = $request->sell_quantity[$i];
                        $product->sell_id = $sell_id;
                        $product->unit_selling_price = $request->unit_selling_price[$i];
                        $product->total_price = $request->total_price[$i];
                        $product->save();
                    }
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    $current_url = url()->previous();
                    if($current_url == "http://localhost:8000/pos"){
                        return redirect('/pos');
                    }else{
                        return redirect()->route('sell.index');
                    }
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                // DB::rollBack();
                return redirect()->route('sell.create');
            }
        }
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
        $item  = Sell::find($id);
        return view('modules.sell.details', compact('item'));
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
        $sell = Sell::find($id);
        $sell_payment = $sell->paid_amount + $request->paid_amount;
        $sell['paid_amount'] = $sell_payment;
        $sell->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $sell = Sell::find($id)->delete();
            if($sell){
                foreach (SellProduct::query()->SellProduct($id) as $sell){
                    SellProduct::find($sell->id)->delete();
                }
                DB::commit();
                Session::flash('delete','delete Sucessfully...');
                return redirect()->route('sell.index');
            }
        }catch(\Exception $ex){
            //DB::rollBack();
            return redirect()->route('sell.index');
        }
    }

    public function discount_percentage(Request $request,$id)
    {
        $sell = Sell::find($id);
        $sell['discount_percent'] = $request->discount_percent;
        $sell->save();
        return response()->json($sell, 200);
    }

    public function sell_product_show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'product'=>$product,
        ]);
    }

    public function status($id)
    {
        $sell = Sell::find($id);
        Sell::query()->Status($sell);
        Session::flash('status','update Sucessfully...');
        return redirect()->route('sell.index');
    }
}
