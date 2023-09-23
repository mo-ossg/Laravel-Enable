@extends('cms.parent')

@section('title', 'User')
@section('page-big-title', 'Read Users')
@section('page-main-title', 'Users')
@section('page-sub-title', 'Read')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>

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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Permissions</th>
                    <th>Created AT</th>
                    <th>Updated At</th>
                    @canany(['Update-User','Delete-User'])
                    <th>Settings</th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>
                            <a href="{{route('user-permissions.edit',$user->id)}}"
                            class="btn btn-block btn-info">({{$user->permissions_count}})
                            Permissions</a>
                        </td>
                        {{-- <td><span class="badge bg-success">{{$user->email}}</span></td> --}}
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        @canany(['Update-User','Delete-User'])
                        <td>
                            <div class="btn-group">
                            @can('Update-User')
                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('Delete-User')
                            <a href="#" onclick="confirmDestroy('{{$user->id}}',this)" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                            </div>
                        </td>
                        @endcanany
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
    function confirmDestroy(id, ref) {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            destroy(id, ref);
        }
    });
    }

    function destroy(id, ref) {
        //JS - Axios
        axios.delete('/cms/admin/users/'+id)
            .then(function (response) {
                // handle success
                console.log(response);
                ref.closest('tr').remove();
                showMessage(response.data);
        })
            .catch(function (error) {
                // handle error
                console.log(error);
                showMessage(error.response.data);
        })
    }

    function showMessage(data) {
        Swal.fire({
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 1500
        });
    }

</script>

@endsection
