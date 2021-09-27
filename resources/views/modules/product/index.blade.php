@extends('layouts.admin.app')

@section('title', 'Product Create')
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
@endsection

@section('admin_content')
<x-product></x-product>
<div class="card-body">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Action</th>
                <th>Product Name </th>
                <th>Category</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <td>
                    <div class="btn-group">
                        <button type="button" class=" btn-success btn ">Action</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="@route('product.edit', $item->id)"><i
                                    class="btn btn-info btn-sm far fa-edit"></i></a>
                            <!-- Start Large modal -->
                            <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                            <i class="btn btn-sm btn-success fas fa-eye"></i>
                            </button>
                            <form action="@route('product.destroy',$item->id)" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item "><i
                                        class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                            </form>
                            
                        </div>
                    </div>

                </td>
                <td>{!! $item->product_name !!}</td>
                <td>{!! $item->category->category_name !!}</td>
                <td>
                    @if($item->status == 1)
                    <a class="" href="@route('product.status',$item->id)"><span class="badge badge-success"
                            title="if you click this button chenge the status">active</span></a>
                    @else
                    <a class="" href="@route('product.status',$item->id)"><span class="badge badge-danger"
                            title="if you click this button chenge the status">inactive</span></a>
                    @endif
                </td>
            </tr>
            {{-- start here modal --}}
            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $item->product_name }} Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                     <img src="{{asset('admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <div class="container card">
                                        <p class="h4">{{ $item->product_name }}</p>
                                        <p>Alert Quantity: {{ $item->alert_quantity }}</p>
                                        <p>Category : {{ $item->category->category_name }}</p>
                                        <p>SubCategory: {{ $item->subcategory->subcategory_name }}</p>
                                        <p>brand: {{ $item->brand->brand_name }}</p>
                                        <p>unit: {{ $item->unit_id }}</p>
                                        <p>warranty: {{ $item->warrant_id }}</p>
                                        <p>Description : {!! $item->product_description !!}</p>
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
                <th>Brand</th>
                <th>Description</th>
                <th>Status</th>
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
