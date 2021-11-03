<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('modules.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;
        return view('modules.contact.create', compact('type'));
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
            'contact_info'=>' string |required ',
            'prefix_name' => 'required',
            'f_name'=> 'required',
            'l_name'=>'required',
            'phone' => 'required',
        ]);

        if($validated){
            try{
                DB::beginTransaction();
                $contact = Contact::create([
                    'contact_info' => $request->contact_info,
                    'prefix_name' => $request->prefix_name,
                    'f_name' => $request->f_name,
                    'l_name' => $request->l_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'zip' => $request->zip,
                    'company_name' => $request->company_name,
                    'company_phone' => $request->company_phone,
                    'company_email' => $request->company_email,
                ]);
                if (!empty($contact)) {
                    DB::commit();
                    Session::flash('insert','Added Sucessfully...');
                    return redirect()->route('contact.index');
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
    public function edit(Request $request, $id)
    {
        $edit = Contact::find($id);
        $type = $request->type;
        return view('modules.contact.create', compact('edit','type'));
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
            'contact_info'=>' string |required ',
            'prefix_name' => 'required',
            'f_name'=> 'required',
            'l_name'=>'required',
            'phone' => 'required',
        ]);

        if($validated){
            try{
                $contact = Contact::find($id);
                DB::beginTransaction();
                $contactU = $contact->update([
                    'contact_info' => $request->contact_info,
                    'prefix_name' => $request->prefix_name,
                    'f_name' => $request->f_name,
                    'l_name' => $request->l_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'zip' => $request->zip,
                    'company_name' => $request->company_name,
                    'company_phone' => $request->company_phone,
                    'company_email' => $request->company_email,
                ]);
                if (!empty($contactU)) {
                    DB::commit();
                    Session::flash('update','Added Sucessfully...');
                    return redirect()->route('contact.index');
                }
                throw new \Exception('Invalid About Information');
            }catch(\Exception $ex){
                DB::rollBack();
            }
        }
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        Session::flash('delete','update Sucessfully...');
        return redirect()->route('contact.index');

    }


    /**
     * Status change  the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $contact = Contact::find($id);
        Contact::query()->Status($contact);
        Session::flash('status','update Sucessfully...');
        return redirect()->route('contact.index');

    }

    public function customer_info($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact, 200);
    }
}
