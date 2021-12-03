<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sell;
use Illuminate\Http\Request;

class DueController extends Controller
{
    public function customer_due()
    {
        $customers = Sell::all();
        return view('modules.due.customer_due', compact('customers'));
    }

    public function supplier_due()
    {
        $suppliers = Purchase::all();
        return view('modules.due.supplier_due', compact('suppliers'));
    }
}
