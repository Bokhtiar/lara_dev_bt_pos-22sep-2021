<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Egulias\EmailValidator\Warning\Warning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warranties = Warranty::all();
        return view('modules.product.warranty.index', compact('warranties'));
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
            'warranty_name'=>' string |required | max:30 | min:2 ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $warranty = Warranty::create([
                    'warranty_name' => $request->warranty_name,
                    'warranty_description' => $request->warranty_description,
                ]);
                if (!empty($warranty)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('warranty.index');
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
        $edit = Warranty::find($id);
        $warranties = Warranty::all();
        return view('modules.product.warranty.index', compact('warranties', 'edit'));
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
            'warranty_name'=>' string |required | max:30 | min:2 ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $warranty = Warranty::find($id);
                $warrantyU = $warranty->update([
                    'warranty_name' => $request->warranty_name,
                    'warranty_description' => $request->warranty_description,
                ]);
                if (!empty($warrantyU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('warranty.index');
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
        Warranty::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('warranty.index');
    }
}