<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('modules.product.brand.index', compact('brands'));
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
            'brand_name'=>' string |required | unique:brands| max:30 | min:2 ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $brand = Brand::create([
                    'brand_name' => $request->brand_name,
                    'brand_description' => $request->brand_description,
                ]);
                if (!empty($brand)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('brand.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $edit = Brand::find($id);
         $brands = Brand::all();
        return view('modules.product.brand.index', compact('edit','brands'));
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
            'brand_name'=>['required', 'string',Rule::unique('brands', 'brand_name')->ignore($id,'id')],
        ]);

        if($validated){
            try{
                $brand = Brand::find($id);
                DB::beginTransaction();
                $brandU = $brand->update([
                    'brand_name' => $request->brand_name,
                    'brand_description' => $request->brand_description,
                ]);
                if (!empty($brandU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('brand.index');
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
        Brand::find($id)->delete();
        Session::flash('delete','Added Sucessfully...');
        return redirect()->route('brand.index');
    }

    public function status($id)
    {
        $brand = Brand::find($id);
        Brand::query()->Status($brand);
        Session::flash('status','Added Sucessfully...');
        return redirect()->route('brand.index');
    }

}
