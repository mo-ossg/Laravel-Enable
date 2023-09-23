@extends('cms.parent')

@section('title', 'Permission')
@section('page-big-title', 'Permission')
@section('page-main-title', 'Permission')
@section('page-sub-title', 'Edit')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$user->name}} Permissions</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Guard</th>
                    <th>Assigned</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                        <td>{{$permission->name}}</td>
                        <td><span class="badge bg-success">{{$permission->guard_name}}</span></td>
                        <td>
                            <div class="icheck-success d-inline">
                                <input type="checkbox"
                                onchange="updateUserPermission('{{$user->id}}','{{$permission->id}}')"
                                @if($permission->assigned) checked="" @endif
                                id="permission'{{$permission->id}}">
                                <label for="permission'{{$permission->id}}">
                                </label>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

<script>

    function updateUserPermission(userId, permissionId) {
        //JS - Axios
        axios.put('/cms/admin/users/'+userId+'/permission',{
            permission_id: permissionId
        })
            .then(function (response) {
                // handle success
                console.log(response);
            toastr.success(response.data.message);
        })
            .catch(function (error) {
                // handle error
                console.log(error);
            toastr.error(error.response.data.message);
        })
    }

</script>

@endsection
