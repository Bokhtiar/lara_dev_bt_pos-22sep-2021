<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function day()
    {
        $sells = Sell::whereDate('created_at', Carbon::today())->get();
        return view('modules.report.day', compact('sells'));
    }

    public function month()
    {
        $sells = Sell::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->get();
        dd($sells);
        return view('modules.report.month', compact('sells'));
    }

    public function week()
    {
        //current wekk function
        $sells = Sell::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return view('modules.report.week', compact('sells'));
    }

    public function year()
    {
        //current wekk function
        $sells = Sell::whereYear('created_at', date('Y'))->get();
        return view('modules.report.year', compact('sells'));
    }

    public function date_range()
    {
        $sells = Sell::all();
        return view('modules.report.date_range', compact('sells'));
    }

    public function date_range_search(Request $request)
    {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        $sells = Sell::whereBetween('created_at', [$startDate, $endDate])->get();

    //     $start_date = Carbon::parse($request->start_date)
    //                          ->toDateTimeString();

    //    $end_date = Carbon::parse($request->end_date)
    //                          ->toDateTimeString();
    //    $sells =  Sell::whereBetween('created_at',[$start_date,$end_date])->get();

    // $sells = Sell::where('created_at','>=',$request->start_date)
    // ->where('created_at','<=',$request->end_date)
    // ->get();
        return view('modules.report.date_range', compact('sells'));



    }
}

