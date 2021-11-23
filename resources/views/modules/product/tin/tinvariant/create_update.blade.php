@extends('layouts.admin.app')

@section('title', 'Tin Variant')
@section('css')
@endsection

@section('admin_content')
<section class="container card">
    <div class="card-header">
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF TIN VARIANT</h3>
        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    <a href="@route('tinvariant.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        LIST OF TIN VARIANTS</a>
                    <a href="@route('tinvariant.create')" class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW TIN VARIANT</a>
               </p>
            </div>
        </div>
    </div>
    <div class="">
        <div class="">

            <div class="card">
                <div class="card-header">
                    <h5><i class="text-secondary fas fa-box"></i> {{ @$edit ? 'UPDATE TIN VARIANT' : 'CREATE NEW TIN VARIANT' }} </h5>
                </div>
                <div class="card-body">
                    @if (isset($edit))
                    <form action="@route('tinvariant.update',$edit->id)" class="form.group" method="POST">
                        @method('put')
                    @else
                    <form action="@route('tinvariant.store')" class="form.group" method="POST">
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="fit-id" class="col-form-label">Select Fit: <span
                                    class="text-danger">*</span></label>
                           <select required name="fit_id" class="form-control" id="">
                               <option value="">Select Fit</option>
                               @foreach ($fits as $item)
                               <option value="{{ $item->id }}" {{ $item->id == @$edit->fit_id ? 'selected' : '' }}>{{ $item->fit_size }} Ft</option>
                               @endforeach
                           </select>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Tin M.M: <span
                                class="text-danger">*</span></label>
                                <input required type="number" class="form-control" name="mm"  id="" value="{{ @$edit->mm }}">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">TON: <span
                                class="text-danger">*</span></label>
                                <input required type="number" class="form-control" name="ton"  id="" value="{{ @$edit->ton }}">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Tin Piches: <span
                                class="text-danger">*</span></label>
                                <input required type="number" class="form-control" name="tinpc"  id="" value="{{ @$edit->tinpc }}">
                        </div>
                        <div class="mb-2">
                            <input class="btn btn-info" type="reset" name="" value="reset" id="">
                            @if (isset($edit))
                                <input class="btn btn-primary" type="submit" name="" value="Update Tin Variant" id="">
                            @else
                                <input class="btn btn-primary" type="submit" name="" value="Add New Tin Variant" id="">
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('js')
@endsection

