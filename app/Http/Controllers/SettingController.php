<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $roles = Role::all();
        return view('setting.subAdmin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = hash::make($request->password);
        $user->save();
        Session::flash('insert','ADDED Sucessfully...');
        return redirect()->route('subAdmin.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('subAdmin.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
