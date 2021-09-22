<?php

namespace App\Http\Controllers;

use App\Models\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    public function index()
    {
        $admins = User::paginate(5);
        return view('setting.subAdmin.index', compact('admins'));
    }

    public function create()
    {
        return view('setting.subAdmin.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->save();
        Session::flash('insert','ADDED Sucessfully...');
        return back();
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('subAdmin.index');
    }
}