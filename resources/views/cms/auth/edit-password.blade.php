@extends('cms.parent')

@section('title', 'Edit Password')
@section('page-big-title', 'Edit Password')
@section('page-main-title', 'Auth')
@section('page-sub-title', 'Edit Password')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Edit Password</h3>
                </div>
                <form id="edit-form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="current-password">Current Password</label>
                            <input type="password" class="form-control" id="current-password" placeholder="Enter current password">
                        </div>
                        <div class="form-group">
                            <label for="new-password">new Password</label>
                            <input type="password" class="form-control" id="new-password" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirmation">New Password Confirmation</label>
                            <input type="password" class="form-control" id="new-password-confirmation" placeholder="Enter password confirmation">
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="button" onclick="updatePassword()" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')

<script>

    function updatePassword() {
        axios.put('/cms/admin/update-password', {
            password:document.getElementById('current-password').value,
            new_password: document.getElementById('new-password').value,
            new_password_confirmation: document.getElementById('new-password-confirmation').value,
        }).then(function (response) {
            // handle success
            console.log(response);
            document.getElementById('edit-form').reset();
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data.message);
        });
    }


</script>

@endsection
