    @extends('layouts.admin.app')
    @section('title', 'Contact Create')
    @section('css')
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

                    <div class="card-body">
                        @if(isset($edit))
                        <form action="@route('contact.update', $edit->id)" class="form-group" method="POST">
                            @method('PUT')
                            @else
                            <form action="@route('contact.store')" class="form-group" method="POST">
                        @endif
                            @csrf
                            <input type="hidden" name="" value="{{ $type }}" id="supplier">
                            <div class="form-gorup mb-3">
                                <label for="">Select Contact <span class="text-danger">*</span> </label>
                                <select class="form-control" name="contact_info" id="contact_info">
                                    <option value="">Select Contact</option>
                                    <option value="Customer" {{ @$edit->contact_info == 'Customer' ? 'selected' : '' }} {{ $type == 'customer' ? 'selected' : '' }}>Customer</option>
                                    <option value="Supplier" {{ @$edit->contact_info == 'Supplier' ? 'selected' : '' }} {{ $type == 'supplier' ? 'selected' : '' }} >Supplier</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group mb-3">
                                    <label for="">Prefix <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="mr/ms" value="{{ @$edit->prefix_name }}" name="prefix_name" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group mb-3">
                                    <label for="">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="first name" value="{{ @$edit->f_name }}" name="f_name" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group mb-3">
                                    <label for="">Last Name <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" placeholder="last name" value="{{ @$edit->l_name }}" name="l_name" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-3">
                                    <label for="">E-mail</label>
                                    <input type="email" class="form-control" placeholder="email" name="email" value="{{ @$edit->email }}" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-3">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="phone" class="form-control" placeholder="phone" name="phone" value="{{ @$edit->phone }}" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" placeholder="city" name="city" value="{{ @$edit->city }}" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" placeholder="state" name="state" value="{{ @$edit->state }}" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" placeholder="country" name="country" value="{{ @$edit->country }}" id="">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group mb-3">
                                    <label for="">Zip Code</label>
                                    <input type="text" class="form-control" placeholder="Zip Code" value="{{ @$edit->zip }}" name="zip" id="">
                                    </div>
                                </div>
                            </div>
                            <div id="supplier_info" style="display: none">
                                <span class="h4">please More Information:</span>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-3">
                                        <label for="">Company Name</label>
                                        <input type="text" class="form-control" placeholder="company name" value="{{ @$edit->compnay_name }}" name="company_name" id="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-3">
                                        <label for="">Company Phone</label>
                                        <input type="number" class="form-control" placeholder="company phone" value="{{ @$edit->company_phone }}" name="company_phone" id="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-3">
                                        <label for="">Company E-mail</label>
                                        <input type="email" class="form-control" placeholder="company email" value="{{ @$edit->compnay_email }}" name="company_email" id="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="float-right">
                                <span class="btn-sm btn btn-danger"><i class="far fa-times-circle"></i><input class="btn-sm btn btn-danger"  type="reset" name="" id=""></span>
                                @if (isset($edit))
                                    <span class="btn-sm btn btn-primary"><i class="fas fa-share-square"></i><input class="btn-sm btn btn-primary" type="submit" name="" value="Update Contact" id=""></span>
                                    @else
                                    <span class="btn-sm btn btn-primary"><i class="fas fa-share-square"></i><input class="btn-sm btn btn-primary" type="submit" name="" value="Add New Contact" id=""></span>
                                    @endif

                            </div>
                        </form>
                    </div>
            </section>
        @endsection

    @section('js')
    <script>
        $(document).ready(function(){


                var contact = $("#supplier").val();
                console.log(contact);
                if(contact == 'supplier'){
                    $('#supplier_info').toggle(3000);
                }


        })
    </script>
    @endsection
