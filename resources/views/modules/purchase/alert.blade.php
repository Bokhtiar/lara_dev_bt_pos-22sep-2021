@extends('layouts.admin.app')

@section('title', 'Product Create')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

@section('admin_content')
<x-alert_quantity></x-alert_quantity>
<div class="card-body">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Action</th>
                <th>Product Name </th>
                <th>Stock Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            @if($item->product->alert_quantity > $item->purchase_quantity)
            <tr>
                <td>
                    <div class="btn-group">
                        <button type="button" class=" btn-success btn ">Action</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu" role="menu">
                        </div>
                    </div>

                </td>
                <td>{!! $item->product ? $item->product->product_name : 'data not found' !!}</td>
                @if($item->product->fit == null)
                <td>{!! $item->purchase_quantity	 !!} {{ $item->product ? $item->product->unit->unit_short_name : 'Data not found' }}</td>
                @else
                <td>{!! $item->purchase_quantity	 !!}pc</td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Action</th>
                <th>Product Name </th>
                <th>Stock Quantity</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
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
