<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sell;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        return view('moduels.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'invoice_no'=>'required',
            'invoice_date'=>'required',
            'pay_amount'=>'required',
            'sell_on_date'=>'required',
            'payment_method'=>'required',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $order = Order::create([
                    'customer_id' => $request->customer_id,
                    'invoice_no' => $request->invoice_no,
                    'invoice_date' => $request->invoice_date,
                    'note' => $request->note,
                    'pay_amount' => $request->pay_amount,
                    'total_amount' => $request->total_amount,
                    'sell_on_date' => $request->sell_on_date,
                    'payment_method' => $request->payment_method,
                    'bkash' => $request->bkash,
                    'nagud' => $request->nagud,
                    'rocket' => $request->rocket,
                    'bank' => $request->bank,
                ]);
                if (!empty($order)) {
                    foreach (Sell::item_cart() as $sell) {
                        $sell['order_id']=$order->id;
                        $sell->save();
                    }
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect('/');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
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
        //
    }
}