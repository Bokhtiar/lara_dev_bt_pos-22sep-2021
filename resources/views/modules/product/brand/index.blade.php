@extends('layouts.admin.app')

@section('title', 'Brand List')

@section('admin_content')
<section class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>CREATE NEW BRAND</h4>
                </div>
                <div class="card-body">
                    <form action="@route('brand.store')" class="form.group" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="brand-name" class="col-form-label">Brand Name: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="brand_name" placeholder=" type here brand name"
                                class="form-control" maxlength="30" minlength="2" id="brand_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="brand_description"
                                placeholder="type here brand description" id="message-text"></textarea>
                        </div>
                        <div class="mb-2">
                            <input class="btn btn-info" type="reset" name="" value="reset" id="">
                            <input class="btn btn-primary" type="submit" name="" value="Add New Brand" id="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-9 col-md-9">
            akdsjasd
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection
