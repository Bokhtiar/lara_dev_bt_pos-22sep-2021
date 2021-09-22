<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        dd('test');
    }

    public function create()
    {
        return view('setting.subAdmin.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}