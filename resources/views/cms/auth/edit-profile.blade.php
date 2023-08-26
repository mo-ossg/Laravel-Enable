@extends('cms.parent')

@section('title'          , 'Edit Profile')
@section('page-big-title' , 'Edit Profile')
@section('page-main-title', 'Auth')
@section('page-sub-title' , 'Edit Profile')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
                </div>
                <form id="edit-form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{$user->name}}" id="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="{{$user->email}}" id="email" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="button" onclick="updateProfile()" class="btn btn-primary">Submit</button>
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

    function updateProfile() {
        axios.put('/cms/admin/update-profile', {
            name:document.getElementById('name').value,
            email: document.getElementById('email').value,
        }).then(function (response) {
            // handle success
            console.log(response);
            // document.getElementById('edit-form').reset();
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
