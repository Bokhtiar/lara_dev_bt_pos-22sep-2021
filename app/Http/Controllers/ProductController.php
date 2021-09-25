<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
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
        return view('modules.product.index', compact('products'));
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
        $subcategories = Subcategory::query()->Active()->get();
        return view('modules.product.create_update', compact('categories', 'brands', 'subcategories'));
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
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $product = Product::create([
                    'product_name' => $request->product_name,
                    'product_sku' => $request->product_sku,
                    'alert_quantity' => $request->alert_quantity,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand_id' => $request->brand_id,
                    'unit_id' => $request->unit_id,
                    'warranty_id' => $request->warranty_id,
                    'product_description' => $request->product_description,
                ]);
                if (!empty($product)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('product.index');
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
        $edit = Product::find($id);
        $categories = Category::Active()->get();
        $brands = Brand::query()->Active()->get();
        $subcategories = Subcategory::query()->Active()->get();
        return view('modules.product.create_update', compact('categories', 'brands', 'subcategories','edit'));
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
}