@extends('layouts.admin.app')
@section('title', 'Purchase Product')

@section('css')
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

@section('admin_content')
<!-- Button trigger modal -->



    <section class="card">
        <x-purchase></x-purchase>
        <div class="card-body">
            <form action="@route('purchase.store')" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-gorup">
                    <div class="row">

                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group form-inline">
                                <label for="">Select Supplier <span class="text-danger">*</span></label><br>
                                <select class="form-control select2" name="supplier_id" id="" required>
                                    <option value="">--select supplier</option>
                                    @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}">{{ $item->prefix .' '. $item->f_name .' '. $item->last_name }}</option>
                                    @endforeach
                                </select> &nbsp;&nbsp;
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    +
                                  </button>
                            </div>

                        </div>

                        {{-- <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="">Reference no <span class="text-danger">*</span></label>
                                <input required type="number" class="form-control" name="reference_no" placeholder="Enter Reference Number" id="">
                            </div>
                        </div> --}}
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for=""> Purchase Date <span class="text-danger">*</span></label>
                                <input required type="date" name="purchase_date" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for=""> Due Paid Date <span class="text-danger">*</span></label>
                                <input required type="date" name="due_paid_date" class="form-control" id="">
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
                            <input type="number" id="total_amount" name="total_amount" class="form-control mb-2" placeholder="Total Amount" id="">
                            <input type="number" name="paid_amount" oninput="pay(this.value)" class="form-control mb-2" placeholder="Paid Amount" id="">
                            <input type="number" id="due_amount" class="form-control" placeholder="Due Amount" >
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
                                <input type="date" name="paid_on_date" class="form-control" id="">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-control">
                                    <label for="">Payment Methods</label>
                                    <select class="form-control select2" name="payment_method" id="payment_method">
                                        <option value="">--select payment method--</option>
                                        <option value="Handcash">Handcash</option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagud">Nagud</option>
                                        <option value="Rocket">Rocket</option>
                                        <option value="Bank">Bank</option>
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
                    <input type="submit" class="btn btn-primary" value="Add New Purchase">
                </div>
            </form>


            <!-- Modal supplier add start -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                            <form action="@route('contact.store')" class="form-group" method="POST">
                            @csrf

                            <div class="form-gorup mb-3">
                                <label for="">Select Contact <span class="text-danger">*</span> </label>
                                <select class="form-control" name="contact_info" id="contact_info">
                                    <option value="">Select Contact</option>
                                    <option value="Supplier" >Supplier</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group mb-3">
                                    <label for="">Prefix <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="mr/ms" value="" name="prefix_name" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group mb-3">
                                    <label for="">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="first name" value="" name="f_name" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group mb-3">
                                    <label for="">Last Name <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" placeholder="last name" value="" name="l_name" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-3">
                                    <label for="">E-mail</label>
                                    <input type="email" class="form-control" placeholder="email" name="email" value="" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-3">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="phone" class="form-control" placeholder="phone" name="phone" value="" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" placeholder="city" name="city" value="" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" placeholder="state" name="state" value="" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" placeholder="country" name="country" value="" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">Zip Code</label>
                                    <input type="text" class="form-control" placeholder="Zip Code" value="" name="zip" id="">
                                    </div>
                                </div>
                            </div>
                            <div id="supplier_info" style="display: none">
                                <span class="h4">please More Information:</span>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-3">
                                        <label for="">Company Name</label>
                                        <input type="text" class="form-control" placeholder="company name" value="" name="company_name" id="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-3">
                                        <label for="">Company Phone</label>
                                        <input type="number" class="form-control" placeholder="company phone" value="" name="company_phone" id="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-3">
                                        <label for="">Company E-mail</label>
                                        <input type="email" class="form-control" placeholder="company email" value="" name="company_email" id="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="float-right">
                                <span class="btn-sm btn btn-danger"><i class="far fa-times-circle"></i><input class="btn-sm btn btn-danger"  type="reset" name="" id=""></span>
                                <span class="btn-sm btn btn-primary"><i class="fas fa-share-square"></i><input class="btn-sm btn btn-primary" type="submit" name="" value="Add New Contact" id=""></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
            <!--supplier modal end here -->
        </div>
    </section>
@endsection



@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
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
        $('#product_id').on('change', function(e){
            var id = e.target.value;
            if(id){
                $.ajax({
                    url:'/product_purchase_search/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success:function(response){
                        console.log(response)
                        if(response.product.fit == null){
                            $.each(response, function(key, item){
                            $('tbody').append('<tr>\
                                <td>'+item.product_name+'</td>\
                                 <input type="hidden" class="form-control form-control-sm" value="'+item.id+'" name="product_id[]">\
                                <td> <input type="number" id="qty'+item.id+'"  oninput="sumQty(this.value, '+item.id+');getSumQuantity()" class="form-control form-control-sm qty" value="0" name="purchase_quantity[]"> </td>\
                                <td> <input type="number" id="unit'+item.id+'" class="form-control form-control-sm unit_price" value="'+item.unit_price+'" name="unit_price[]"></td>\
                                <td> <input type="text" id="tot'+item.id+'"  class="form-control form-control-sm total" value="00" name="total_price[]"></td>\
                                <td> X </td>\
                            </tr>')
                        })//if tin variant id null then access here
                        }else{
                            $.each(response, function(key, item){
                            $('tbody').append('<tr>\
                                <td>'+item.product_name+'</td>\
                                <input type="hidden" class="form-control form-control-sm" value="tin" name="tin[]">\
                                <input type="hidden" class="form-control form-control-sm" value="'+item.id+'" name="product_id[]">\
                                <td> <label for="">How Much Purchase Ton <span class="text-danger">*</span></label>\ <input type="number" id="qty'+item.id+'"  oninput="sumQty(this.value, '+item.id+');getSumQuantity()" class="form-control form-control-sm qty" value="0" name="purchase_quantity[]"> </td>\
                                <td> <input type="number" id="unit'+item.id+'" class="form-control form-control-sm unit_price" value="'+item.unit_total_price+'" name="unit_price[]"></td>\
                                <td> <input type="text" id="tot'+item.id+'"  class="form-control form-control-sm total" value="00" name="total_price[]"></td>\
                                <td> X </td>\
                            </tr>')
                        })
                        }

                    }//return success function
                })//this is ajax end
            }
        });


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
