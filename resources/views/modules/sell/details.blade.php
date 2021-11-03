
    @extends('layouts.admin.app')
    @section('title', 'Order Details')

    @section('css')
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @endsection
    @section('admin_content')
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fa fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fa fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: {{ $item->created_at }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, Inc.</strong><br>
                    Name: {{ $item->user ? $item->user->name : '' }} <br>
                    Email: {{ $item->user ? $item->user->email : '' }} <br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $item->customer->prefix_name .' '. $item->customer->f_name .' '. $item->customer->l_name }}</strong><br>
                   {{ $item->customer->city .' '.  $item->customer->state .' '. $item->customer->country}}<br>

                    Phone: {{ $item->customer ? $item->customer->phone : '' }}<br>
                    Email: {{ $item->customer ? $item->customer->email : '' }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice {{ $item->invoice_no }}</b><br>
                  <br>
                  <b>Order ID:</b> {{ $item->id }}<br>
                  <b>Account:</b> {{ $item->payment_method }}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped text-center">
                    <thead class="bg-success">
                    <tr>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Line Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                    @foreach (App\Models\SellProduct::query()->SellProduct($item->id) as $sell)
                      <tr>
                        <td>{{ $sell->product ? $sell->product->product_name : 'product Already Deleted' }}</td>
                        <td>{{ $sell->sell_quantity}}</td>
                        <td>{{ $sell->unit_selling_price }} Tk</td>
                        <td>{{ $sell->total_price }} Tk</td>
                        <?php $total += $sell->total_price ?>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img height="60" width="100px" src="{{ asset('admin') }}/b.png" alt="Visa">
                  <img height="40" width="100px" src="{{ asset('admin') }}/r.png" alt="Visa">
                  <img height="40" width="100px" src="{{ asset('admin') }}/n.png" alt="Visa">
                  <img height="40" width="100px" src="{{ asset('admin/bb.jpg') }}" alt="Mastercard">
                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                   {{ $item->note }}
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Paid Date on Time : {{ $item->created_at }}</p>

                  <div class="table-responsive">
                    <table class="table">

                      <tr>
                        <th>Total:</th>
                        <td>{{ $total }} Tk</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button id="print"  class="btn btn-default"><i class="fa fa-print"></i> Print</button>

                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  @endsection



<!-- ./wrapper -->
@section('js')
    <script>
        $(document).on('click', '#print', function(){
            window.print();
           return false;
        })
    </script>
@endsection
</html>
