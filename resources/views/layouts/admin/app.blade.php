
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> POS | @yield('title')</title>

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/ba78558982.js" crossorigin="anonymous"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.admin.partial.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.admin.partial.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('admin_content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('admin') }}/dist/js/demo.js"></script>

<script src="{{ asset('admin') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('admin') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="{{ asset('admin') }}/plugins/chartjs-old/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('admin') }}/dist/js/pages/dashboard2.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" charset="utf-8"></script>





@if(Session::has('insert'))
  <script type="text/javascript">
    swal("Inserted Data","Added Sucessfully...","success")
  </script>
@endif


@if(Session::has('update'))
  <script type="text/javascript">
    swal("Updated Data","Update Sucessfully...","success")
  </script>
@endif

@if(Session::has('delete'))
  <script type="text/javascript">
    swal("Delete Successfully","Delete Secessfully","success")
  </script>
@endif



@if(Session::has('status'))
  <script type="text/javascript">
    swal("Complate","Status Update Successfully","success")
  </script>
@endif

@if(Session::has('reset_password'))
  <script type="text/javascript">
    swal("Enter your valid Password","Dont matched the password plz inter your valid password...","success")
  </script>
@endif


<script type="text/javascript">

$(document).on("click","#delete",function(e){
e.preventDefault();
var link=$(this).attr("href");
bootbox.confirm("are you want to delete",function(confirmed){
  if(confirmed){
    window.location.href=link;
};
});
});



</script>
@yield('js')



</body>
</html>
