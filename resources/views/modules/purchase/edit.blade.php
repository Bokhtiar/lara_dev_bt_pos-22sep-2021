    @extends('layouts.admin.app')
    @section('title', 'Purchase Product')

    @section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    @endsection

    @section('admin_content')
        <section class="card">
            <x-purchase></x-purchase>
            <div class="card-body">
                <form action="@route('purchase.update', $purchase->id)" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-gorup">
                        <div class="row">

                             <input type="hidden" name="id" class="id" value="{{ $purchase->product_id }}" id="id">
                             <input type="hidden" name="payment_method" class="payment_method" value="{{ $purchase->payment_method }}" id="payment_method">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Select Supplier <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="supplier_id" id="" required>
                                        <option value="">--select supplier</option>
                                        @foreach ($suppliers as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $purchase->supplier_id ? 'selected' : '' }}>{{ $item->prefix .' '. $item->f_name .' '. $item->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Reference no <span class="text-danger">*</span></label>
                                    <input required type="number" class="form-control" name="reference_no" value="{{ $purchase->reference_no }}"  placeholder="Enter Reference Number" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Date <span class="text-danger">*</span></label>
                                    <input required type="date" name="purchase_date" value="{{ $purchase->purchase_date }}" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Attech File</label>
                            <input type="file" class="form-control" name="attech_file" id="">
                        </div>
                        <div class="form-gorup">
                            <label for="">Note</label>
                            <textarea name="note" id="" cols="10" rows="4" class="form-control" placeholder="note">{{ $purchase->note }}</textarea>
                        </div>
                    </div>
                    @csrf
                    <div>
                        <label for="">Product Select</label>
                        <select name="product_id" class="form-control select2" id="product_id">
                            <option value="">Product select</option>
                            @foreach ($products as $pro)
                            <option value="{{ $pro->id }}" {{ $pro->id == $purchase->product_id ? 'selected' : '' }}>{{ $pro->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-4">
                        <table class="table table-bordered">
                            <thead class="bg-success">
                                <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Purchase Quantity</th>
                                <th scope="col">Unit Cost</th>
                                <th scope="col">Discount percent</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Line Total</th>
                                <th scope="col">Unit Selling Price</th>
                                </tr>
                            </thead>
                            <tbody id="table_value">
                                {{-- dynamic value added in jquery --}}
                            </tbody>
                            </table>
                            <div class="float-right" id="total_amount_show">
                                {{-- <span>Total Amount Is : '+total+'</span> --}}
                            </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-header">
                            <h4 class="card-title">Payment Info.</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <P><span class="h3">Due Amount</span> : <span class="btn btn-success">{{ $purchase->line_total - $purchase->amount }} Tk</span></P>
                                    <label for="">Amount. <span class="text-danger">*</span></label>
                                    <input value="{{ $purchase->amount }}" type="number" name="amount" class="form-control" id="">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="">Paid on. <span class="text-danger">*</span></label>
                                    <input type="date" value="{{ $purchase->paid_on_date }}" name="paid_on_date" class="form-control" id="">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="">Payment Methods</label>
                                <select class="form-control select2" name="payment_method" id="payment_method">
                                    <option value="">--select payment method--</option>
                                    <option value="Bkash" {{ 'Bkash' == $purchase->payment_method ? 'selected' : '' }}>Bkash</option>
                                    <option value="Nagud" {{ 'Nagud' == $purchase->payment_method ? 'selected' : '' }}>Nagud</option>
                                    <option value="Rocket" {{ 'Rocket' == $purchase->payment_method ? 'selected' : '' }}>Rocket</option>
                                    <option value="Bank" {{ 'Bank' == $purchase->payment_method ? 'selected' : '' }}>Bank</option>
                                </select>
                            </div>

                            <!--pyament mehtods start here -->
                            <div class="form-gorup my-3 card" id="Bkash" style="display: none">
                                <p class="card-header">
                                    <h5 class="card-title">Bkash Payment Methods <span class="text-danger">*</span></h5>
                                </p>
                                <p class="card-body">
                                <label for="">Bkash Number</label>
                                <input type="number" class="form-control" placeholder="bkash number" value="{{ $purchase->bkash }}" name="bkash">
                                </p>
                            </div><!--bkash-->
                            <div class="form-gorup my-3 card" id="Nagud" style="display: none">
                                <p class="card-header">
                                    <h5 class="card-title">Nagud Payment Methods</h5>
                                </p>
                                <p class="card-body">
                                <label for="">Nagud Number</label>
                                <input type="number" class="form-control" placeholder="nagud number" value="{{ $purchase->nagud }}" name="nagud">
                                </p>
                            </div><!--nagud-->
                            <div class="form-gorup my-3 card" id="Rocket" style="display: none">
                                <p class="card-header">
                                    <h5 class="card-title">Rocket Payment Methods</h5>
                                </p>
                                <p class="card-body">
                                <label for="">Rocket Number</label>
                                <input type="number" class="form-control" placeholder="Rocket number" value="{{ $purchase->rocket }}" name="rocket">
                                </p>
                            </div><!--bkash-->
                            <div class="form-gorup my-3 card" id="Bank" style="display: none">
                                <p class="card-header">
                                    <h5 class="card-title">Bank Payment Methods</h5>
                                </p>
                                <p class="card-body">
                                <label for="">Bank Account Number</label>
                                <input type="number" class="form-control" placeholder="bank account number" value="{{ $purchase->bank }}" name="bank">
                                </p>
                            </div><!--bkash-->
                            <!--payment methods end here -->

                        </div>
                    </div>
                    <div class="float-right">
                        <input type="submit" class="btn btn-primary" value="Update Purchase">
                    </div>
                </form>
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

        //edit option auto selelct product
        var edit_id = $('#id').val();
        if(edit_id){
            $.ajax({
                url:'/product_purchase_search/'+edit_id,
                type: 'GET',
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#table_value').append('<tr>\
                    <td>'+data.product_name+'</td>\
                    <td> <input class="form-control form-control-sm" type="text" value=" '+data.purchase.purchase_quantity+' " name="purchase_quantity" id="purchase_quantity"> </td>\
                    <td> <input class="form-control form-control-sm" type="text" value=" '+data.purchase.unit_cost+' " name="unit_cost" id="unit_cost"> </td>\
                    <td> <input class="form-control form-control-sm" type="text" value=" '+data.purchase.discount_percent+' "  name="discount_percent" id="discrount_percent"> </td>\
                    <td> <input class="form-control form-control-sm" type="text" value=" '+data.purchase.tax+' " name="tax" id="tax" </td>\
                    <td> <input class="form-control form-control-sm" type="text" value=" '+data.purchase.line_total+' " name="line_total" id="line_total">  </td>\
                    <td> <input class="form-control form-control-sm" type="text" value=" '+data.purchase.unit_selling_price+' " name="unit_selling_price" id="unit_selling_price"> </td>\
                    </tr>')
                    $("input").keyup(function(){
                        var quantity = $('#purchase_quantity').val();
                        var unit_cost = $('#unit_cost').val();
                        var total = quantity * unit_cost;
                        $('#line_total').val(total)
                        $('#total_amount_show').html("")
                        $('#total_amount_show').append('<span class="h4"> + Total Amount Is : '+data.line_total+' Tk</span>')
                    });
                }//return success function
            })//this is ajax end
        }
        //end of auto select product



        $(document).ready(function(){
            var payment_name = $('#payment_method').val();
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
        });


    </script>
    @endsection
