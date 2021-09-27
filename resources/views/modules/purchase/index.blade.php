    @extends('layouts.admin.app')
    @section('title', 'Purchase List')
    @section('css')
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
    @endsection
