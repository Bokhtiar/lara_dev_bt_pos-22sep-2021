
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chan mia & Sons | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
      .svg{

      }
      .svg-logo{
        background: url(f.svg);
        background-repeat: no-repeat;
        background-size: cover;
      }
      .btn-color{
        background-color: red; /* For browsers that do not support gradients */
        background-image: linear-gradient(to right, rgb(0,85,149),rgb(0,117,184));
      }
      input[type="text"], textarea {

        background-color : #d80e0e;
        border: 0px;

        }

        @media(max-width:576px){
          .svg-logo{
            background: url(images/icon.png)
          }
        }


</style>
<body class="hold-transition svg-logo svg">

    <div class="row">
        <div class="col-md-4 col-lg-4">

        </div>

        <div class="col-12 col-sm-12 col-lg-8 col-md-8" style="">
            <div class="login-box " style="width: 296px;">
                <div class="login-logo">
                  <a href="{{ url('/') }}" class="" style="color: #0F344C"> -</a>
                </div>
                <!-- /.login-logo -->
                <section class="login-form  float-right" >
                  <div class="card" style="background-color:#22719F; border: 3px solid #3494D3;
                  border-radius: 25px; height: 400px; width:283px;" >
                      <div class="">
                          <div class="">
                             <p class="text-center text-light mt-5">WELCOME</p>
                          </div>
                      </div>
                      <div class="card-body my-2"> <!--csss code login-card-body-->
                        <form method="POST" action="{{ route('login') }}">
                          @csrf
                          <div class="form-group has-feedback">
                              <input id="email" type="email" style="background-color: #004986; border: 0px;" placeholder="User Name" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            <span class="fa fa-envelope form-control-feedback"></span>
                          </div>
                          <div class="form-group has-feedback">
                              <input id="password" type="password" style="background-color: #004986; border: 0px;" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            <span class="fa fa-lock form-control-feedback"></span>
                          </div>
                          <div class="form-group">
                              <div class="">
                                  <button  type="submit" style="background-color: #0168AB; color: white" class="btn-color btn btn-block btn-flat">LOGIN</button>
                                </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.login-card-body -->
                    </div>
                </section>
              </div>
        </div>
    </div>

<!-- jQuery -->
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('admin') }}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
