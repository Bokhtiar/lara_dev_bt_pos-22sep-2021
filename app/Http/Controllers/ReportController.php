<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function day()
    {
        dd('day');
    }

    public function month()
    {
        $orders = Order::whereMonth('created_at', date('m'))->get();
        return view('modules.report.month', compact('orders'));
    }
}