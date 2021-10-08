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

    public function date_range()
    {
        $orders = Order::all();
        return view('modules.report.date_range', compact('orders'));
    }

    public function date_range_search(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)
                             ->toDateTimeString();

       $end_date = Carbon::parse($request->end_date)
                             ->toDateTimeString();
       $orders =  Order::whereBetween('created_at',[$start_date,$end_date])->get();

        return view('modules.report.date_range', compact('orders'));
    }
}

