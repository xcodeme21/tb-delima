<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TB - Delima | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('public/frontend/images/favicon.png') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .error{
      color:red;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>TB</b>-Delima</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
  @include('flash::message')
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      {{ Form::open(['route'=>'login-aplikasi', 'id'=>'form','method' => 'POST']) }} 
      {{ Form::token() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      {{ Form::close() }}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('public/dist/js/jquery.validate.min.js') }}"></script>
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

<script>  
  $().ready(function() {   
        
      $("#form").validate({    
          rules: {
              email: { 
                  required: true, 
                  minlength: 5,
          maxlength: 50,
              }, 
              password: { 
                  required: true, 
              }, 
              
          },
          errorElement: "span",
          messages: {
              email:  { 
                  required: "harus diisi...", 
                  minlength: "minimal 5 karakter...", 
                  maxlength: "maksimal 5 karakter...",       
              }, 
              password:  { 
                  required: "harus diisi...",      
              },
          },
          submitHandler: function(form) { 
            form.submit();
          } 
      });
      
        
  });
</script>
</body>
</html>
