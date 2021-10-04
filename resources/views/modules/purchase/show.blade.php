@extends('layouts.admin.app')

    @section('title', 'Purchase Details')
    @section('css')
    @endsection

    @section('admin_content')
    <section class="card">
        <x-purchase></x-purchase>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Product Name : </span> {{ $purchase->product->product_name }}</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Supplier : </span> {{ $purchase->supplier->prefix_name .' '. $purchase->supplier->f_name .' '. $purchase->supplier->l_name }}</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Reference No : </span> {{ $purchase->reference_no }}</h4>
                </div>

                <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Purchase Date : </span> {{ $purchase->purchase_date}}</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Purchase Quantity : </span> {{ $purchase->purchase_quantity }} </h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Unit Cost : </span> {{ $purchase->unit_cost }} Tk</h4>
                </div>

                <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Discount Percent : </span> {{ $purchase->discount_percent }}%</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">tax : </span> {{ $purchase->tax }}%</h4>
                </div>
                <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Total Product Price : </span> {{ $purchase->line_total }} TK</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Profit Margin : </span> {{ $purchase->profit_margin }}%</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Unit selling price : </span> {{ $purchase->unit_selling_price }} TK</h4>
                </div>

                <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Already pay amount : </span> {{ $purchase->amount }} TK</h4>
                </div>
                <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Due Amount : </span> {{  $purchase->line_total - $purchase->amount }} TK</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Paid On Date : </span> {{ $purchase->paid_on_date }}</h4>
                </div>
                 <div class="card-header">
                    <h4 class="card-title"> <span class="h6">Payment Method : </span> {{ $purchase->payment_method }}</h4>
                </div>
                <div class="card-header">
                    @if (isset($purchase->bkash))
                        <h4 class="card-title"> <span class="h6">Bkash Number : </span> {{ $purchase->bkash }}</h4>
                    @elseif(isset($purchase->rocket))
                        <h4 class="card-title"> <span class="h6">Rocket Number : </span> {{ $purchase->rocket }}</h4>
                    @elseif(isset($purchase->nagud))
                        <h4 class="card-title"> <span class="h6">Nagud : </span> {{ $purchase->nagud }}</h4>
                    @elseif(isset($purchase->bank))
                        <h4 class="card-title"> <span class="h6">Bank : </span> {{ $purchase->bank }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('js')
    @endsection
