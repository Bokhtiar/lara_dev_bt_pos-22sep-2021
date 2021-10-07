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
                        <p>Unit: {{ $item->unit ? $item->unit->unit_short_name : 'Data Not Available' }}</p>
                        <p>Unit Selling Price: {{ $item->unit_selling_price }}</p>
                        <p>Discount Percentage: {{ $item->discount_percent }} %</p>
                        <p>Tax: {{ $item->tax }} %</p>
                        <p>Warranty: {{ $item->warranty ? $item->warranty->warranty_name : 'Data Not Available' }}</p>
                        <p>Description : {!! $item->product_description	 !!}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

