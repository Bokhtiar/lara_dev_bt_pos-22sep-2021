<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index( )
    {
        $purchases = Purchase::get(['id','product_id', 'supplier_id', 'amount', 'line_total']);
        return view('modules.purchase.index',compact('purchases'));
    }
    public function create()
    {
        $suppliers = Contact::where('contact_info', 'Supplier')->get();
        $products = Product::Active()->get();
        return view('modules.purchase.create', compact('products', 'suppliers'));
    }

    public function show($id)
    {
        $purchase = Purchase::find($id);
        return view('modules.purchase.show', compact('purchase'));
    }

    public function product_show($id)
    {
        $product = Product::find($id);
        return response()->json($product, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id'=>'required',
            'purchase_date'=>'required',
            'reference_no'=>'required',
            'product_id' => 'required',
            'purchase_quantity' => 'required',
            'unit_cost' => 'required',
            'amount' => 'required',
            'purchase_date' => 'required',
            'paid_on_date' => 'required',
            'payment_method'=> 'required'
        ]);

        if($validated){

            try{

                DB::beginTransaction();
                $purchase = Purchase::create([
                    'supplier_id' => $request->supplier_id,
                    'reference_no' => $request->reference_no,
                    'purchase_date' => $request->purchase_date,
                    'attech_file' => 'NOT FILE',
                    'note' => $request->note,
                    'product_id' => $request->product_id,
                    'purchase_quantity' => $request->purchase_quantity,
                    'unit_cost' => $request->unit_cost,
                    'discount_percent' => $request->discount_percent,
                    'tax' => $request->tax,
                    'line_total' => $request->line_total,
                    'profit_margin' => $request->profit_margin,
                    'unit_selling_price' => $request->unit_selling_price,
                    'amount' => $request->amount,
                    'paid_on_date' => $request->paid_on_date,
                    'payment_method' => $request->payment_method,
                    'bkash' => $request->bkash,
                    'rocket' => $request->rocket,
                    'nagud' => $request->nagud,
                    'bank' => $request->bank,
                ]);
                $product = Product::find($request->product_id);
                $product['purchase_id'] = $purchase->id;
                $product['discount_percent'] = $request->discount_percent;
                $product['tax'] = $request->tax;
                $product['unit_selling_price'] = $request->unit_selling_price;
                $product->save();

                if (!empty($purchase)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('purchase.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
    }

    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $suppliers = Contact::where('contact_info', 'Supplier')->get();
        $products = Product::Active()->get();
        return view('modules.purchase.edit', compact('purchase','suppliers','products'));
    }

    public function destroy($id)
    {
        Purchase::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('purchase.index');

    }



}