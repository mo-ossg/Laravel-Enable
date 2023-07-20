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
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Responsive Hover Table</h3>

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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created AT</th>
                    <th>Updated At</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                    <tr>
                        <td>{{$city->id}}</td>
                        <td>{{$city->name}}</td>
                        <td>{{$city->created_at}}</td>
                        <td>{{$city->updated_at}}</td>
                        <td>-</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('scripts')

@endsection
