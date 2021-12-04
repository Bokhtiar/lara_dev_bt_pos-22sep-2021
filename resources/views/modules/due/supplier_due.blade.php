@extends('layouts.admin.app')
@section('title', 'Supplier Due')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

@section('admin_content')
<section class="card">
    <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Action</th>
            <th>Product</th>
            <th>Sup Name</th>
            <th>Sup Phone</th>
            <th>Total Amount Tk</th>
            <th>Paid Amount Tk</th>
            <th>Due Amount Tk</th>
            <th>Due Paid On Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $item)
            @if($item->total_amount != $item->paid_amount)
            <tr>
                <td>
                    <div class="btn-group">
                    <button type="button" class=" btn-success btn ">Action</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu" role="menu">
                        @if($item->paid_amount == $item->total_amount)
                        <span class="dropdown-item">no Due</span>
                        @else
                        <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                            Due Payment
                          </button>
                        @endif
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
                        <a href="@route('product.show', $p->product_id)">{{ $p->product ? $p->product->product_name : '' }}</a> |
                    @endforeach
                </td>
                <td>{{$item->supplier ? $item->supplier->prefix_name .' '. $item->supplier->f_name .' '. $item->supplier->l_name : 'Data Deleted' }}</td>
                <td>{{$item->supplier ? $item->supplier->phone : 'Data Deleted' }}</td>
                <td>{{ $item->total_amount }} </td>
                <td>{{ $item->paid_amount }} </td>
                <td>{{ $item->total_amount - $item->paid_amount }}</td>
                <td>{{ $item->due_paid_date }}</td>
                </tr>
            @endif
                <!-- payment Modal -->
                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Due Pay</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                           <span>Due Amount is :  {{ $item->total_amount - $item->paid_amount }}</span>
                                <form action="{{ url('purchase/due/pay/',$item->id) }}" method="POST">
                                    @csrf
                                    <div class="form-gorup">
                                        <label for="">How Many pay amount</label>
                                    <input required type="number" name="paid_amount" class="form-control" placeholder="pay amount" id="">
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
            <th>Product</th>
            <th>Sup Name</th>
            <th>Sup Phone</th>
            <th>Total Amount Tk</th>
            <th>Paid Amount Tk</th>
            <th>Due Amount Tk</th>
            <th>Due Paid On Date</th>
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
