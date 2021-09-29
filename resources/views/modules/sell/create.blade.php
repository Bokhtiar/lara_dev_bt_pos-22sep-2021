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
                            <div class="col-sm-12 col-md-4 col-lg-4">

                            </div><!--others information-->
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
            })
        })
    </script>
    @endsection
