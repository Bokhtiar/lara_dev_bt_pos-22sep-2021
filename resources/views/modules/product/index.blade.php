@extends('layouts.admin.app')

@section('title', 'Product List')
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
                <th>Product Image</th>
                <th>Product Name </th>
                <th>Category</th>
                <th>Sku Code</th>
                <th>Unit</th>
                <th>Unit Price</th>
                <th>Sell Price</th>
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
                            @isset(auth()->user()->role->permission['permission']['product']['edit'])
                            @if ($item->fit)
                            <a class="dropdown-item" href="@route('tin.edit', $item->id)"><i
                                class="btn btn-info btn-sm far fa-edit"></i></a>
                            @else
                            <a class="dropdown-item" href="@route('product.edit', $item->id)"><i
                                class="btn btn-info btn-sm far fa-edit"></i></a>
                            @endif


                            @endisset
                            @isset(auth()->user()->role->permission['permission']['product']['view'])
                            <a class="btn btn-primary dropdown-item" href="@route('product.show', $item->id)"><i class="btn btn-sm btn-success fas fa-eye"></i></a>
                            @endisset
                            @isset(auth()->user()->role->permission['permission']['product']['delete'])
                            <form action="@route('product.destroy',$item->id)" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item "><i
                                        class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                            </form>
                            @endisset
                        </div>
                    </div>

                </td>

                    @php
                    $image=json_decode($item->product_image);
                    @endphp

                        @if(empty($image))
                            <td>Image Not Selected</td>
                        @else
                            <td><img src="{{asset($image[0])}}" height="60px" width="60px" alt=""> </td>
                        @endif



                <td>{!! $item->product_name !!}</td>
                <td>{!! $item->category? $item->category->category_name : 'Data Not Available' !!}</td>
                <td>{!! $item->product_sku !!}</td>
                <td>{!! $item->unit ? $item->unit->unit_short_name : $item->tin_unit !!}</td>
                <td>
                    @if ($item->unit_price)
                    {!! $item->unit_price !!} Tk
                    @else
                    {!! $item->unit_total_price !!} Tk
                    @endif
                </td>
                <td>
                    @if ($item->unit_selling_price)
                    {!! $item->unit_selling_price !!} Tk
                    @else
                    {!! $item->unit_sell_total_price !!} Tk
                    @endif
                </td>
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

            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Action</th>
                <th>Product Image</th>
                <th>Product Name </th>
                <th>Category</th>
                <th>Sku Code</th>
                <th>Unit</th>
                <th>Unit Price</th>
                <th>Sell Price</th>
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
