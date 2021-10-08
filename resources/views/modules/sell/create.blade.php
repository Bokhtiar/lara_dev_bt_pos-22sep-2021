    @extends('layouts.admin.app')

    @section('title', 'Sell Create')
    @section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    @endsection
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

    @section('admin_content')

        <section class="">
            <div class="card container">
                <x-sell></x-sell>
                <div class="body">
                    <form action="@route('order.store') " method="POST" class="form-group">
                        @csrf
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

                        <div class="my-3">
                            <div class="">
                                <div class="card-header"></div>
                                <div class="">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <label for="">Select Product</label>
                                            <select name="product_id" id="product_id" class="form-control select2">
                                                <option value="">--Select Product--</option>
                                                @foreach ($products as $item)
                                                <option value="{{ $item->id }}"> {{ $item->product_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--table start -->
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
                                            <div class="float-right" id="total_amount_show">
                                                <button class="total btn btn-primary"></button>
                                            </div>
                                    <!--table start -->
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="">
                            <label for="">Note</label>
                            <textarea placeholder="note" name="note" id="" cols="10" rows="3" class="form-control"></textarea>
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

        $(function () {
            $('.select2').select2()
        })
        //end of select2

        $(document).ready(function() {
            $('#customer_id').on('change', function(e){
                var id = e.target.value
                if(id){
                    $.ajax({
                        url : '/customer/info/'+id,
                        dataType : 'Json',
                        type : 'GET',
                        success:function(data){
                            $('#customer_detail').append('<p>Customer Phone: '+data.phone+'</p> <p>Customer Email: '+data.email+'</p> <h5>Locations</h5> <p class="ml-2"> '+data.city+' '+data.state+' '+data.country+'</p> ')
                        }//data return end
                    })//ajax end
                }
            });//customer end

            $('#product_id').on('change', function(e){
                var id = e.target.value
                if(id){
                    $.ajax({
                        url : '/store/sell/'+id,
                        type: 'GET',
                        dataType: 'Json',
                        success:function(data){
                            getData()
                        }//eend ajax url
                    })
                }//end if condition
            });//product id



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



        })//main document end



    </script>
    @endsection
