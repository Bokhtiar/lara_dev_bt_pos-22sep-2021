<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Validation\Rule;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::get(['category_id', 'subcategory_name', 'subcategory_description', 'status','id']);
        $categories = Category::all();
        return view('modules.product.subcategory.index', compact('subcategories', 'categories'));
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
            'subcategory_name'=> 'string |required | unique:subcategories| max:30 | min:2 ',
            'category_id'=> 'required | integer'
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $subcategory = Subcategory::create([
                    'subcategory_name' => $request->subcategory_name,
                    'category_id' => $request->category_id,
                    'subcategory_description' => $request->subcategory_description,
                ]);
                if (!empty($subcategory)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('subcategory.index');
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
        $validated = $request->validate([
            'subcategory_name'=> ['required', 'string',Rule::unique('subcategories', 'subcategory_name')->ignore($id,'id')],
            'category_id'=> 'required | integer'
        ]);

        if($validated){
            try{
                $subcategory = Subcategory::find($id);
                DB::beginTransaction();
                $subcategoryU = $subcategory->update([
                    'subcategory_name' => $request->subcategory_name,
                    'category_id' => $request->category_id,
                    'subcategory_description' => $request->subcategory_description,
                ]);
                if (!empty($subcategoryU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('subcategory.index');
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
        SubCategory::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('subcategory.index');
    }

    public function status($id)
    {
        $subcategory = Subcategory::find($id);
        SubCategory::query()->Status($subcategory);
        Session::flash('status','update Sucessfully...');
        return redirect()->route('subcategory.index');

    }

}
