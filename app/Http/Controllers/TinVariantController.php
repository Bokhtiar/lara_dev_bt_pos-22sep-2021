<?php

namespace App\Http\Controllers;

use App\Models\Fit;
use App\Models\TinVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TinVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tinvariants = TinVariant::all();
        return view('modules.product.tin.tinvariant.index', compact('tinvariants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fits = Fit::all();
        return view('modules.product.tin.tinvariant.create_update', compact('fits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //'fit_id', 'mm', 'ton', 'tinpc',
        $validated = $request->validate([
            'fit_id'=>' required ',
            'mm'=>' required ',
            'ton'=>' required ',
            'tinpc'=>' required ',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $tinvariant = TinVariant::create([
                    'fit_id' => $request->fit_id,
                    'mm' => $request->mm,
                    'ton' => $request->ton,
                    'tinpc' => $request->tinpc,
                ]);
                if (!empty($tinvariant)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('tinvariant.index');
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
        $fits = Fit::all();
        $edit = TinVariant::find($id);
        return view('modules.product.tin.tinvariant.create_update', compact('fits', 'edit'));
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
            'fit_id'=>' required ',
            'mm'=>' required ',
            'ton'=>' required ',
            'tinpc'=>' required ',
        ]);

        if($validated){
            try{
                $tinvariant = TinVariant::find($id);
                DB::beginTransaction();
                $tinvariantU = $tinvariant->update([
                    'fit_id' => $request->fit_id,
                    'mm' => $request->mm,
                    'ton' => $request->ton,
                    'tinpc' => $request->tinpc,
                ]);
                if (!empty($tinvariantU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('tinvariant.index');
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
        TinVariant::find($id)->delete();
        Session::flash('delete','Added Sucessfully...');
        return redirect()->route('tinvariant.index');
    }
}
