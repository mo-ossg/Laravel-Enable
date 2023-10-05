<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

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
        <p class="login-box-msg">Enter your email to receive reset lik</p>

        <form>
            <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="button" onclick="requestForgotPassword()" class="btn btn-primary btn-block">Sign In</button>
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
    function requestForgotPassword() {
        axios.post('/forgot-password', {
            email: document.getElementById('email').value,
        }).then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
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
