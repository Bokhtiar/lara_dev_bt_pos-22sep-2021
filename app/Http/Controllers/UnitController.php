<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('modules.product.unit.index', compact('units'));
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
            'unit_name'=>' string |required | max:30 | min:2 ',
            'unit_short_name'=>' string |required | max:30 | min:2 ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $unit = Unit::create([
                    'unit_name' => $request->unit_name,
                    'unit_short_name' => $request->unit_short_name,
                    'unit_description' => $request->unit_description,
                ]);
                if (!empty($unit)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('unit.index');
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
        $edit = Unit::find($id);
        $units = Unit::all();
        return view('modules.product.unit.index', compact('units', 'edit'));
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
            'unit_name'=>' string |required | max:30 | min:2 ',
            'unit_short_name'=>' string |required | max:30 | min:2 ',
        ]);

        if($validated){
            try{
                $unit = Unit::find($id);
                DB::beginTransaction();
                $unitU = $unit->update([
                    'unit_name' => $request->unit_name,
                    'unit_short_name' => $request->unit_short_name,
                    'unit_description' => $request->unit_description,
                ]);
                if (!empty($unitU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('unit.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
    }

    public function destroy($id)
    {
        Unit::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('unit.index');

    }
}
