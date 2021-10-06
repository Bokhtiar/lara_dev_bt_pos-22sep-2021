@extends('layouts.admin.app')
@section('title', 'New Sub Admin Register')

@section('css')
@endsection

@section('admin_content')
<div class="container">
    <div class=" ">
        <div class="">
            <div class="card">
            <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF SUB-ADMIN</h3>
            <div class="card-tools">
                <div class="input-group form-inline input-group-sm" style="width: 100%;">
                    <p class="form-inline">
                        <a href="@route('subAdmin.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                            LIST OF SUB-ADMIN</a>
                        <a href="@route('subAdmin.create')" class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW SUB-ADMIN</a>
                    </p>
                </div>
            </div>
        </div>
                <div class="card-body">
                    <form method="POST" action="@route('subAdmin.store')">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="role"
                                class="col-md-4 col-form-label text-md-right">{{ __('Select Role') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role_id" id="">
                                    <option value="">--Selelct Role--</option>
                                    @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
