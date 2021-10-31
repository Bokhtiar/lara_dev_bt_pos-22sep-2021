<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Subcategory;
use App\Models\Unit;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $purchase = Purchase::all();
        return view('modules.product.index', compact('products', 'purchase'));
    }

    // ajax request all data product
    public function product_all()
    {
        $products = Product::with('purchase')->Active()->get();
        return response()->json($products, 200);
    }

    //category ways product show
    public function category_product($id)
    {
        $products = Product::with('purchase')->where('category_id', $id)->Active()->get();
        return response()->json($products, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::Active()->get();
        $brands = Brand::query()->Active()->get();
        $units = Unit::all();
        $warranties = Warranty::all();
        $subcategories = Subcategory::query()->Active()->get();
        return view('modules.product.create_update', compact('categories', 'brands', 'subcategories', 'units', 'warranties'));
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
            'product_name'=>' string |required | unique:products| min:2 ',
            'category_id'=>'required | integer ',
            'subcategory_id'=>'required | integer ',
            'brand_id'=>'required | integer ',
            'unit_id'=>'required | integer ',
            'unit_price'=>'required ',
            'unit_selling_price'=>'required ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $product = new Product;
                    $product->product_name = $request->product_name;
                    $product->product_sku = Product::query()->Sku();
                    $product->alert_quantity = $request->alert_quantity;
                    $product->category_id = $request->category_id;
                    $product->subcategory_id = $request->subcategory_id;
                    $product->brand_id = $request->brand_id;
                    $product->unit_id = $request->unit_id;

                    $product_image = array();
                    if ($request->hasFile('product_image')) {
                        foreach ($request->product_image as $key => $photo) {
                            $path = $photo->store('uploads/product/photos');
                            array_push($product_image, $path);
                        }
                        $product['product_image']=json_encode($product_image);
                    }

                    $product->user_id = Auth::id();
                    $product->unit_price = $request->unit_price;
                    $product->unit_selling_price = $request->unit_selling_price;
                    $product->warranty_id = $request->warranty_id;
                    $product->product_description = $request->product_description;
                    $product->save();
                if (!empty($product)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('product.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                return abort(404);
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
        $item = Product::find($id);
        return view('modules.product.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Product::find($id);
        $categories = Category::Active()->get();
        $brands = Brand::query()->Active()->get();
        $units = Unit::all();
        $warranties = Warranty::all();
        $subcategories = Subcategory::query()->Active()->get();
        return view('modules.product.create_update', compact('categories', 'brands', 'subcategories','edit', 'units', 'warranties'));
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
        $validated = $request->validate([
            'product_name'=>' string |required | unique:products| min:2 ',
            'category_id'=>'required | integer ',
            'subcategory_id'=>'required | integer ',
            'brand_id'=>'required | integer ',
            'unit_id'=>'required | integer ',
            'unit_price'=>'required ',
            'unit_selling_price'=>'required ',
        ]);

        if($validated){
            try{
                $product = Product::find($id);
                DB::beginTransaction();
                $productU = $product->update([
                    'product_name' => $request->product_name,
                    'product_sku' => $request->product_sku,
                    'alert_quantity' => $request->alert_quantity,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand_id' => $request->brand_id,
                    'unit_id' => $request->unit_id,
                    'unit_price' => $request->unit_price,
                    'unit_selling_price' => $request->unit_selling_price,
                    'warranty_id' => $request->warranty_id,
                    'product_description' => $request->product_description,
                ]);
                if (!empty($productU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('product.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        Session::flash('delete','delete Sucessfully...');
        return redirect()->route('product.index');
    }

    public function status($id)
    {
        $product = Product::find($id);
        Product::query()->Status($product);
        Session::flash('status','update Sucessfully...');
        return redirect()->route('product.index');
    }

    public function aleart()
    {
        $products = Product::query()->Alert();
        return view('modules.product.alert', compact('products'));
    }


}
