<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Verify Email</title>

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
        <p class="login-box-msg">Ypu must verify your email, resend verification link from below</p>

        <form>
            <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="button" onclick="sendVerificationEmail()" class="btn btn-primary btn-block">Resend</button>
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
    function sendVerificationEmail() {
        axios.post('/email/verification-notification')
        .then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
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
