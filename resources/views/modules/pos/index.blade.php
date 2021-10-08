@extends('layouts.admin.app')

    @section('title', 'POS')

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
                    <div class="row" id="product_row">
                        <div class="col-sm-6 col-md-4 col-lg-4" id="wrapper_div">
                            {{-- ajax loaded data --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <form action="@route('order.store') " method="POST" class="form-group">
                        @csrf
                    <table class="table table-striped my-3">
                        <thead class="bg-success">
                            <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">X</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        </table>
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
                                            <label for="">Amount. <span class="text-danger">*</span></label>
                                            <input type="number" placeholder="how many pay customer" name="pay_amount" class="form-control" id="">
                                        </div>
                                        <input type="hidden" name="total_amount" value="100" id="total_amount">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="">Sell on. <span class="text-danger">*</span></label>
                                            <input type="date" name="sell_on_date" class="form-control" id="">
                                        </div>
                                    </div>
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

            all_product()
            function all_product(){
                $.ajax({
                    url: '/all/data',
                    type: 'GET',
                    dataType: 'JSON',
                    success:function(response){
                        console.log(response)
                        response.forEach(item => {
                            $('#product_row').append('<div class="col-sm-6 col-md-4 col-lg-4" id="wrapper_div">\
                                <div class="card">\
                                <img class="card-img-top" src="..." alt="Card image cap">\
                                <div class="card-body">\
                                <p class="card-text">\
                                '+item.product_name+' <br>\
                                '+item.unit_selling_price+'Tk <br>\
                                Qty: '+item.purchase.purchase_quantity+' <br>\
                                <button class="btn btn-sm btn-success" onclick="add('+item.id+')" >+add</button>\
                                </p>\
                                </div>\
                              </div>\
                              </div>')
                        });
                    }
                })
            }//all product show

            function add(id) {

                if(id){
                    $.ajax({
                        url : '/store/sell/'+id,
                        type: 'GET',
                        dataType: 'Json',
                        success:function(response){
                            getData()
                        }//eend ajax url
                    })
                }//end if condition
            } //add function end


            getData()
            function getData() {
                    $.ajax({
                    url : '/sell/author/all',
                    type: 'GET',
                    dataType: 'json',
                    success:function(response) {
                        console.log(response)
                        $('tbody').html("")
                            var total = 0;
                        response.forEach(data => {
                            total += data.product.unit_selling_price*data.quantity
                            $('tbody').append('<tr>\
                            <td>'+data.product.product_name+'</td>\
                            <td>\
                                <form action="" method="POST" class="form-inline">\
                                    <input type="text" class="form-control form-control-sm qty" value="'+data.quantity+'" >\
                                    <button type="button" value=" '+data.id+' " class="update btn btn-success btn-sm">submit</button>\
                                </form>\
                            </td>\
                            <td>'+data.product.unit_selling_price+' Tk </td>\
                             <td> '+data.product.unit_selling_price*data.quantity+' Tk</td>\
                            <td> <button type="button " value=" '+data.id+' "  class="delete btn btn-danger">X</button> </td>\
                            </tr>')
                        });
                        $('#total_amount').val(total);
                        $('#total_amount_show').html("")
                        $('#total_amount_show').append('<span class="h4"> + Total Amount Is : '+total+' Tk</span>')
                    }//end success function
                });
            }//all sell data show

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

            $(document).on('click', '.update', function(e){
                e.preventDefault();
                var id =  $(this).val();
                var data={
                    'quantity' : $('.qty').val()
                };

                $.ajax({
                    url: '/quantity-update/'+id,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success:function(response){
                        getData()
                    }//end quantity update function
                });//quantity update ajax end
            })//sell quantity

            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                var id = $(this).val()
                if(id){
                    $.ajax({
                        url: '/sell/delete/'+id,
                        type: 'GET',
                        dataType:'json',
                        success:function(response){
                            console.log(response)

                            getData();

                        }//success function
                    })
                }
            })//sell delete

            // $(document).on('change', '#category_id', function(e){
            //     e.preventDefault();
            //     var id = e.target.value;
            //     if(id){
            //         $.ajax({
            //             url:'/category/product/'+id,
            //             type:'GET',
            //             dataType: 'json',
            //             success:function(response){
            //                 response.forEach(item => {
            //                 $('#product_row').append('<div class="col-sm-6 col-md-4 col-lg-4" id="wrapper_div">\
            //                     <div class="card">\
            //                     <img class="card-img-top" src="..." alt="Card image cap">\
            //                     <div class="card-body">\
            //                     <p class="card-text">\
            //                     '+item.product_name+' <br>\
            //                     '+item.unit_selling_price+'Tk <br>\
            //                     Qty: '+item.purchase.purchase_quantity+' <br>\
            //                     <button class="btn btn-sm btn-success" onclick="add('+item.id+')" >+add</button>\
            //                     </p>\
            //                     </div>\
            //                   </div>\
            //                   </div>')
            //             });
            //             }
            //         })
            //     }
            // })



     </script>
    @endsection
