<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
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
        $products = Product::where('purchase_id', null)->Active()->get();
        return view('modules.purchase.create', compact('products', 'suppliers'));
    }

    public function show($id)
    {
        $item = Purchase::find($id);
        $products = PurchaseProduct::where('purchase_id', $id)->get();
        return view('modules.purchase.show', compact('item', 'products'));
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
            'paid_on_date' => 'required',
            'payment_method'=> 'required'
        ]);
        if($validated){
            try{
                DB::beginTransaction();
                 $purchase = Purchase::create([
                    'supplier_id' => $request->supplier_id,
                    'reference_no' => Purchase::query()->Reference_number(),
                    'purchase_date' => $request->purchase_date,
                    'attech_file' => null,
                    'note' => $request->note,
                    'user_id' => Auth::id(),
                    'paid_on_date' => $request->paid_on_date,
                    'due_paid_date' => $request->due_paid_date,
                    'payment_method' => $request->payment_method,
                    'total_amount' => $request->total_amount,
                    'paid_amount' => $request->paid_amount,
                    'bkash' => $request->bkash,
                    'rocket' => $request->rocket,
                    'nagud' => $request->nagud,
                    'bank' => $request->bank,
                 ]);
                //  dd($request->all());
                if (!empty($purchase)) {
                    $purchase_id = $purchase->id;
                    $product_id = $request->product_id;
                    for ($i=0; $i < count($product_id) ; $i++) {
                        if(isset( $request->tin[$i])){
                            $product = new PurchaseProduct;
                            $product->product_id = $request->product_id[$i];
                            $pro[$i] = Product::find($request->product_id[$i]);
                            $product->purchase_quantity = $request->purchase_quantity[$i] * $pro[$i]->piches; //product find kore jodi tin product hoi tahole tin ar mm onojai je tin hoi ta multiple koralm
                            $product->purchase_id = $purchase_id;
                            $product->tin_purchase = $request->purchase_quantity[$i];
                            $product->unit_price = $request->unit_price[$i];
                            $product->total_price = $request->total_price[$i];
                            $product->save();

                            $p = Product::find($request->product_id[$i]);
                            $p->purchase_id = $purchase_id;
                            $p->save();
                        }else{
                            $product = new PurchaseProduct;
                            $product->product_id = $request->product_id[$i];
                            $product->purchase_quantity = $request->purchase_quantity[$i];
                            $product->purchase_id = $purchase_id;
                            $product->unit_price = $request->unit_price[$i];
                            $product->total_price = $request->total_price[$i];
                            $product->save();

                            $p = Product::find($request->product_id[$i]);
                            $p->purchase_id = $purchase_id;
                            $p->save();
                        }

                    }
                }
                if($purchase){
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
        $products = Product::where('purchase_id', null)->Active()->get();
        return view('modules.purchase.edit', compact('purchase','suppliers','products'));
    }

    public function update(Request $request, $id)
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
                $purchase_update = Purchase::find($id);
                $purchaseUpdateId = $purchase_update->id;
                $purchaseU = $purchase_update->update([
                    'supplier_id' => $request->supplier_id,
                    'reference_no' => $request->reference_no,
                    'purchase_date' => $request->purchase_date,
                    'attech_file' => null,
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

                if (!empty($purchaseU)) {
                    $purchase_id = $purchaseUpdateId;
                    $product_id = $request->product_id;
                    for ($i=0; $i < count($product_id) ; $i++) {
                        if(isset($request->purchaseProduct_id[$i])){
                            $product = PurchaseProduct::find($request->purchaseProduct_id[$i]);
                            $product->product_id = $request->product_id[$i];
                            if($product->tin_purchase == null){
                                $product->purchase_quantity = $request->purchase_quantity[$i];
                            }else{
                                $pro[$i] = Product::find($request->product_id[$i]);
                                $product->purchase_quantity = $request->purchase_quantity[$i] * $pro[$i]->piches;
                                $product->tin_purchase = $request->purchase_quantity[$i];
                            }

                            $product->purchase_id = $purchase_id;
                            $product->unit_price = $request->unit_price[$i];
                            $product->total_price = $request->total_price[$i];
                            $product->save();

                            $p = Product::find($request->product_id[$i]);
                            $p->purchase_id = $purchase_id;
                            $p->save();

                        }//if purchaseproduct == 0
                        else{
                            $product = new PurchaseProduct;
                            $product->product_id = $request->product_id[$i];
                            if($product->tin_purchase == null){
                                $product->purchase_quantity = $request->purchase_quantity[$i];
                            }else{
                                $pro[$i] = Product::find($request->product_id[$i]);
                                $product->purchase_quantity = $request->purchase_quantity[$i] * $pro[$i]->piches;
                                $product->tin_purchase = $request->purchase_quantity[$i];
                            }
                            $product->purchase_id = $purchase_id;
                            $product->unit_price = $request->unit_price[$i];
                            $product->total_price = $request->total_price[$i];
                            $product->save();

                            $p = Product::find($request->product_id[$i]);
                            $p->purchase_id = $purchase_id;
                            $p->save();
                        }//else if purchaseproduct id have

                    }
                }
                if($purchaseU){
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
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
        try{
            DB::beginTransaction();
            $purchase = Purchase::find($id)->delete();
            if($purchase){
                foreach (PurchaseProduct::query()->PurchaseProduct($id) as $purchase){
                    PurchaseProduct::find($purchase->id)->delete();
                }

                foreach(Product::where('purchase_id', $id)->get() as $p){
                    $p->purchase_id = null;
                    $p->save();
                }


                DB::commit();
                Session::flash('delete','delete Sucessfully...');
                return redirect()->route('purchase.index');
            }
        }catch(\Exception $ex){
            //DB::rollBack();
            return redirect()->route('purchase.index');
        }

    }

    public function purchase_date_filtering()
    {
        $purchases = Purchase::all();
        return view('modules.purchase.date_ranger', compact('purchases'));
    }


    public function purchase_date_filtering_search(Request $request)
    {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        $purchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->get();

    //     $start_date = Carbon::parse($request->start_date)
    //                          ->toDateTimeString();

    //    $end_date = Carbon::parse($request->end_date)
    //                          ->toDateTimeString();
    //    $purchases =  Purchase::whereBetween('created_at',[$start_date,$end_date])->get();

       return view('modules.purchase.date_ranger', compact('purchases'));
    }


    public function purchase_edit_product($id){
       $products =  PurchaseProduct::with('product')->where('purchase_id', $id)->get();
        return response()->json([
            'products'=>$products,
        ]);
    }


    public function alert()
    {
        $products = PurchaseProduct::all();
        return view('modules.product.alert', compact('products'));
    }


}
