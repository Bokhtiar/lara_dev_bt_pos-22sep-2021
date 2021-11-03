@extends('layouts.admin.app')

    @section('title', 'Dashboard')
    @section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
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
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>

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
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-google-plus"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Supplier and Customer</span>
                    <span class="info-box-number">{{ $contact }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">User</span>
                    <span class="info-box-number">{{ $user }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Sell</span>
                    <span class="info-box-number">{{ $sell }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->



            <section class="card">
                <x-order></x-order>
            <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Pay Amount</th>
                    <th>DUE Amonut</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sells as $item)
                    <tr>
                    <td>
                        <div class="btn-group">
                        <button type="button" class=" btn-success btn ">Action</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu" role="menu">
                            @if($item->pay_amount == $item->total_amount)
                            <span class="dropdown-item">no Due</span>
                            @else
                            <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                Due Payment
                              </button>
                            @endif
                            <a class="dropdown-item" href="@route('order.show', $item->id)"><i class="btn btn-sm btn-success fas fa-eye"></i></a>
                            <form action="@route('order.destroy',$item->id)" method="POST">
                                @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item "><i class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                      </div>

                    </td>
                    <td>{{$item->customer ? $item->customer->prefix_name .' '. $item->customer->f_name .' '. $item->customer->l_name : ''}}</td>
                    <td>{{ $item->total_amount }}TK</td>
                    <td>{{ $item->paid_amount }}TK</td>
                    <td>{{ $item->total_amount - $item->paid_amount }}TK</td>
                    <td>{{ $item->created_at->diffForHumans() }}</td>
                    <td>
                        @if($item->status == 1)
                            <a class="" href="@route('sell.status',$item->id)"><span class="badge badge-success" title="if you click this button chenge the status">successfully</span></a>
                            @else
                            <a class="" href="@route('sell.status',$item->id)" ><span class="badge badge-danger" title="if you click this button chenge the status">pending</span></a>
                        @endif
                    </td>
                    </tr>

                    <!-- payment Modal -->
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                   <span>Due Amount is :  {{ $item->total_amount - $item->pay_amount }}</span>
                                        <form action="@route('order.update', $item->id)" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-gorup">
                                                <label for="">How Many pay amount</label>
                                            <input type="number" name="pay_amount" class="form-control" placeholder="pay amount" id="">
                                            </div>

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                                </div>
                            </div>
                            </div>
                        </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Action</th>
                    <th>Customer Name</th>
                    <th>Pay Amount</th>
                    <th>Total Amount</th>
                    <th>DUE Amonut</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </tfoot>
            </table>
        </div>
        </section>


          </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->

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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.jqueryui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.jqueryui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>
    @endsection
