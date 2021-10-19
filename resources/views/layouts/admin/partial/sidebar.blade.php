<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('/images/icon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">
        Inventory(POS)
    </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li><!--dasboard end -->
          @isset(auth()->user()->role->permission['permission']['pos']['list'])
          <li class="nav-item">
            <a href="{{url('/pos')}}" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
              <p>
                POS
              </p>
            </a>
          </li><!--pos end -->
          @endisset

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Products
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @isset(auth()->user()->role->permission['permission']['product']['add'])
              <li class="nav-item">
                <a href="@route('product.create')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Product Create</p>
                </a>
              </li>
            @endisset
            @isset(auth()->user()->role->permission['permission']['product']['list'])
              <li class="nav-item">
                <a href="@route('product.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
            @endisset
              <li class="nav-item">
                <a href="{{ url('aleart') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Alert Product</p>
                </a>
              </li>
              @isset(auth()->user()->role->permission['permission']['category']['list'])
              <li class="nav-item">
                <a href="@route('category.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Categorie's</p>
                </a>
              </li>
              @endisset
              @isset(auth()->user()->role->permission['permission']['subcategory']['list'])
              <li class="nav-item">
                <a href="@route('subcategory.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sub Categorie's</p>
                </a>
              </li>
              @endisset
              @isset(auth()->user()->role->permission['permission']['brand']['list'])
              <li class="nav-item">
                <a href="@route('brand.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              @endisset
              @isset(auth()->user()->role->permission['permission']['unit']['list'])
              <li class="nav-item">
                <a href="@route('unit.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
              @endisset
              @isset(auth()->user()->role->permission['permission']['warranty']['list'])
              <li class="nav-item">
                <a href="@route('warranty.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Warranty</p>
                </a>
              </li>
              @endisset
            </ul>
           </li>

           @isset(auth()->user()->role->permission['permission']['purchase']['list'])
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Purchase Products
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('purchase.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="@route('purchase.date.filtering')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Purchase Date Filtering</p>
                </a>
              </li>
            </ul>
           </li>
           @endisset
           @isset(auth()->user()->role->permission['permission']['sell']['list'])
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Sell Products
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('sell.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sell List</p>
                </a>
              </li>
            </ul>
           </li>
           @endisset

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Contact
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  @php
                      $customer = 'customer'
                  @endphp
                <a href="@route('contact.create')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Create Contact List</p>
                </a>
              </li>
            </ul>
           </li>
           @isset(auth()->user()->role->permission['permission']['permission']['list'])
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Permission
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('permission.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Permision list</p>
                </a>
              </li>
            </ul>
           </li>
           @endisset
           @isset(auth()->user()->role->permission['permission']['role']['list'])
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Role
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('role.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Role list</p>
                </a>
              </li>
            </ul>
           </li>
           @endisset
           @isset(auth()->user()->role->permission['permission']['report']['list'])
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Reports
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('date.range')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Date Ranger Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('day.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Today Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('week.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Week Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('month.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Month Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('year.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Year Report</p>
                </a>
              </li>
            </ul>
           </li>
           @endisset
           @isset(auth()->user()->role->permission['permission']['setting']['list'])
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tree"></i>
              <p>
                Settings
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('subAdmin.create')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>New Admin Create</p>
                </a>
              </li>
            </ul>
          </li>
          @endisset
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
