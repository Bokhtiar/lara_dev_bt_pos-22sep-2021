@extends('layouts.admin.app')
@section('title', 'Product Create')

@section('css')
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
<link rel="stylesheet" href="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@endsection

@section('admin_content')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <x-product></x-product>
    <section class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">  <i class="far fa-box"></i>  {{ @$edit ? 'Product Update' : 'Product Create' }} </h4>
                <a class="ml-auto btn btn-success" href="@route('product.create')">Every Product Add</a>
            </div>
            <div class="card-body">
                @if (isset($edit))
                <form class="form-gorup" action="@route('tin.update',$edit->id)" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @else
                    <form class="form-gorup" enctype="multipart/form-data" action="@route('tin.store')" method="POST">
                @endif
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="">Product Name: <span class="text-danger"> * </span></label>
                            <input type="text" value="{{ @$edit->product_name }}" name="product_name" placeholder="product name" class="form-control">
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            <label for="">Select Category: <span class="text-danger">*</span> </label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == @$edit->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Select Sub-Category: <span class="text-danger"> * </span> </label>
                            <select name="subcategory_id" id="" class="form-control select2">
                                <option value="">--Select Sub-Category--</option>
                                @foreach ($subcategories as $sub)
                                <option value="{{ $sub->id }}" {{ $sub->id == @$edit->subcategory_id ? 'selected' : '' }}>{{ $sub->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Select Brands: <span class="text-danger"> * </span> </label>
                            <select name="brand_id" id="" class="form-control select2">
                                <option value="">--Select Brands--</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == @$edit->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                            <label for="">Select Tin Variants: <span class="text-danger"> * </span> </label>
                            <select name="fit" id="" class="form-control select2">
                                <option value="">--Select Brands--</option>
                                <option value="6">6fit</option>
                                <option value="7">7fit</option>
                                <option value="8">8fit</option>
                                <option value="9">9fit</option>
                                <option value="10">10fit</option>
                                <option value="12">12fit</option>
                            </select>
                        </div>
                    </div>
                    {{-- end name,sku,alert_quntity  --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="">Tin M.M</label>
                            <input type="text" name="mm" class="form-control" placeholder="m.m">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="">Porduct Image</label>
                            <input type="file" class="form-control" name="product_image[]" multiple value="">
                        </div>
                    </div>
                    {{-- warranty and image --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">Select Unite: <span class="text-danger">*</span></label>
                                <select name="tin_unit" id="" class="form-control select2">
                                    <option value="">--Select Unit--</option>
                                    <option value="ton">Ton</option>
                                    <option value="ban">Ban</option>
                                    <option value="pc">Pc</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">unit ton price<span class="text-danger">*</span></label>
                                <input class="form-control" name="unit_total_price" placeholder="unit_total_price" value="{{ @$edit->unit_total_price }}">
                                <!--unit_total_price and unit_ton_price is same-->
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">unit ban price<span class="text-danger">*</span></label>
                                <input class="form-control" name="unit_ban_price" placeholder="unit_ban_price" value="{{ @$edit->unit_ban_price }}">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">unit per pc price<span class="text-danger">*</span></label>
                                <input class="form-control" name="unit_per_pc_price" placeholder="unit_per_pc_price" value="{{ @$edit->unit_per_pc_price }}">
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">unit Sell ton price<span class="text-danger">*</span></label>
                                <input class="form-control" name="unit_sell_total_price" placeholder="unit_sell_total_price" value="{{ @$edit->unit_sell_total_price }}">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">unit sell ban price<span class="text-danger">*</span></label>
                                <input class="form-control" name="unit_sell_ban_price" placeholder="unit_sell_ban_price" value="{{ @$edit->unit_sell_ban_price }}">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="">unit sell per pc price<span class="text-danger">*</span></label>
                                <input class="form-control" name="unit_sell_per_pc_price" placeholder="unit_sell_per_pc_price" value="{{ @$edit->unit_sell_per_pc_price }}">
                            </div>
                        </div>

                    </div>
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
                                            <textarea class="textarea" name="product_description" placeholder="Place some text here"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!  @$edit->product_description  !!}</textarea>
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
                            @if (isset($edit))
                                <i class="fas fa-share-square"></i><input class="btn-sm btn btn-primary" type="submit" name="" value="Update Product" id="">
                                @else
                                <i class="fas fa-share-square"></i><input class="btn-sm btn btn-primary" type="submit" name="" value="Add New Product" id="">
                                @endif

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
