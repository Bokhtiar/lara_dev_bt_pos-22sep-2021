@extends('layouts.admin.app')

    @section('title', 'Dashboard')
    @section('css')
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css"> --}}
    @endsection

    @section('admin_content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3 ">

                <div class="info-box p-5">
                  <span class="info-box-icon bg-info elevation-1"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Product</span>
                    <span class="info-box-number">
                      {{ $product }}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 p-5">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Customer</span>
                    <span class="info-box-number">{{ $contact }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-3 ">
                <div class="info-box mb-3 p-5">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Sell</span>
                    <span class="info-box-number">{{ $sell }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 p-5">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Supplier</span>
                    <span class="info-box-number">{{ $contact }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->


        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Low Stock Products</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($products as $item)
                        @if($item->product->alert_quantity > $item->purchase_quantity)
                        <li class="item">
                            <div class="product-img">
                                @php
                            $image=json_decode($item->product->product_image);
                            @endphp

                            @if(empty($image))
                                <td>Image Not Selected</td>
                            @else
                                <td><img src="{{asset($image[0])}}" height="60px" width="60px" alt=""> </td>
                            @endif
                            </div>
                            <div class="product-info">
                              <a href="javascript:void(0)" class="product-title">{{ $item->product->product_name }}</a>
                              <span class="product-description">
                                @if($item->product->fit == null)
                                <span class="badge badge-danger float-right" >Stock Quantity : {{ $item->purchase_quantity }} {{ $item->product->unit->unit_short_name }}</span>
                                @else
                                <span class="badge badge-danger float-right" >Stock Quantity : {{ $item->purchase_quantity }} pc</span>
                                @endif
                              </span>
                            </div>
                          </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <a href="@route('product.stock.alert')" class="uppercase">View All Products</a>
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Customer Due</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($customers  as $cus)
                            @if ($cus->total_amount != $cus->paid_amount)
                                <li class="item">
                                    <div class="product-img">
                                        <span class="info-box-icon elevation-1"><i class="p-2 img-size-50 fas fa-user-tie"></i></span>

                                    </div>
                                    <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"> {{$cus->customer ? $cus->customer->prefix_name .' '. $cus->customer->f_name .' '. $cus->customer->l_name : 'Data Deleted' }}
                                        <span class="badge badge-danger float-right">Due: {{ $cus->total_amount - $cus->paid_amount }} TK</span></a>
                                    <span class="product-description">
                                        Due Clear Date: {{ $cus->due_paid_date }}
                                    </span>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                      </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <a href="@route('customer.due.index')" class="uppercase">View All Customer Due</a>
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->


            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Supplier Due</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($suppliers  as $sup)
                            @if ($sup->total_amount != $sup->paid_amount)
                                <li class="item">
                                    <div class="product-img">
                                        <span class="info-box-icon elevation-1"><i class="p-2 img-size-50 fas fa-user-tie"></i></span>

                                    </div>
                                    <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"> {{$sup->supplier ? $sup->supplier->prefix_name .' '. $sup->supplier->f_name .' '. $sup->supplier->l_name : 'Data Deleted' }}
                                        <span class="badge badge-danger float-right">Due: {{ $sup->total_amount - $sup->paid_amount }} TK</span></a>
                                    <span class="product-description">
                                        Due Clear Date: {{ $sup->due_paid_date }}
                                    </span>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                      </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <a href="@route('supplier.due.index')" class="uppercase">View All Supplier Due</a>
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    @endsection
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'print', 'excel', 'pdf', 'csvHtml5', 'colvis' ]
        } );

        table.buttons().container()
            .insertBefore( '#example_filter' );
    } );
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.jqueryui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.jqueryui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script> --}}
    @endsection
