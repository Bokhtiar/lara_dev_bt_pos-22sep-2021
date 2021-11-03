
    @extends('layouts.admin.app')
    @section('title', 'Supplier Invoice')

    @section('css')
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <small class="float-right">Date: 2/10/2014</small>
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
                    Email: {{ $item->user ? $item->user->email : '' }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $item->supplier->prefix_name .' '. $item->supplier->f_name .' '. $item->supplier->l_name }}</strong><br>
                   {{ $item->supplier->city .' '.  $item->supplier->state .' '. $item->supplier->country}}<br>

                    Phone: {{ $item->supplier->phone }}<br>
                    Email: {{ $item->supplier->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice {{ $item->invoice_no }}</b><br>
                  <br>
                  <b>Purchase ID:</b> {{ $item->id }}<br>
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
                      <th>Qty</th>
                      <th>Product Name</th>
                      <th>Unit Price</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($products as $p)
                        <tr>
                            <td>{{ $p->purchase_quantity }}</td>
                            <td>{{ $p->product->product_name }}</td>
                            <td>{{ $p->unit_price }}</td>
                            <td>{{ $p->purchase_quantity * $p->unit_price }}</td>
                            @php
                                $total += $p->purchase_quantity * $p->unit_price;
                            @endphp
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
                  <p class="lead">Amount pay : {{ $item->created_at->diffForHumans() }}</p>

                  <div class="table-responsive">
                    <table class="table">


                      <tr>
                        <th>Total:</th>
                        <td> {{ $total }} Tk</td>
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
                  <button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                    Payment
                  </button>
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
