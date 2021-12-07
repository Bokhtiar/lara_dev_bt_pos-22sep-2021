@extends('layouts.admin.app')

    @section('title', 'Dashboard')

    @section('admin_content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @isset(auth()->user()->role->permission['permission']['permission']['add'])
                <a class="btn btn-success text-light" href="{{url('permission/create')}}">Create Permission </a>
                @endisset
                <h2 class="text-center">Permissions</h2>
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Name</th>
                        <th scope="col">Time</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$permission->role->name}}</td>
                                <td>{{$permission->created_at->diffForHumans()}}</td>
                                <td>
                                    @isset(auth()->user()->role->permission['permission']['permission']['edit'])
                                    <a class="btn btn-info" href="{{url('permission/edit/'.$permission->id)}}">Edit</a>
                                    @endisset
                                    @isset(auth()->user()->role->permission['permission']['permission']['delete'])
                                    <a class="btn btn-danger" href="">Delete</a>
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endsection

    @section('js')
    @endsection
