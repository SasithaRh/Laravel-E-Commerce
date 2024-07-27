
@extends('admin.layouts.app')
@section('style')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit Category Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{ route("category") }}">Category List</a></li>
                <li class="breadcrumb-item active">Edit Category Details</li>

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
                  <h3 class="card-title">Category Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('update.category',$details['id']) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$details['id'] }}">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" value="{{ $details->name }}" name="name" class="form-control"  placeholder="Enter Category name">
                        @error('name')
                        <span class="text-danger" align="center">{{ $message }}</span>
                     @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="slug" value="{{ $details->slug }}" class="form-control" placeholder="Enter Slug">
                        @error('slug')
                            <span class="text-danger" align="center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $details->meta_title }}" class="form-control" placeholder="Enter meta_title">
                        @error('meta_title')
                            <span class="text-danger" align="center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Description</label>
                        <input type="text" name="meta_description" value="{{ $details->meta_description }}" class="form-control" placeholder="Enter meta_description">
                        @error('meta_description')
                            <span class="text-danger" align="center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ $details->meta_keywords }}" class="form-control" placeholder="Enter meta_keywords">
                        @error('meta_keywords')
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
                    <button type="submit" class="btn btn-primary">Update</button>
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
