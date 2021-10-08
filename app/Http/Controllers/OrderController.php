<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $orders = Order::latest()->get();
        return view('modules.order.index', compact('orders'));
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
                    'user_id' => Auth::id(),
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
                    return redirect()->route('order.index');
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
        $item  = Order::find($id);
        return view('modules.order.detail', compact('item'));
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
        $order = Order::find($id);
        $order_payment = $order->pay_amount + $request->pay_amount;
        $order['pay_amount'] = $order_payment;
        $order->save();
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
        Order::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('order.index');

    }

    public function status($id)
    {
        $order = Order::find($id);
        Order::query()->Status($order);
        Session::flash('status','update Sucessfully...');
        return redirect()->route('order.index');
    }
}
