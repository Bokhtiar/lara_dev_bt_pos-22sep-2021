<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function day()
    {
        $orders = Order::whereDate('created_at', Carbon::today())->get();
        return view('modules.report.day', compact('orders'));
    }

    public function month()
    {
        $orders = Order::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->get();
        return view('modules.report.month', compact('orders'));
    }

    public function week()
    {
        //current wekk function
        $orders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return view('modules.report.week', compact('orders'));
    }

    public function year()
    {
        //current wekk function
        $orders = Order::whereYear('created_at', date('Y'))->get();
        return view('modules.report.year', compact('orders'));
    }
}
