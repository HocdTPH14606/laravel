{{-- <div>
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</div>
<form
    action="{{route('auth.postLogin')}}"
    method="post"
>
    @csrf
    <div>
        <label for="">Email</label>
        <input type="text" name="email" value="{{old('email')}}">
        @if ($errors->has('email'))
            <span>{{$errors->first('email')}}</span>
        @endif
    </div>
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <button>Login</button>
    </div>
</form> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/dist/css/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('/dist/css/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/dist/css/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('/dist/css/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('/dist/css/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/dist/css/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('/dist/css/summernote/summernote-bs4.min.css')}}">
</head>

<body>
    <div class="row" style="background: #ee4d2d; padding: 15px 0 10px 0; margin: 0;">
        <div class="input col-sm-1"></div>
        <div class="row col-sm-8">
            <div class="col-sm-2">
                <a href="trang-chinh/index.php">
                    <img class="img-rounded" src="../img/logo3.jpg" alt="Logo" width="60px" height="60px" style="margin-bottom: 10px;margin-left: 25px">
                </a>
            </div>
            <div>
                <ul class="nav navbar-nav" style="height: 40px; margin-top: 5px; color:white;">
                    <a href="#" style="color:white; margin-left: 2px; font-size: 36px;">Login</a>
                </ul>
            </div>
        </div>
        <div class="input col-sm-2">
            <ul class="nav navbar-nav" style="height: 40px; margin-top: 20px; color:white;">
                <a href="#" style="color:white; margin-right: 2px;"> Bạn cần trợ giúp ? </a>
            </ul>
        </div>
    </div>
    <div class="hold-transition login-page">
        @yield('content');
    </div>
</body>

</html>