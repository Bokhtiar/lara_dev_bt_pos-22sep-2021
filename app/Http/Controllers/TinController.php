<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\TinVariant;
use App\Models\Unit;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class TinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tinvariants = TinVariant::all();
        $categories = Category::Active()->get();
        $brands = Brand::query()->Active()->get();
        $units = Unit::all();
        $warranties = Warranty::all();
        $subcategories = Subcategory::query()->Active()->get();
        return view('modules.product.tin.create_update', compact('tinvariants','categories', 'brands', 'subcategories', 'units', 'warranties'));

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

            //tin colum
            'tin_unit'=>'required ',
            'fit'=>'required ',
            'mm'=>'required ',
            'unit_total_price'=>'required ',
            'unit_ban_price'=>'required ',
            'unit_per_pc_price'=>'required ',
            'unit_sell_total_price'=>'required ',
            'unit_sell_ban_price'=>'required ',
            'unit_sell_per_pc_price'=>'required ',
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



                    $product->tin_unit = $request->tin_unit;
                    $product->fit = $request->fit;
                    $product->mm = $request->mm;
                    $product->unit_total_price = $request->unit_total_price;
                    $product->unit_ban_price = $request->unit_ban_price;
                    $product->unit_per_pc_price = $request->unit_per_pc_price;
                    $product->unit_sell_total_price = $request->unit_sell_total_price;
                    $product->unit_sell_ban_price = $request->unit_sell_ban_price;
                    $product->unit_sell_per_pc_price = $request->unit_sell_per_pc_price;

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
        $tinvariants = TinVariant::all();
        $categories = Category::Active()->get();
        $brands = Brand::query()->Active()->get();
        $units = Unit::all();
        $warranties = Warranty::all();
        $subcategories = Subcategory::query()->Active()->get();
        return view('modules.product.tin.create_update', compact('edit','tinvariants','categories', 'brands', 'subcategories', 'units', 'warranties'));

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
            'product_name'=>' string |required | min:2 ',
            'category_id'=>'required | integer ',
            'subcategory_id'=>'required | integer ',
            'brand_id'=>'required | integer ',

            //tin colum
            'tin_unit'=>'required ',
            'fit'=>'required ',
            'mm'=>'required ',
            'unit_total_price'=>'required ',
            'unit_ban_price'=>'required ',
            'unit_per_pc_price'=>'required ',
            'unit_sell_total_price'=>'required ',
            'unit_sell_ban_price'=>'required ',
            'unit_sell_per_pc_price'=>'required ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $product = Product::find($id);
                    $product->product_name = $request->product_name;
                    $product->product_sku = Product::query()->Sku();
                    $product->alert_quantity = $request->alert_quantity;
                    $product->category_id = $request->category_id;
                    $product->subcategory_id = $request->subcategory_id;
                    $product->brand_id = $request->brand_id;
                    $product->unit_id = $request->unit_id;

                    if($request->product_image){
                        $product_image = array();
                        if ($request->hasFile('product_image')) {
                            foreach ($request->product_image as $key => $photo) {
                                $path = $photo->store('uploads/product/photos');
                                array_push($product_image, $path);
                            }
                            $product['product_image']=json_encode($product_image);
                        }
                    }else{
                        $product['product_image'] = $product->product_image;
                    }


                    $product->user_id = Auth::id();
                    $product->unit_price = $request->unit_price;
                    $product->unit_selling_price = $request->unit_selling_price;
                    $product->warranty_id = $request->warranty_id;
                    $product->product_description = $request->product_description;



                    $product->tin_unit = $request->tin_unit;
                    $product->fit = $request->fit;
                    $product->mm = $request->mm;
                    $product->unit_total_price = $request->unit_total_price;
                    $product->unit_ban_price = $request->unit_ban_price;
                    $product->unit_per_pc_price = $request->unit_per_pc_price;
                    $product->unit_sell_total_price = $request->unit_sell_total_price;
                    $product->unit_sell_ban_price = $request->unit_sell_ban_price;
                    $product->unit_sell_per_pc_price = $request->unit_sell_per_pc_price;

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
