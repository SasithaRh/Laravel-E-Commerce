
@extends('admin.layouts.app')
@section('style')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit Admin Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{ route("list") }}">Admin List</a></li>
                <li class="breadcrumb-item active">Edit Admin Details</li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                @include('admin.layouts.messages')
                <div class="card-header">
                  <h3 class="card-title">Admin Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('update',$details['id']) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$details['id'] }}">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" value="{{ $details->name }}" name="name" class="form-control"  placeholder="Enter name">
                        @error('name')
                        <span class="text-danger" align="center">{{ $message }}</span>
                     @enderror
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" value="{{ $details->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      @error('email')
                      <span class="text-danger" align="center">{{ $message }}</span>
                   @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                      @error('password')
                      <span class="text-danger" align="center">{{ $message }}</span>
                   @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select name="status" id="" class="form-control">
                            <option {{ $details->status == 1 ? 'selected' :'' }} value="1">Active</option>
                            <option {{ $details->status == 0 ? 'selected' :'' }} value="0">InActive</option>
                        </select>
                        @error('status')
                        <span class="text-danger" align="center">{{ $message }}</span>
                     @enderror
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
          </div>
        </div>
      </section>

</div>
    @endsection

    @section('script')
    <script src="{{ asset('assest/dist/js/pages/dashboard3.js')}}"></script>

    @endsection
