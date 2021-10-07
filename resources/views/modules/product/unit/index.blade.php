@extends('layouts.admin.app')

@section('title', 'Brand List')
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
<section class="container card">
    <div class="card-header">
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF UNIT</h3>
        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    @isset(auth()->user()->role->permission['permission']['unit']['list'])
                    <a href="@route('unit.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        LIST OF UNIT</a>
                    @endisset
                    @isset(auth()->user()->role->permission['permission']['unit']['add'])
                    <a href="@route('unit.index')" class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW UNIT</a>
                    @endisset
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-3 col-md-3">
            @isset(auth()->user()->role->permission['permission']['unit']['add'])
            <div class="card">
                <div class="card-header">
                    <h5><i class="text-secondary fas fa-box"></i> {{ @$edit ? 'UPDATE UNIT' : 'CREATE NEW UNIT' }} </h5>
                </div>
                <div class="card-body">
                    @if (isset($edit))
                    <form action="@route('unit.update',$edit->id)" class="form.group" method="POST">
                        @method('put')
                    @else
                    <form action="@route('unit.store')" class="form.group" method="POST">
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="unit-name" class="col-form-label">Unit Name: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="unit_name" placeholder=" type here unit name"
                                class="form-control" value="{{ @$edit->unit_name }}" maxlength="30" minlength="2" id="brand_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit-short-name" class="col-form-label">Unit Short Name: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="unit_short_name" placeholder=" type here unit short name"
                                class="form-control" value="{{ @$edit->unit_short_name }}" maxlength="30" minlength="2" id="brand_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="unit_description"
                                placeholder="type here brand description" id="message-text">{{ @$edit->unit_description }}</textarea>
                        </div>
                        <div class="mb-2">
                            <input class="btn btn-info" type="reset" name="" value="reset" id="">
                            @if (isset($edit))
                                <input class="btn btn-primary" type="submit" name="" value="Update Unit" id="">
                            @else
                                <input class="btn btn-primary" type="submit" name="" value="Add New Unit" id="">
                            @endif

                        </div>
                    </form>
                </div>
            </div>
            @endisset
        </div>
        <div class="col-sm-12 col-lg-9 col-md-9">
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Unit Name</th>
                    <th>Unit Short Name </th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $item)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class=" btn-success btn ">Action</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu" role="menu">
                                @isset(auth()->user()->role->permission['permission']['unit']['edit'])
                                <a class="dropdown-item" href="@route('unit.edit', $item->id)"><i class="btn btn-info btn-sm far fa-edit"></i></a>
                                @endisset
                                @isset(auth()->user()->role->permission['permission']['unit']['delete'])
                                <form action="@route('unit.destroy',$item->id)" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item "><i
                                        class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                                </form>
                                @endisset
                            </div>
                        </div>

                    </td>
                    <td>{!! $item->unit_name !!}</td>
                    <td>{!! $item->unit_short_name !!}</td>
                    <td>{!! $item->unit_description !!}</td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Action</th>
                    <th>Unit Name</th>
                    <th>Unit Short Name </th>
                    <th>Description</th>
                </tr>
            </tfoot>
        </table>
    </div>
        </div>
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

