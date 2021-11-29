@extends('layouts.admin.app')
@section('title', 'Product Details')
@section('admin_content')
    <div class="modal-body">
        <section>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                        <img src="{{asset('admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="container card">
                        <p class="h4"> Product Name: {{ $item->product_name }}</p>
                        <p>Product Sku: {{ $item->product_sku }}</p>
                        <p>Alert Quantity: {{ $item->alert_quantity }}</p>
                        <p>Category : {{ $item->category ? $item->category->category_name : 'Data Not Available' }}</p>
                        <p>SubCategory: {{ $item->subcategory ? $item->subcategory->subcategory_name : 'Data Not Available' }}</p>
                        <p>Brand: {{ $item->brand ? $item->brand->brand_name : 'Data Not Available' }}</p>
                        <p>Unit: {{ $item->unit ? $item->unit->unit_short_name : $item->tin_unit }}</p>
                        <p>Unit  Price:
                            @if ($item->unit_price)
                            {!! $item->unit_price !!} Tk
                            @else
                            {!! $item->unit_total_price !!} Tk
                            @endif
                        </p>
                        <p>Unit Selling Price:
                            @if ($item->unit_selling_price)
                            {!! $item->unit_selling_price !!} Tk
                            @else
                            {!! $item->unit_sell_total_price !!} Tk
                            @endif
                        </p>

                            @isset($item->unit_ban_price)
                            <p>Unit Ban Price
                                {!! $item->unit_ban_price !!} Tk
                            </p>
                            @endisset
                            @isset($item->unit_per_pc_price)
                            <p>Unit Per Pc Price
                                {!! $item->unit_per_pc_price !!} Tk
                            </p>
                            @endisset

                            @isset($item->unit_sell_total_price)
                            <p>Unit Sell Ton Price
                                {!! $item->unit_sell_total_price !!} Tk
                            </p>
                            @endisset
                            @isset($item->unit_sell_ban_price)
                            <p>Unit Sell Ban Price
                                {!! $item->unit_sell_ban_price !!} Tk
                            </p>
                            @endisset
                            @isset($item->unit_sell_per_pc_price)
                            <p>Unit Sell Per Pc Price
                                {!! $item->unit_sell_per_pc_price !!} Tk
                            </p>
                            @endisset



                        <p>Warranty: {{ $item->warranty ? $item->warranty->warranty_name : 'Data Not Available' }}</p>
                        <p>Description : {!! $item->product_description	 !!}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

