@extends('layouts.admin.app')
@section('title', 'Product Create')

@section('css')
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@endsection

@section('admin_content')
    <x-product></x-product>
    <section class="">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">  <i class="far fa-box"></i>   Product Create</h4>
            </div>
            <div class="card-body">
                <form class="form-gorup" action="">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Product Name: <span class="text-danger"> * </span></label>
                            <input type="text" value="{{ @$edit->product_name }}" name="product_name" placeholder="product name" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">SKU: <span title="SKU auto genarate and if you can menual put here"> <i class="text-info far fa-bell"></i> </span> </label>
                            <input type="text" value="{{ @$edit->product_sku }}" placeholder="sku" name="product_sku" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Alert Quantity:  <span title="When your stock is form number equal after alert about product"> <i class="text-info far fa-bell"></i> </span> </label>
                            <input type="number" placeholder="alert qty" minlength="1" value="{{ @$edit->alert_quantity }}" name="alert_quantity" class="form-control">
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Select Category: <span class="text-danger">*</span> </label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $item)
                                <option value="">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Select Sub-Category: <span class="text-danger"> * </span> </label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">--Select Sub-Category--</option>
                                @foreach ($subcategories as $item)
                                <option value="">{{ $item->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Select Brands: <span class="text-danger"> * </span> </label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">--Select Brands--</option>
                                @foreach ($brands as $item)
                                <option value="">{{ $item->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- end name,sku,alert_quntity  --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="">Select Warranty</label>
                            <select name="warranty_id" id="" class="form-control select2">
                                <option value="1">6months</option>
                                <option value="1">1year</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="">Porduct Image</label>
                            <input type="file" class="form-control" value="">
                        </div>
                    </div>
                    {{-- warranty and image --}}
                    <div class="form-gorup">
                       <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Product Descriptions</h5>
                                </div>
                                <div class="card-body">

                                    <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <!-- tools box -->
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool btn-sm" data-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                                <i class="fa fa-minus"></i></button>
                                            <button type="button" class="btn btn-tool btn-sm" data-widget="remove"
                                                data-toggle="tooltip" title="Remove">
                                                <i class="fa fa-times"></i></button>
                                        </div>
                                        <!-- /. tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <textarea class="textarea" name="description" placeholder="Place some text here"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!  @$blog->description  !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-gorup float-right">
                        <span class="btn btn-danger">
                            <i class="far fa-times-circle"></i><input class="btn-sm btn btn-danger" type="reset" name="" id="">
                        </span>
                        <span class="btn btn-primary">
                           <i class="fas fa-share-square"></i><input class="btn-sm btn btn-primary" type="submit" name="" value="Add New Product" id="">
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
<!-- CK Editor -->
<script src="{{ asset('admin') }}/plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="{{ asset('admin') }}/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    $('.select2').select2()
  })
</script>
{{-- select2 end --}}
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
            });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });


        $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
          .create(document.querySelector('#editor1'))
          .then(function (editor) {
            // The editor instance
          })
          .catch(function (error) {
            console.error(error)
          })

        // bootstrap WYSIHTML5 - text editor

        $('.textarea').wysihtml5({
          toolbar: { fa: true }
        })
      })

    </script>
