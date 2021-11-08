@extends('layouts.admin.app')
@section('title', 'List Of Contact')

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
                <th>Contact Info</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $item)
                <tr>
                <td>
                    <div class="btn-group">
                    <button type="button" class=" btn-success btn ">Action</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu" role="menu">
                        @if($item->contact_info == 'Customer')
                        @isset(auth()->user()->role->permission['permission']['customer']['view'])
                         <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                            <i class="btn btn-sm btn-success fas fa-eye"></i>
                            </button>
                        @endisset
                         @isset(auth()->user()->role->permission['permission']['customer']['edit'])
                        <a class="dropdown-item" href="@route('contact.edit', $item->id)"><i
                                class="btn btn-info btn-sm far fa-edit"></i></a>
                        @endisset
                         @isset(auth()->user()->role->permission['permission']['customer']['delete'])
                            <form action="@route('contact.destroy',$item->id)" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item "><i class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                            </form>
                        @endisset
                    @else
                        @isset(auth()->user()->role->permission['permission']['supplier']['view'])
                         <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                            <i class="btn btn-sm btn-success fas fa-eye"></i>
                            </button>
                        @endisset
                         @isset(auth()->user()->role->permission['permission']['supplier']['edit'])
                        <a class="dropdown-item" href="@route('contact.edit', $item->id)"><i
                                class="btn btn-info btn-sm far fa-edit"></i></a>
                        @endisset
                         @isset(auth()->user()->role->permission['permission']['supplier']['delete'])
                            <form action="@route('contact.destroy',$item->id)" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item "><i class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                            </form>
                        @endisset
                    @endif
                    
                    </div>
                  </div>

                </td>
                <td>{{ $item->contact_info }}</td>
                <td>{{ $item->prefix_name .' '. $item->f_name .' '. $item->l_name }}</td>
                <td>{{ $item->phone }}</td>
                <td>
                    @if($item->status == 1)
                        <a class="" href="@route('contact.status',$item->id)"><span class="badge badge-success" title="if you click this button chenge the status">active</span></a>
                        @else
                        <a class="" href="@route('contact.status',$item->id)" ><span class="badge badge-danger" title="if you click this button chenge the status">inactive</span></a>
                    @endif

                </td>
                </tr>

                {{-- start here modal --}}
            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $item->prefix .' '. $item->f_name .' '. $item->last_name }} Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section>
                            <div class="row justify-content-center">
                                <div class=" col-md-8">
                                    <div class="container card">
                                        <p class="h4">{{ $item->prefix .' '. $item->f_name .' '. $item->last_name }}</p>
                                        <p>E-mail: {{ $item->email }}</p>
                                        <p>Location : {{ $item->city .' '. $item->state .' '. $item->country .' '. $item->zip }}</p>
                                        @if (isset($item->company_name))
                                        <p>Compnay Name: {{ $item->company_name }}</p>
                                        <p>Company Phone: {{ $item->company_phone }}</p>
                                        <p>Company Email: {{ $item->company_email }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i>Close</button>
                </div>
                </div>
            </div>
            </div>
            {{-- end of modal --}}
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Action</th>
                <th>Contact Info</th>
                <th>Name</th>
                <th>Phone</th>
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
