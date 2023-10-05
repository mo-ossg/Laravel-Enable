@extends('cms.parent')

@section('title', '')
@section('page-big-title', '')
@section('page-main-title', '')
@section('page-sub-title', '')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
                <form>
                    <div class="card-header">
                        <h3 class="card-title">Admins</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" id="search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" onclick="search()" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                </form>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Created AT</th>
                    <th>Updated At</th>
                    <th>Settings</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        {{-- <td><span class="badge bg-success">{{$admin->email}}</span></td> --}}
                        <td>{{$admin->created_at}}</td>
                        <td>{{$admin->updated_at}}</td>
                        <td>
                        @if (auth()->user()->id != $admin->id)
                            <div class="btn-group">
                            <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" onclick="confirmDestroy('{{$admin->id}}',this)" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                            </div>
                        @endif
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

    // function search(name) {
    //     axios.get('/cms/admin/admins' + name, {
    //         // role_id: document.getElementById('role').value,
    //         // name: document.getElementById('name').value,
    //         // email: document.getElementById('email').value,
    //     });
    // }

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
        axios.delete('/cms/admin/admins/'+id)
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
