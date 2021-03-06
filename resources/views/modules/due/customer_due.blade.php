@extends('layouts.admin.app')
@section('title', 'List Of Due Customer')

@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
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

    <section class="card">
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Action</th>
                <th>Cus Name</th>
                <th>Cust Phone</th>
                <th>Paid Amount Tk</th>
                <th>Total Amount Tk</th>
                <th>Due Amonut Tk</th>
                <th>Due Paid Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $item)
            @if ($item->total_amount != $item->paid_amount)
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
                        @isset(auth()->user()->role->permission['permission']['sell']['view'])
                        <a class="dropdown-item" href="@route('sell.show', $item->id)"><i class="btn btn-sm btn-success fas fa-eye"></i></a>
                        @endisset
                        @isset(auth()->user()->role->permission['permission']['sell']['delete'])
                        <form action="@route('sell.destroy',$item->id)" method="POST">
                            @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item "><i class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                        </form>
                        @endisset
                    </div>
                  </div>

                </td>
                <td>{{$item->customer ? $item->customer->prefix_name .' '. $item->customer->f_name .' '. $item->customer->l_name : 'Data Deleted' }}</td>
                <td>{{$item->customer ? $item->customer->phone : 'Data Deleted' }}</td>
                <td>{{ $item->paid_amount }}</td>
                <td>{{ $item->total_amount }}</td>
                <td>{{ $item->total_amount - $item->paid_amount }}</td>
                <td>{{ $item->due_paid_date }}</td>
                <td>
                    @if($item->status == 1)
                        <a class="" href="@route('sell.status',$item->id)"><span class="badge badge-success" title="if you click this button chenge the status">successfully</span></a>
                        @else
                        <a class="" href="@route('sell.status',$item->id)" ><span class="badge badge-danger" title="if you click this button chenge the status">pending</span></a>
                    @endif
                </td>
                </tr>

            @endif

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
                               <span>Due Amount is :  {{ $item->total_amount - $item->paid_amount }}</span>
                                    <form action="@route('sell.update', $item->id)" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="form-gorup">
                                            <label for="">How Many pay amount</label>
                                        <input type="number" name="paid_amount" class="form-control" placeholder="pay amount" id="">
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
                <th>Cus Name</th>
                <th>Cust Phone</th>
                <th>Paid Amount Tk</th>
                <th>Total Amount Tk</th>
                <th>Due Amonut Tk</th>
                <th>Due Paid Date</th>
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
