<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index( )
    {
        $purchases = Purchase::all();
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
        $item = Purchase::find($id);
        return view('modules.purchase.show', compact('item'));
    }

    public function product_show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'product'=>$product,
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'supplier_id'=>'required',
            'purchase_date'=>'required',
            'reference_no'=>'required',
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
                    'user_id' => Auth::id(),
                    'paid_on_date' => $request->paid_on_date,
                    'payment_method' => $request->payment_method,
                    'total_amount' => $request->total_amount,
                    'paid_amount' => $request->paid_amount,
                    'bkash' => $request->bkash,
                    'rocket' => $request->rocket,
                    'nagud' => $request->nagud,
                    'bank' => $request->bank,
                 ]);

                if (!empty($purchase)) {
                    $purchase_id = $purchase->id;
                    $product_id = $request->product_id;
                    for ($i=0; $i < count($product_id) ; $i++) {
                        $product = new PurchaseProduct;
                        $product->product_id = $request->product_id[$i];
                        $product->purchase_quantity = $request->purchase_quantity[$i];
                        $product->purchase_id = $purchase_id;
                        $product->unit_price = $request->unit_price[$i];
                        $product->total_price = $request->total_price[$i];
                        $product->save();
                    }
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'supplier_id'=>'required',
            'purchase_date'=>'required',
            'reference_no'=>'required',
            'product_id' => 'required',
            'purchase_quantity' => 'required',
            'unit_cost' => 'required',
            'amount' => 'required',
            'paid_on_date' => 'required',
            'payment_method'=> 'required'
        ]);

        if($validated){

            try{

                DB::beginTransaction();
                $purchase = Purchase::find($id);
                $purchaseU = $purchase->update([
                    'supplier_id' => $request->supplier_id,
                    'reference_no' => $request->reference_no,
                    'purchase_date' => $request->purchase_date,
                    'attech_file' => 'NOT FILE',
                    'note' => $request->note,
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'purchase_quantity' => $request->purchase_quantity,
                    'unit_cost' => $request->unit_cost,
                    'line_total' => $request->line_total,
                    'unit_selling_price' => $request->unit_selling_price,
                    'amount' => $request->amount,
                    'paid_on_date' => $request->paid_on_date,
                    'payment_method' => $request->payment_method,
                    'bkash' => $request->bkash,
                    'rocket' => $request->rocket,
                    'nagud' => $request->nagud,
                    'bank' => $request->bank,
                ]);

                $product = Product::find($request->id);
                $product['purchase_id'] = $purchase->id;
                $product['unit_selling_price'] = $request->unit_selling_price;
                $product->save();
                return redirect()->route('purchase.index');
                if (!empty($purchaseU)) {
                    DB::commit();
                    Session::flash('update','Update Sucessfully...');
                    return redirect()->route('purchase.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
    }

    public function destroy($id)
    {
        Purchase::find($id)->delete();
        Session::flash('delete','Delete Sucessfully...');
        return redirect()->route('purchase.index');

    }

    public function purchase_date_filtering()
    {
        $purchases = Purchase::all();
        return view('modules.purchase.date_ranger', compact('purchases'));
    }


    public function purchase_date_filtering_search(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)
                             ->toDateTimeString();

       $end_date = Carbon::parse($request->end_date)
                             ->toDateTimeString();
       $purchases =  Purchase::whereBetween('created_at',[$start_date,$end_date])->get();

       return view('modules.purchase.date_ranger', compact('purchases'));
    }




}
