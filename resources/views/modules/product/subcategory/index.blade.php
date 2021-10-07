@extends('layouts.admin.app')
@section('title', 'List Of Sub-Category')

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
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF SUB-CATEGORIES</h3>

        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    <a href="@route('subcategory.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        List Of Sub-Categories</a>
                    @isset(auth()->user()->role->permission['permission']['subcategory']['add'])
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo"><i class="fas fa-plus"></i> Add Sub-Category</button>
                    @endisset
                </p>
            </div>

            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> <span>+</span> NEW SUB-CATEGORY CREATE </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="@route('subcategory.store')" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="subcategory-name" class="col-form-label">Sub-Category Name: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="subcategory_name" placeholder=" type here subcategory name"
                                        class="form-control" maxlength="30" minlength="2" id="subcategory-name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="category-id" class="col-form-label">Select Category: <span
                                            class="text-danger">*</span></label>
                                        <select class="form-control select2" name="category_id" id="">
                                            @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea class="form-control" name="subcategory_description"
                                        placeholder="type here category description" id="message-text"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                        class="far fa-times-circle"></i> Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-share-square"></i> Create
                                    New Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>SubCategory</th>
                    <th>Category </th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $item)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class=" btn-success btn ">Action</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu" role="menu">
                                @isset(auth()->user()->role->permission['permission']['subcategory']['edit'])
                                <button class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $item->id }}">
                                    <i class="btn btn-info btn-sm far fa-edit"></i>
                                </button>
                                @endisset
                                @isset(auth()->user()->role->permission['permission']['subcategory']['delete'])
                                <form action="@route('subcategory.destroy',$item->id)" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item "><i
                                            class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                                </form>
                                @endisset
                            </div>
                        </div>

                    </td>
                    <td>{{ $item->subcategory_name }}</td>
                    <td>{{ $item->category ? $item->category->category_name : 'Data Not Available' }}</td>
                    <td>{{ $item->subcategory_description }}</td>
                    <td>
                        @if($item->status == 1)
                        <a class="" href="@route('subcategory.status',$item->id)"><span class="badge badge-success"
                                title="if you click this button chenge the status">active</span></a>
                        @else
                        <a class="" href="@route('subcategory.status',$item->id)"><span class="badge badge-danger"
                                title="if you click this button chenge the status">inactive</span></a>
                        @endif

                    </td>
                </tr>

                {{-- modal start here --}}
                <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">CATEGORY EDIT FORM </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="@route('subcategory.update',$item->id)" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="category-name" class="col-form-label">Sub-Category Name: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" value="{{ $item->subcategory_name }}" name="subcategory_name"
                                            placeholder=" type here sub-category name" class="form-control"
                                            maxlength="30" minlength="2" id="category-name" required>
                                    </div>
                                    <div class="mb-3">
                                    <label for="category-id" class="col-form-label">Select Category: <span
                                            class="text-danger">*</span></label>
                                        <select class="form-control select2" name="category_id" id="">
                                            @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == @$item->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Description:</label>
                                        <textarea class="form-control" name="subcategory_description"
                                            placeholder="type here description"
                                            id="message-text">{{ $item->subcategory_description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                            class="far fa-times-circle"></i> Close</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-share-square"></i>
                                        Sub-Category Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- modal end here --}}
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Action</th>
                    <th>SubCategory</th>
                    <th>Category </th>
                    <th>Description</th>
                    <th>Status</th>
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
