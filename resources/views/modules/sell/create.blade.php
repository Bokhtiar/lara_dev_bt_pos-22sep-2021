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
                                                    <input type="number" id="due_amount" class="form-control" placeholder="Due Amount" >
                                                </div>
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
        });//end of ajax heaer setup
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
                            <td> <input type="number" id="qty'+item.id+'" oninput="getQty(this.value, '+item.id+'); getSumPrice()"  class="form-control form-control-sm" value="0" name="sell_quantity[]" > </td>\
                            <td> <input type="text" id="unit_selling_price'+item.id+'" class="form-control form-control-sm" value=" '+item.unit_selling_price+' " name="unit_selling_price[]" > </td>\
                            <td> <input type="text" id="total'+item.id+'" class="form-control form-control-sm total" value="" name="total_price[]" > </td>\
                            <td> <button class="btn btn-sm btn-danger">X</button> </td>\
                            </tr>')
                        })
                    }
                })
            }
        })//product serach and show
    })//main document end
    function getQty(qty, num){
        var sell_price = $("#unit_selling_price" + num).val()
        var row_total = qty * sell_price
        $("#total"+num).val(row_total)
    }//row count total price

    function getSumPrice(){
        var row_total = 0;
        $(".total").each(function(){
            row_total += parseFloat(this.value)
        })
        $("#total_amount").val(row_total)
    }//colum count total price

    function pay(amount){
        var total = $("#total_amount").val();
        var paid = total-amount;
        $("#due_amount").val(paid);
    }


    </script>
    @endsection
