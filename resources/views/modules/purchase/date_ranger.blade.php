@extends('layouts.admin.app')
@section('title', 'Purchase Date Ranger List')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

@section('admin_content')
<section class="card">
    <x-purchase></x-purchase>
    <div class="card-header text-center">
        <p class="card-title text-center">---------------------Search Date Range----------------------</p>
        <div class="float-right">
            <form class="form-inline" action="@route('purchase.date.range.search')" method="POST">
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
            <th>Product</th>
            <th>Supplier</th>
            <th>Total Amount Tk</th>
            <th>Paid Amount Tk</th>
            <th>Due Amount Tk</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchases as $item)
            <tr>
            <td>
                <div class="btn-group">
                <button type="button" class=" btn-success btn ">Action</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu" role="menu">
                    @isset(auth()->user()->role->permission['permission']['purchase']['edit'])
                     <a class="dropdown-item" href="@route('purchase.edit', $item->id)"><i
                                class="btn btn-info btn-sm far fa-edit"></i></a>
                    @endisset
                    @isset(auth()->user()->role->permission['permission']['purchase']['view'])
                    <a href="@route('purchase.show',$item->id)" class="dropdown-item"> <i class="btn btn-sm btn-success fas fa-eye"></i></a>
                    @endisset
                    @isset(auth()->user()->role->permission['permission']['purchase']['delete'])
                    <form action="@route('purchase.destroy',$item->id)" method="POST">
                        @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item "><i class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                    </form>
                    @endisset
                </div>

              </div>

            </td>

            <td>
                @foreach (App\Models\PurchaseProduct::query()->Product_name($item->id) as $p)
                    <a href="@route('product.show', $p->product_id)">{{ $p->product ? $p->product->product_name : 'data not found' }}</a> |
                @endforeach
            </td>
            <td>noyon</td>
            <td>{{ $item->total_amount }}</td>
            <td>{{ $item->paid_amount }}</td>
            <td>{{ $item->total_amount - $item->paid_amount }}</td>
            </tr>



        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Action</th>
            <th>Product</th>
            <th>Supplier</th>
            <th>Total Amount Tk</th>
            <th>Paid Amount Tk</th>
            <th>Due Amount Tk</th>
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
