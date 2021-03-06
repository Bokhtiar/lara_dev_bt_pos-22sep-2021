@extends('layouts.admin.app')
@section('title', 'List Of Tin varinats')

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
    <div class="card-header">
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF TIN VARIANTS</h3>

        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    <a href="@route('tinvariant.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        List Of Tin Variant</a>
                        <a href="@route('tinvariant.create')" class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW TIN VARIANT</a>
                </p>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Fit</th>
                    <th>M.M </th>
                    <th>Ton</th>
                    <th>Tin Pc</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tinvariants as $item)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class=" btn-success btn ">Action</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            </button>



                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="@route('tinvariant.edit', $item->id)"><i class="btn btn-info btn-sm far fa-edit"></i></a>
                                <form action="@route('tinvariant.destroy',$item->id)" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item "><i
                                            class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>

                    </td>
                    <td>{{ $item->fit ? $item->fit->fit_size :'data not found' }}ft</td>
                    <td>{{ $item->mm }}mm</td>
                    <td>{{ $item->ton }}ton</td>
                    <td>{{ $item->tinpc }}pc</td>
                </tr>

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Action</th>
                    <th>Fit</th>
                    <th>M.M </th>
                    <th>Ton</th>
                    <th>Tin Pc</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<script src="{{ asset('admin') }}/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
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
