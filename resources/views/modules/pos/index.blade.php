@extends('layouts.admin.app')

    @section('title', 'POS')
    @section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    @endsection

    @section('admin_content')
    <section class="container card">
        <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF BRAND</h3>
            <div class="card-tools">
                <div class="input-group form-inline input-group-sm" style="width: 100%;">
                    <p class="form-inline">
                        <a href="@route('order.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                            LIST OF ORDER</a>
                        <a href="{{ url('pos') }}" class="btn btn-primary"><i class="fas fa-plus"></i> POS</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    {{-- <div>
                        <select class="form-control" name="" id="category_id">
                            <option value="">--Selelct Category--</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <input type="text" oninput="search(this.value)" name="" id=""> --}}

                    <div class="row" id="product_row">
                        <select name="product_id" id="product_id" class="form-control select2">
                            <option value="">--Select Product--</option>
                            @foreach ($products as $item)
                            <option value="{{ $item->id }}"> {{ $item->product_name }} </option>
                            @endforeach
                        </select>
                        <div class="col-sm-6 col-md-4 col-lg-4" id="wrapper_div">
                            {{-- ajax loaded data --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <form action="@route('sell.store') " method="POST" class="form-group">
                        @csrf
                        <table class="table table-striped my-3">
                            <thead class="bg-success">
                                <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Selling Price</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">X</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ajax value add --}}
                            </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-lg-8">

                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <input type="number" id="total_amount" name="total_amount" class="form-control mb-2" value="0" >
                                    <input type="number" id="paid_amount" oninput="pay(this.value)" value="0" name="paid_amount" class="form-control mb-2">
                                    <input type="number" id="due_amount" class="form-control" value="0" >
                                </div>
                            </div>
                        <p>
                        <div class="float-right" id="total_amount_show">
                        <button class="total btn btn-primary"></button>
                        </div>
                        </p> <br><br><br><br>


                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-gorup">
                                        <label for="">Select Customer <span class="text-danger">*</span></label>
                                        <select name="customer_id" id="customer_id" class="form-control select2">
                                            <option value="">--select customer--</option>
                                            @foreach ($contacts as $item)
                                            <option value="{{ $item->id }}">{{ $item->prefix_name .' '. $item->f_name .' '. $item->l_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group my-3" id="customer_detail">
                                    </div>
                                </div><!--customer site done -->
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6 col-md-6">
                                            <label for="">Invoice Date</label>
                                            <input type="date" class="form-control" name="invoice_date" id="">
                                        </div>
                                        <div class="col-sm-12 col-lg-6 col-md-6">
                                            <label for="">Invoice No.</label>
                                            <input type="number" class="form-control" name="invoice_no" placeholder="Invoice No." id="">
                                        </div>
                                    </div>
                                </div><!--others information-->
                            </div>
                            <div class="card my-4">
                                <div class="card-header">
                                    <h4 class="card-title">Payment Info.</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-control">
                                                <label for="">Payment Methods</label>
                                                <select class="form-control select2" name="payment_method" id="payment_method">
                                                    <option value="">--select payment method--</option>
                                                    <option value="Bkash">Bkash</option>
                                                    <option value="Nagud">Nagud</option>
                                                    <option value="Rocket">Rocket</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="">Sell on. <span class="text-danger">*</span></label>
                                            <input type="date" name="sell_on_date" class="form-control" id="">
                                        </div>
                                    </div>


                                    <!--pyament mehtods start here -->
                                    <div class="form-gorup my-3 card" id="Bkash" style="display: none">
                                        <p class="card-header">
                                            <h5 class="card-title">Bkash Payment Methods <span class="text-danger">*</span></h5>
                                        </p>
                                        <p class="card-body">
                                        <label for="">Bkash Number</label>
                                        <input type="number" class="form-control" placeholder="bkash number" name="bkash">
                                        </p>
                                    </div><!--bkash-->
                                    <div class="form-gorup my-3 card" id="Nagud" style="display: none">
                                        <p class="card-header">
                                            <h5 class="card-title">Nagud Payment Methods</h5>
                                        </p>
                                        <p class="card-body">
                                        <label for="">Nagud Number</label>
                                        <input type="number" class="form-control" placeholder="nagud number" name="nagud">
                                        </p>
                                    </div><!--nagud-->
                                    <div class="form-gorup my-3 card" id="Rocket" style="display: none">
                                        <p class="card-header">
                                            <h5 class="card-title">Rocket Payment Methods</h5>
                                        </p>
                                        <p class="card-body">
                                        <label for="">Rocket Number</label>
                                        <input type="number" class="form-control" placeholder="Rocket number" name="rocket">
                                        </p>
                                    </div><!--bkash-->
                                    <div class="form-gorup my-3 card" id="Bank" style="display: none">
                                        <p class="card-header">
                                            <h5 class="card-title">Bank Payment Methods</h5>
                                        </p>
                                        <p class="card-body">
                                        <label for="">Bank Account Number</label>
                                        <input type="number" class="form-control" placeholder="bank account number" name="bank">
                                        </p>
                                    </div><!--bkash-->
                                    <!--payment methods end here -->

                                </div>
                            </div>
                            <div class="float-right">
                                <input type="submit" class="btn btn-primary" value="Order Confirm">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/select2/select2.full.min.js"></script>
     <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //end of ajax heaer setup
        function product_show(response){
            response.forEach(item => {
            $('#product_row').append('<div class="col-sm-6 col-md-4 col-lg-4" id="wrapper_div">\
            <div class="card">\
            <div class="card-body">\
            <p class="card-text">\
            '+item.product_name+' <br>\
            '+item.unit_selling_price+'Tk <br>\
            <button class="btn btn-sm btn-success" onclick="add('+item.id+')" >+add</button>\
            </p>\
            </div>\
            </div>\
            </div>')
        });
        }//html product show
        all_product()
        function all_product(){
            $.ajax({
                url: '/all/data',
                type: 'GET',
                dataType: 'JSON',
                success:function(response){
                    console.log(response)
                    product_show(response)
                }
            })
        }//all product show

        function add(id) {
            if(id){
                $.ajax({
                url:'/sell/product/search/'+id,
                type: 'GET',
                dataType: 'Json',
                success:function(response){
                    $.each(response, function(key, item){
                        $("tbody").append('<tr>\
                        <td>'+item.product_name+'</td>\
                        <td> <input type="number" class="form-control form-control-sm" value="'+item.id+'" name="product_id[]" > </td>\
                        <td> <input type="number" id="qty'+item.id+'" oninput="getQty(this.value, '+item.id+'); getSumPrice()"  class="form-control form-control-sm" value="" name="sell_quantity[]" > </td>\
                        <td> <input type="text" id="unit_selling_price'+item.id+'" oninput="unit_price(this.value, '+item.id+'); getSumPrice()" class="form-control form-control-sm" value=" '+item.unit_selling_price+' " name="unit_selling_price[]" > </td>\
                        <td> <input type="text" id="total'+item.id+'" class="form-control form-control-sm total" value="" name="total_price[]" > </td>\
                        <td> <span class="btn  btn-sm btn-danger">X</span> </td>\
                        </tr>')
                    })
                }
            })
            }//end if condition
        } //add function end

        function getQty(quantity, sl){
            var slp = $("#unit_selling_price"+sl).val();
            var total_p = quantity * slp
            $("#total"+sl).val(total_p)
        }

        function getSumPrice(){
            var row_total = 0;
            $(".total").each(function(){
                row_total += parseFloat((this.value == 0 ? 0 : this.value))
            })
            $("#total_amount").val(row_total)
        }//colum count total price

        function pay(amount){
            var total = $("#total_amount").val();
            var paid = total-amount;
            $("#due_amount").val(paid);
        }//sum total

        function unit_price(price, n){
            var $qty = $("#qty" + n).val();
            var total_price = $qty * price
            $("#total"+n).val(total_price)
        }

        $('#payment_method').on('change', function(e){
            var payment_name = e.target.value
            $('#Bkash').hide();
            $('#Nagud').hide();
            $('#Rocket').hide();
            $('#Bank').hide();
            if(payment_name == 'Bkash'){
                $('#Bkash').show();
            }else if(payment_name == 'Nagud'){
                $('#Nagud').show();
            }else if(payment_name == 'Rocket'){
                $('#Rocket').show();
            }else if (payment_name == 'Bank'){
                $('#Bank').show();
            }
        })//pyament methods

        // function search(value){
        //     if(value){
        //         $.ajax({
        //             url:'/search/product/'+value,
        //             type:'GET',
        //             dataType: 'JSON',
        //             success:function(response){
        //                 product_show(response)
        //             }
        //         })
        //     }
        // }//auto search

        $(function () {
        $('.select2').select2()
        }) //end of select2

        $("#product_id").on('change',function(e){
        var id = e.target.value
        console.log(id);
        if(id){
            $.ajax({
                url:'/sell/product/search/'+id,
                type: 'GET',
                dataType: 'Json',
                success:function(response){
                    $.each(response, function(key, item){
                        $("tbody").append('<tr>\
                        <td>'+item.product_name+'</td>\
                        <td> <input type="number" class="form-control form-control-sm" value="'+item.id+'" name="product_id[]" > </td>\
                        <td> <input type="number" id="qty'+item.id+'" oninput="getQty(this.value, '+item.id+'); getSumPrice()"  class="form-control form-control-sm" value="" name="sell_quantity[]" > </td>\
                        <td> <input type="text" id="unit_selling_price'+item.id+'" oninput="unit_price(this.value, '+item.id+'); getSumPrice()" class="form-control form-control-sm" value=" '+item.unit_selling_price+' " name="unit_selling_price[]" > </td>\
                        <td> <input type="text" id="total'+item.id+'" class="form-control form-control-sm total" value="" name="total_price[]" > </td>\
                        <td> <span class="btn  btn-sm btn-danger">X</span> </td>\
                        </tr>')
                    })
                }
            })
        }
        })//product serach and show

     </script>
    @endsection
