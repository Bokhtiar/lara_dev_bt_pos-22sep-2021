<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get(['id', 'category_name','category_description','status']);
        return view('modules.product.category.index', compact('categories'));
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
            'category_name'=>' string |required | unique:categories| max:30 | min:2 ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $category = Category::create([
                    'category_name' => $request->category_name,
                    'category_description' => $request->category_description,
                ]);
                if (!empty($category)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('category.index');
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
            'category_name'=>' string |required | unique:categories| max:30 | min:2 '.$id,
        ]);

        if($validated){
            try{
                $category = Category::find($id);
                DB::beginTransaction();
                $categoryU = $category->update([
                    'category_name' => $request->category_name,
                    'category_description' => $request->category_description,
                ]);
                if (!empty($categoryU)) {
                    DB::commit();
                    Session::flash('update','update Sucessfully...');
                    return redirect()->route('category.index');
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
        Category::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('category.index');

    }


    /**
     * Status change  the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $category = Category::find($id);
        Category::query()->Status($category);
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('category.index');

    }


}