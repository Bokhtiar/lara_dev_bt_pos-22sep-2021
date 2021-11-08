@extends('layouts.admin.app')

    @section('title', 'Dashboard')

    @section('admin_content')
    <div class="container">
        <form action="{{url('permission/update',$permission->id)}}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="role_id" class="form-control">
                            <option value="">Please select a role</option>
                            @foreach(\App\Models\Role::all() as $role)
                                <option value="{{$role->id}}"
                                        @if($role->id===$permission->role_id) selected @endif>{{$role->name}}</option>
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
                            <td>
                                <input type="checkbox" name="permission[role][add]"
                                       @isset($permission['permission']['role']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[role][edit]"
                                       @isset($permission['permission']['role']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[role][view]"
                                       @isset($permission['permission']['role']['view']) checked @endisset
                                       value="1">

                            </td>
                            <td>
                                <input type="checkbox" name="permission[role][delete]"
                                       @isset($permission['permission']['role']['delete']) checked @endisset
                                       value="1" >
                            </td>
                            <td>
                                <input type="checkbox" name="permission[role][list]"
                                       @isset($permission['permission']['role']['list']) checked @endisset
                                       value="1">
                            </td>

                        </tr>
                        <tr>
                            <td>Permissions</td>
                            <td>
                                <input type="checkbox" name="permission[permission][add]"
                                       @isset($permission['permission']['permission']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[permission][edit]" value="1"
                                       @isset($permission['permission']['permission']['edit']) checked @endisset
                                >
                            </td>
                            <td>
                                <input type="checkbox" name="permission[permission][view]" value="1"
                                       @isset($permission['permission']['permission']['view']) checked @endisset
                                ></td>
                            <td>
                                <input type="checkbox" name="permission[permission][delete]"
                                       @isset($permission['permission']['permission']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[permission][list]"
                                       @isset($permission['permission']['permission']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td>
                                <input type="checkbox" name="permission[user][add]"
                                       @isset($permission['permission']['user']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[user][edit]"
                                       @isset($permission['permission']['user']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[user][view]"
                                       @isset($permission['permission']['user']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[user][delete]"
                                       @isset($permission['permission']['user']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[user][list]"
                                       @isset($permission['permission']['user']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>


                        <tr>
                            <td>Category</td>
                            <td>
                                <input type="checkbox" name="permission[category][add]"
                                       @isset($permission['permission']['category']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[category][edit]"
                                       @isset($permission['permission']['category']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[category][view]"
                                       @isset($permission['permission']['category']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[category][delete]"
                                       @isset($permission['permission']['category']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[category][list]"
                                       @isset($permission['permission']['category']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>

                        <!-- category end -->

                        <tr>
                            <td>Sub-Category</td>
                            <td>
                                <input type="checkbox" name="permission[subcategory][add]"
                                       @isset($permission['permission']['subcategory']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[subcategory][edit]"
                                       @isset($permission['permission']['subcategory']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[subcategory][view]"
                                       @isset($permission['permission']['subcategory']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[subcategory][delete]"
                                       @isset($permission['permission']['subcategory']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[subcategory][list]"
                                       @isset($permission['permission']['subcategory']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--sub category end -->


                        <tr>
                            <td>Brand</td>
                            <td>
                                <input type="checkbox" name="permission[brand][add]"
                                       @isset($permission['permission']['brand']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[brand][edit]"
                                       @isset($permission['permission']['brand']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[brand][view]"
                                       @isset($permission['permission']['brand']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[brand][delete]"
                                       @isset($permission['permission']['brand']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[brand][list]"
                                       @isset($permission['permission']['brand']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--brand -->

                        <tr>
                            <td>Unit</td>
                            <td>
                                <input type="checkbox" name="permission[unit][add]"
                                       @isset($permission['permission']['unit']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[unit][edit]"
                                       @isset($permission['permission']['unit']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[unit][view]"
                                       @isset($permission['permission']['unit']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[unit][delete]"
                                       @isset($permission['permission']['unit']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[unit][list]"
                                       @isset($permission['permission']['unit']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--unit end -->
                        <tr>
                            <td>Warranty</td>
                            <td>
                                <input type="checkbox" name="permission[warranty][add]"
                                       @isset($permission['permission']['warranty']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[warranty][edit]"
                                       @isset($permission['permission']['warranty']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[warranty][view]"
                                       @isset($permission['permission']['warranty']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[warranty][delete]"
                                       @isset($permission['permission']['warranty']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[warranty][list]"
                                       @isset($permission['permission']['warranty']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--warranty end -->

                        <tr>
                            <td>Product</td>
                            <td>
                                <input type="checkbox" name="permission[product][add]"
                                       @isset($permission['permission']['product']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[product][edit]"
                                       @isset($permission['permission']['product']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[product][view]"
                                       @isset($permission['permission']['product']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[product][delete]"
                                       @isset($permission['permission']['product']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[product][list]"
                                       @isset($permission['permission']['product']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--product end -->

                        <tr>
                            <td>Customer</td>
                            <td>
                                <input type="checkbox" name="permission[customer][add]"
                                       @isset($permission['permission']['customer']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[customer][edit]"
                                       @isset($permission['permission']['customer']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[customer][view]"
                                       @isset($permission['permission']['customer']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[customer][delete]"
                                       @isset($permission['permission']['customer']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[customer][list]"
                                       @isset($permission['permission']['customer']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--customer end -->


                        <tr>
                            <td>Supplier</td>
                            <td>
                                <input type="checkbox" name="permission[supplier][add]"
                                       @isset($permission['permission']['supplier']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[supplier][edit]"
                                       @isset($permission['permission']['supplier']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[supplier][view]"
                                       @isset($permission['permission']['supplier']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[supplier][delete]"
                                       @isset($permission['permission']['supplier']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[supplier][list]"
                                       @isset($permission['permission']['supplier']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--supplier end -->
                        <tr>
                            <td>Purchase</td>
                            <td>
                                <input type="checkbox" name="permission[purchase][add]"
                                       @isset($permission['permission']['purchase']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[purchase][edit]"
                                       @isset($permission['permission']['purchase']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[purchase][view]"
                                       @isset($permission['permission']['purchase']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[purchase][delete]"
                                       @isset($permission['permission']['purchase']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[purchase][list]"
                                       @isset($permission['permission']['purchase']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--purchase end -->


                        <tr>
                            <td>Sell</td>
                            <td>
                                <input type="checkbox" name="permission[sell][add]"
                                       @isset($permission['permission']['sell']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[sell][edit]"
                                       @isset($permission['permission']['sell']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[sell][view]"
                                       @isset($permission['permission']['sell']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[sell][delete]"
                                       @isset($permission['permission']['sell']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[sell][list]"
                                       @isset($permission['permission']['sell']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--sell end -->

                        <tr>
                            <td>POS</td>
                            <td>
                                <input type="checkbox" name="permission[pos][add]"
                                       @isset($permission['permission']['pos']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[pos][edit]"
                                       @isset($permission['permission']['pos']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[pos][view]"
                                       @isset($permission['permission']['pos']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[pos][delete]"
                                       @isset($permission['permission']['pos']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[pos][list]"
                                       @isset($permission['permission']['pos']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--pos end -->

                        <tr>
                            <td>Order</td>
                            <td>
                                <input type="checkbox" name="permission[order][add]"
                                       @isset($permission['permission']['order']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[order][edit]"
                                       @isset($permission['permission']['order']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[order][view]"
                                       @isset($permission['permission']['order']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[order][delete]"
                                       @isset($permission['permission']['order']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[order][list]"
                                       @isset($permission['permission']['order']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--order end -->

                        <tr>
                            <td>Report</td>
                            <td>
                                <input type="checkbox" name="permission[report][add]"
                                       @isset($permission['permission']['report']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[report][edit]"
                                       @isset($permission['permission']['report']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[report][view]"
                                       @isset($permission['permission']['report']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[report][delete]"
                                       @isset($permission['permission']['report']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[report][list]"
                                       @isset($permission['permission']['report']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--report end -->

                        <tr>
                            <td>Setting</td>
                            <td>
                                <input type="checkbox" name="permission[setting][add]"
                                       @isset($permission['permission']['setting']['add']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[setting][edit]"
                                       @isset($permission['permission']['setting']['edit']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[setting][view]"
                                       @isset($permission['permission']['setting']['view']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[setting][delete]"
                                       @isset($permission['permission']['setting']['delete']) checked @endisset
                                       value="1">
                            </td>
                            <td>
                                <input type="checkbox" name="permission[setting][list]"
                                       @isset($permission['permission']['setting']['list']) checked @endisset
                                       value="1">
                            </td>
                        </tr>
                        <!--Setting end -->


                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @section('js')
    @endsection
