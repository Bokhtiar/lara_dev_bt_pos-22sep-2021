@extends('layouts.admin.app')
@section('title', 'Purchase Quantity Update List')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

@section('admin_content')
<section class="card">
    <x-purchase></x-purchase>
    <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Action</th>
            <th>Supplier Name</th>
            <th>Product Name</th>
            <th>Stock Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchase_products as $item)
            <tr>
            <td>
                <div class="btn-group">
                <button type="button" class=" btn-success btn ">Action</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu" role="menu">

                    <button type="button" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                        Product Update
                      </button>

                </div>

              </div>

            </td>

            <td>
                {{ $item->product ? $item->product->purchase->supplier->prefix_name .' '. $item->product->purchase->supplier->f_name .' '. $item->product->purchase->supplier->l_name : 'Data Deleted'  }}
            </td>
            <td>{{ $item->product ? $item->product->product_name : 'Data not found' }}</td>
            @if($item->product->fit)
            <td>{{ $item->purchase_quantity }} pc</td>
            @else
            <td>{{ $item->purchase_quantity }} {{ $item->product->unit->unit_short_name }} </td>
            @endif
            </tr>

                <!-- payment Modal -->
                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Purchase Product Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                           <span>Product Quantity is :  {{ $item->purchase_quantity }}</span>
                                <form action="{{ url('purchase/quantity/update',$item->id) }}" method="POST">
                                    @csrf
                                    <div class="form-gorup">
                                        <label for="">How Many Purchase Product</label>
                                    <input required type="number" name="product_update_quantity" class="form-control" placeholder="Product Quantity" id="">
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
            <th>Supplier Name</th>
            <th>Product Name</th>
            <th>Stock Quantity</th>
        </tr>
    </tfoot>
    </table>
    </div>
</section>
@endsection

@section('js')
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
