    @extends('layouts.admin.app')
    @section('title', 'Purchase Product')

    @section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    @endsection

    @section('admin_content')
        <section class="">
            <div>
                <form action="">
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
                                <th scope="col">Unite Cose<br>(before disceout)</th>
                                <th scope="col">Discount percent</th>
                                <th scope="col">Unite Cose<br>(before tax)</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Line Total</th>
                                <th scope="col">Profit Margin %</th>
                                <th scope="col">Unit Selling Price</th>
                                <th scope="col">X</th>
                                </tr>
                            </thead>
                            <tbody id="table_value">
                                {{-- dynamic value added in jquery --}}
                            </tbody>
                            </table>
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
            $('#product_id').on('change', function(e){
                var id = e.target.value;
                if(id){
                    $.ajax({
                        url:'/product_purchase_search/'+id,
                        type: 'GET',
                        dataType: 'json',
                        success:function(data){
                            $('#table_value').append('<tr>   <td>'+data.product_name+'</td>    <td> <input class="form-control form-control-sm" type="number" value="1" name="purchase_quantity" id="purchase_quantity"> </td>      <td> <input class="form-control form-control-sm" type="number" value="50" name="unit_cost_before_discount" id="unit_cost_before_discount"> </td>        <td> <input class="form-control form-control-sm" type="number" name="discrount_percent" id="discrount_percent"> </td>        <td> <input class="form-control form-control-sm" type="number" name="unit_cost_before_tax" id="unit_cost_before_tax"> </td>         <td> <input class="form-control form-control-sm" type="number" name="tax" id="tax"> </td>          <td> <input class="line_total" id="line_total">  </td>         <td> <input class="form-control form-control-sm" type="number" name="profit_margin" id="profit_margin"> </td>       <td> <input class="form-control form-control-sm" type="number" value="19023" name="selling_price" id="selling_price"> </td>                </tr>')


                               $("#").on('input', function(){
                                   var quantity = $(this).val();

                               })




                        }//return success function
                    })//this is ajax end
                }


            })
        });


    </script>
    @endsection
