@extends('layouts.admin.app')
@section('title', 'Date Ranges Report')

@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

    @section('admin_content')



    <section class="card">

        <div class="card-header text-center">
            <p class="card-title text-center">---------------------Search Date Range----------------------</p>
            <div class="float-right">
                <form class="form-inline" action="@route('date.range.search')" method="POST">
                    @csrf
                    <input type="date" class="form-control" name="start_date" id="">
                    <input type="date" class="form-control" name="end_date" id="">
                    <input type="submit" class="btn btn-success" value="Submit" id="">
            </form>
            </div>

        </div>


        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Action</th>
                <th>Customer Name</th>
                <th>Ordet Date</th>
                <th>Total Amount</th>
                <th>Pay Payment</th>
                <th>Due Amount</th>
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
                        <a class="dropdown-item" href="@route('sell.show', $item->id)"><i class="btn btn-sm btn-success fas fa-eye"></i></a>

                    </div>
                  </div>

                </td>
                <td>{{$item->customer ? $item->customer->prefix_name .' '. $item->customer->f_name .' '. $item->customer->l_name : '' }}</td>
                <td>{{ $item->created_at->diffForHumans() }}</td>
                <td>{{ $item->total_amount }} TK</td>
                <td>{{ $item->pay_amount }} TK</td>
                <td>{{ $item->total_amount - $item->pay_amount }}Tk</td>
                <td>
                    @if($item->status == 1)
                        <a class="" href="@route('sell.status',$item->id)"><span class="badge badge-success" title="if you click this button chenge the status">successfully</span></a>
                        @else
                        <a class="" href="@route('sell.status',$item->id)" ><span class="badge badge-danger" title="if you click this button chenge the status">pending</span></a>
                    @endif
                </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Action</th>
                <th>Customer Name</th>
                <th>Ordet Date</th>
                <th>Total Amount</th>
                <th>Pay Payment</th>
                <th>Due Amount</th>
                <th>Status</th>
            </tr>
        </tfoot>
        </table>
    </div>
    </section>
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
