    @extends('layouts.admin.app')
    @section('title', 'Purchase List')
    @section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.jqueryui.min.css">
    @endsection

    @section('admin_content')
    <section class="card">
        <x-purchase></x-purchase>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Action</th>
                <th>Product</th>
                <th>Supplier</th>
                <th>Amount</th>
                <th>Due Amount</th>
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
                         <a class="dropdown-item" href="@route('purchase.edit', $item->id)"><i
                                    class="btn btn-info btn-sm far fa-edit"></i></a>
                        <a href="@route('purchase.show',$item->id)" class="dropdown-item"> <i class="btn btn-sm btn-success fas fa-eye"></i></a>
                        <form action="@route('purchase.destroy',$item->id)" method="POST">
                            @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item "><i class="btn btn-sm btn-danger fas fa-trash-alt"></i></button>
                        </form>
                    </div>

                  </div>

                </td>
                <td>{{ $item->product->product_name }}</td>
                <td>{{ $item->supplier->prefix_name .' '. $item->supplier->f_name .' '. $item->supplier->l_name }}</td>
                <td>{{ $item->line_total }}</td>
                <td>{{ $item->line_total - $item->amount }}</td> <!--amount is how many send supplier amount-->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Action</th>
                <th>Product</th>
                <th>Supplier</th>
                <th>Total Amount</th>
                <th>Due Amount</th>
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
