@extends('cms.parent')

@section('title', 'Edit Category')
@section('page-big-title', 'Edit Category')
@section('page-main-title', 'Categories')
@section('page-sub-title', 'Categories')

@section('styles')

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
                <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="create-form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control"  value="{{$category->name}}" id="name" placeholder="Enter name">
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" id="description" placeholder="Enter ...">{{$category->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" @if($category->status) checked @endif>
                                <label class="custom-control-label" for="status">Visible</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="button" onclick="update('{{$category->id}}')" class="btn btn-primary">Submit</button>
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

<script>

    function update(id) {
        axios.put('/cms/admin/categories/' + id, {
            name:        document.getElementById('name').value,
            description: document.getElementById('description').value,
            status:      document.getElementById('status').checked,
        }).then(function (response) {
            // handle success
            console.log(response);
            window.location.href = "/cms/admin/categories"
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
