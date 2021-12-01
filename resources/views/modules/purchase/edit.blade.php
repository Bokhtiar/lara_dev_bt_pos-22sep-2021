@extends('layouts.admin.app')
@section('title', 'Purchase Edit')

@section('css')
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
@endsection

@section('admin_content')
    <section class="card">
        <x-purchase></x-purchase>
        <div class="card-body">
            <form action="@route('purchase.update',$purchase->id)" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-gorup">
                    <div class="row">
                        <input type="hidden" name="" value="{{ $purchase->id }}" id="purchase_id">
                        <input type="hidden" name="" value="{{ $purchase->payment_method }}" id="payment_method">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="">Select Supplier <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="supplier_id" id="" required>
                                    <option value="">--select supplier</option>
                                    @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $purchase->supplier_id ? 'Selected' : '' }}>{{ $item->prefix .' '. $item->f_name .' '. $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="">Reference no <span class="text-danger">*</span></label>
                                <input required type="number" class="form-control" value="{{ $purchase->reference_no }}" name="reference_no" placeholder="Enter Reference Number" id="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="">Date <span class="text-danger">*</span></label>
                                <input required type="date" name="purchase_date" value="{{ $purchase->purchase_date }}" class="form-control" id="">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Attech File</label>
                        <input type="file" class="form-control" name="attech_file" id="">
                    </div> --}}
                    <div class="form-gorup">
                        <label for="">Note</label>
                        <textarea name="note" id="" cols="10" rows="4" class="form-control" placeholder="note"></textarea>
                    </div>
                </div>
                @csrf
                <div>
                    <label for="">Product Select</label>
                    <select name="product_id" class="form-control select2" id="product_id">
                        <option value="">Product select</option>
                        @foreach ($products as $pro)
                        <option value="{{ $pro->id }}">{{ $pro->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-4">
                    <table class="table table-bordered">
                        <thead class="bg-success">
                            <tr>
                            <th scope="col">Product Name</th>
                            {{-- <th scope="col">Purchase Id</th>
                            <th scope="col">Product Id</th> --}}
                            <th scope="col">Purchase Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- dynamic value added in jquery --}}
                        </tbody>
                    </table>
                    <div class="float-right" id="total_amount_show">
                        {{-- <span>Total Amount Is : '+total+'</span> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-lg-8">

                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <input required type="number" id="total_amount" name="total_amount" class="form-control mb-2" placeholder="Total Amount" id="">
                            <input type="number" id="paid_amount" oninput="pay(this.value)" value="0" name="paid_amount" class="form-control mb-2">
                            <input type="number" class="form-control" placeholder="Due Amount" id="due_amount">
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header">
                        <h4 class="card-title">Payment Info.</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="">Paid on. <span class="text-danger">*</span></label>
                                <input type="date" name="paid_on_date" value="{{ $purchase->paid_on_date }}" class="form-control" id="">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-control">
                                    <label for="">Payment Methods</label>
                                    <select class="form-control select2" name="payment_method" id="payment_method">
                                        <option value="">--select payment method--</option>
                                        <option value="Handcash" {{ 'Handcash' == $purchase->payment_method ? 'selected' : '' }}>Handcash</option>
                                        <option value="Bkash" {{ 'Bkash' == $purchase->payment_method ? 'selected' : '' }}>Bkash</option>
                                        <option value="Nagud" {{ 'Nagud' == $purchase->payment_method ? 'selected' : '' }}>Nagud</option>
                                        <option value="Rocket" {{ 'Rocket' == $purchase->payment_method ? 'selected' : '' }}>Rocket</option>
                                        <option value="Bank" {{ 'Bank' == $purchase->payment_method ? 'selected' : '' }}>Bank</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--pyament mehtods start here -->
                        <div class="form-gorup my-3 card" id="Bkash" style="display: none">
                            <p class="card-header">
                                <h5 class="card-title">Bkash Payment Methods <span class="text-danger">*</span></h5>
                            </p>
                            <p class="card-body">
                            <label for="">Bkash Number</label>
                            <input type="number" class="form-control" placeholder="bkash number" name="bkash" value="{{ $purchase->bkash }}">
                            </p>
                        </div><!--bkash-->
                        <div class="form-gorup my-3 card" id="Nagud" style="display: none">
                            <p class="card-header">
                                <h5 class="card-title">Nagud Payment Methods</h5>
                            </p>
                            <p class="card-body">
                            <label for="">Nagud Number</label>
                            <input type="number" class="form-control" placeholder="nagud number" name="nagud" value="{{ $purchase->nagud }}">
                            </p>
                        </div><!--nagud-->
                        <div class="form-gorup my-3 card" id="Rocket" style="display: none">
                            <p class="card-header">
                                <h5 class="card-title">Rocket Payment Methods</h5>
                            </p>
                            <p class="card-body">
                            <label for="">Rocket Number</label>
                            <input type="number" class="form-control" placeholder="Rocket number" name="rocket" value="{{ $purchase->rocket }}">
                            </p>
                        </div><!--bkash-->
                        <div class="form-gorup my-3 card" id="Bank" style="display: none">
                            <p class="card-header">
                                <h5 class="card-title">Bank Payment Methods</h5>
                            </p>
                            <p class="card-body">
                            <label for="">Bank Account Number</label>
                            <input type="number" class="form-control" placeholder="bank account number" name="bank" value="{{ $purchase->bank }}">
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

    $(document).ready(function(){
        //purchase edit code
        var edit_id = $('#purchase_id').val();

        if(edit_id){
            $.ajax({
                url: '/purchae_edit_product/'+edit_id,
                type:'GET',
                dataType:'json',
                success:function(response){
                    console.log(response.product)
                    $.each(response.product, function(key, item){
                            $('tbody').append('<tr>\
                                <td>'+item.product.product_name+'</td>\
                                <input type="hidden" class="form-control form-control-sm" value="'+item.id+'" name="purchaseProduct_id[]">\
                                <input required type="hidden" class="form-control form-control-sm" value="'+item.product.id+'" name="product_id[]">\
                                <td>  <input required type="number" id="qty'+item.id+'"  oninput="sumQty(this.value, '+item.id+');getSumQuantity()" class="form-control form-control-sm qty" value="'+item.purchase_quantity+'" name="purchase_quantity[]"> </td>\
                                <td> <input required type="number" id="unit'+item.id+'" class="form-control form-control-sm unit_price" value="'+item.unit_price+'" name="unit_price[]"></td>\
                                <td> <input required type="text" id="tot'+item.id+'"  class="form-control form-control-sm total" value="'+item.total_price+'" name="total_price[]"></td>\
                                <td> X </td>\
                            </tr>')
                        })
                }
            })
        }




        $('#product_id').on('change', function(e){
            var id = e.target.value;
            if(id){
                $.ajax({
                    url:'/product_purchase_search/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success:function(response){
                        $.each(response, function(key, item){
                            $('tbody').append('<tr>\
                                <td>'+item.product_name+'</td>\
                                <input type="hidden" class="form-control form-control-sm" value="" name="purchaseProduct_id[]">\
                                <input required type="hidden" class="form-control form-control-sm" value="'+item.id+'" name="product_id[]">\
                                <td> <input required type="number" id="qty'+item.id+'"  oninput="sumQty(this.value, '+item.id+');getSumQuantity()" class="form-control form-control-sm qty" value="00" name="purchase_quantity[]"> </td>\
                                <td> <input required type="number" id="unit'+item.id+'" class="form-control form-control-sm unit_price" value="'+item.unit_price+'" name="unit_price[]"></td>\
                                <td> <input required type="text" id="tot'+item.id+'"  class="form-control form-control-sm total" value="00" name="total_price[]"></td>\
                                <td> X </td>\
                            </tr>')
                        })
                    }//return success function
                })//this is ajax end
            }
        });


        //edit payment methods


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
    });


        function sumQty(sum, nu){
            var s = $('#unit'+nu).val();
            var to = sum * s;
            $('#tot'+nu).val(to);
        }


        function getSumQuantity(){
            var sumQuantity = 0;
            $(".total").each(function(){
                sumQuantity += parseFloat(this.value)
            })
            $('#total_amount').val(sumQuantity);
        }

        function pay(amount){
        var total = $("#total_amount").val();
        var paid = total-amount;
        $("#due_amount").val(paid);
    }//sum total
</script>
@endsection
