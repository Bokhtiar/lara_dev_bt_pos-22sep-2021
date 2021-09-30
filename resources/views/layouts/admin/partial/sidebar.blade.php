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

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Products
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('product.create')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Product Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="@route('product.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('aleart') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Alert Product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('category.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Categorie's</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="@route('subcategory.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sub Categorie's</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="@route('brand.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
            </ul>
           </li>

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
                <a href="@route('purchase.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Purchase Create</p>
                </a>
              </li>
            </ul>
           </li>

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
                <a href="@route('purchase.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sell List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="@route('sell.create')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sell Create</p>
                </a>
              </li>
            </ul>
           </li>

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Orders
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="@route('order.index')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Order List</p>
                </a>
              </li>
            </ul>
           </li>

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
                <a href="@route('day.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Today Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('week.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Week</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="@route('month.report')" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Month Report</p>
                </a>
              </li>
            </ul>
           </li>
{{--
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Sub-Category
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/sub-category') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sub-Categorie's</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Products
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/product') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Blogs
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/blog') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Blog List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tree"></i>
              <p>
                Orders
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/orders') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>All Order</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tree"></i>
              <p>
                Contact
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/contact') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>All Contact</p>
                </a>
              </li>
            </ul>
          </li> --}}

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
              <li class="nav-item">
                <a href="{{ url('admin/about/create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>About-Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/terms/create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Terms Of Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/privacy/create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Privacy Policy</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
