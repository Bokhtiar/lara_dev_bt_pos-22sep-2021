@extends('layouts.admin.app')

    @section('title', 'Dashboard')

    @section('admin_content')
    <div class="container">
        <form action="{{url('permission/store')}}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select name="role_id" class="form-control">
                        <option value="">Please select a role</option>
                        @foreach(\App\Models\Role::all() as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="text-danger">
                              {{$message}}
                          </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-md-8">
                <table class="responsive-table-input-matrix">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Add</th>
                        <th>Edit</th>
                        <th>View</th>
                        <th>Delete</th>
                        <th>List</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>Roles</td>
                        <td><input type="checkbox" name="permission[role][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[role][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[role][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[role][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[role][list]" value="1"></td>

                    </tr>
                    <tr>
                        <td>Permissions</td>
                        <td><input type="checkbox" name="permission[permission][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[permission][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[permission][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[permission][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[permission][list]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[user][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[user][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[user][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[user][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[user][list]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td><input type="checkbox" name="permission[category][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[category][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[category][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[category][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[category][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Sub-Category</td>
                        <td><input type="checkbox" name="permission[subcategory][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[subcategory][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[subcategory][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[subcategory][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[subcategory][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Brand</td>
                        <td><input type="checkbox" name="permission[brand][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[brand][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[brand][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[brand][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[brand][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Unit</td>
                        <td><input type="checkbox" name="permission[unit][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[unit][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[unit][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[unit][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[unit][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Warranty</td>
                        <td><input type="checkbox" name="permission[warranty][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[warranty][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[warranty][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[warranty][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[warranty][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Product</td>
                        <td><input type="checkbox" name="permission[product][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[product][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[product][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[product][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[product][list]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Customer</td>
                        <td><input type="checkbox" name="permission[customer][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[customer][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[customer][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[customer][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[customer][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Supplier</td>
                        <td><input type="checkbox" name="permission[supplier][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[supplier][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[supplier][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[supplier][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[supplier][list]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Purchase</td>
                        <td><input type="checkbox" name="permission[purchase][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[purchase][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[purchase][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[purchase][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[purchase][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Sell</td>
                        <td><input type="checkbox" name="permission[sell][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[Sell][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[Sell][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[Sell][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[Sell][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>POS</td>
                        <td><input type="checkbox" name="permission[pos][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[pos][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[pos][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[pos][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[pos][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Order</td>
                        <td><input type="checkbox" name="permission[order][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[order][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[order][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[order][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[order][list]" value="1"></td>
                    </tr>

                    <tr>
                        <td>Report</td>
                        <td><input type="checkbox" name="permission[report][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[report][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[report][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[report][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[report][list]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Setting</td>
                        <td><input type="checkbox" name="permission[setting][add]" value="1"></td>
                        <td><input type="checkbox" name="permission[setting][edit]" value="1"></td>
                        <td><input type="checkbox" name="permission[setting][view]" value="1"></td>
                        <td><input type="checkbox" name="permission[setting][delete]" value="1"></td>
                        <td><input type="checkbox" name="permission[setting][list]" value="1"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
    </div>
@endsection

