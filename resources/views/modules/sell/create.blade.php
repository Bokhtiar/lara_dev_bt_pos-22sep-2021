    @extends('layouts.admin.app')

    @section('title', 'Sell Create')
    @section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    @endsection

    @section('admin_content')
        <section class="">
            <div class="card container">
                <x-sell></x-sell>
                <div class="body">
                    <form action="" class="form-group">
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
                                                <option value="{{ $item->id }}">{{ $item->product_name }}</option>
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
                                                <th scope="col">Discount</th>
                                                <th scope="col">X</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>x</td>
                                                </tr>
                                                <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                                <td>x</td>
                                                </tr>
                                                <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                                <td>x</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            <div class="float-right">
                                                <button class="btn btn-info">Items: 0.00</button>
                                                <button class="btn btn-primary">Total Amount: 0.00</button>
                                            </div>
                                    <!--table start -->
                                </div>
                            </div>
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
            })//customer end

        })
    </script>
    @endsection
