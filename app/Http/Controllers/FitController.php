<?php

namespace App\Http\Controllers;

use App\Models\Fit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class FitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fits = Fit::all();
        return view('modules.product.tin.fit.index', compact('fits'));
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
            'fit_size'=>' required ',
            'fit_piches'=>' required ',
            'tin_ban'=>' required ',
            'fit_long'=>' required ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $fit = Fit::create([
                    'fit_size'=> $request->fit_size,
                    'fit_piches'=>$request->fit_piches,
                    'tin_ban'=> $request->tin_ban,
                    'fit_long'=> $request->fit_long,
                ]);
                if (!empty($fit)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('fit.index');
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
        $edit = Fit::find($id);
        $fits = Fit::all();
        return view('modules.product.tin.fit.index', compact('fits', 'edit'));
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
            'fit_size'=>' required ',
            'fit_piches'=>' required ',
            'tin_ban'=>' required ',
            'fit_long'=>' required ',
        ]);

        if($validated){
            try{
                $fit = Fit::find($id);
                DB::beginTransaction();
                $fitU = $fit->update([
                    'fit_size'=> $request->fit_size,
                    'fit_piches'=>$request->fit_piches,
                    'tin_ban'=> $request->tin_ban,
                    'fit_long'=> $request->fit_long,
                ]);
                if (!empty($fitU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('fit.index');
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
        Fit::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('fit.index');

    }
}
