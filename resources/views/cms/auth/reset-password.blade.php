<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Reset Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="cms/index2.html" class="h1"><b>Enable</b>CMS</a>
        </div>
    <div class="card-body">
        <p class="login-box-msg">Enter your new password</p>

        <form>
            <div class="input-group mb-3" hidden>
            <input type="email" class="form-control" id="email" value="{{$email}}" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control" id="password_confirmation" placeholder="Password confirmation">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="button" onclick="resetPassword()" class="btn btn-primary btn-block">Reset Password</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>

<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

<script>
    function resetPassword() {
        axios.post('/reset-password', {
            token: '{{$token}}',
            // token: document.getElementById('token').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
        }).then(function (response) {
            // handle success
            console.log(response);
            window.location.href = '/cms/admin/login'
            // window.location.href = '/cms/admin';
        })
        .catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data.message);
        });
    }
</script>
</body>
</html>
