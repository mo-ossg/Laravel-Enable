@extends('cms.parent')

@section('title', 'Edit Admin')
@section('page-big-title', 'Edit Admin')
@section('page-main-title', 'roles')
@section('page-sub-title', 'Edit')

@section('styles')
{{-- Select2 --}}
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Edit Admin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="create-form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Admin</label>
                            <select class="form-control" id="admin" style="width: 100%;">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if($adminRole->id == $role->id) selected
                                        @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{$admin->name}}" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{$admin->email}}" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="button" onclick="update('{{$admin->id}}')"
                        class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')

<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>

<script>
    //Initialize Select2 Elements
    $('#admin').select2({
        theme: 'bootstrap4'
    })

    function update(id) {
        axios.put('/cms/admin/admins/'+id, {
            role_id: document.getElementById('admin').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
        }).then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
        }).catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data.message);
        });
    }


</script>

@endsection
