@extends('cms.parent')

@section('title', 'Create City')
@section('page-big-title', 'Create City')
@section('page-main-title', 'Cities')
@section('page-sub-title', 'Create')

@section('styles')

@endsection

@section('scripts')

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
                <h3 class="card-title">Create City</h3>
                </div>
                <!-- /.card-header -->
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
                @endif

                @if (session()->has('message'))
                <div class="alert alert-{{session('alert-type')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    {{session('message')}}
                </div>
                @endif
                <!-- form start -->
                <form method="POST" action="{{route('cities.store')}}">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Enter name">
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
