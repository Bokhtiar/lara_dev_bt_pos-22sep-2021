<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Sell;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::count();
    $contact = Contact::count();
    $user = User::count();
    $sell = Sell::count();
    $sells = Sell::latest()->get();
    $products = PurchaseProduct::latest()->take(6)->get();
    $customers = Sell::latest()->take(6)->get(); //customer due
    $suppliers = Purchase::latest()->take(6)->get();//supplier due
    return view('home', compact('product', 'contact', 'user', 'sell', 'sells','products', 'customers','suppliers'));

    }


}
