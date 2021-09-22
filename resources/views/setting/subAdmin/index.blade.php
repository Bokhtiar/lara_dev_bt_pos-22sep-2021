@extends('layouts.admin.app')
@section('title', 'Dashboard')

    @section('admin_content')
        <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center"><span class="h3">List Of All Users</span></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-condensed text-center">
                @if(!empty($admins))
                  <tr>
                    <th style="width: 10px">Actions</th>
                    <th>Name</th>
                    <th>E-mail</th>
                  </tr>
                @endif
                  @forelse ($admins as $item)
                    <tr>
                    <td>
                        <a id="delete" href="@route('subAdmin.delete', $item->id)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>
                      {{ $item->email }}
                    </td>
                  </tr>
                  @empty
                  <p class="text-center">User Not Found</p>
                  @endforelse

                </table>
                <div>
                    @php
                        echo $admins->links();
                    @endphp
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    @endsection

@section('js')
@endsection
