@extends('admin.layouts.app')
@section('style')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Color</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item ">Color List</li>
                            <li class="breadcrumb-item active">Add New Color</li>

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
                                <h3 class="card-title">Required All The Feilds</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="{{ route('store.color') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Color Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Color name">
                                        @error('name')
                                            <span class="text-danger" align="center">{{ $message }}</span>
                                        @enderror
                                    </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Color Code</label>
                                    <input type="color" name="code" class="form-control" placeholder="Enter Color Code">
                                    @error('code')
                                        <span class="text-danger" align="center">{{ $message }}</span>
                                    @enderror
                                </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" align="center">{{ $message }}</span>
                                        @enderror
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
    <script src="{{ asset('assest/dist/js/pages/dashboard3.js') }}"></script>

@endsection