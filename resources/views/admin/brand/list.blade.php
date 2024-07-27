@extends('admin.layouts.app')
@section('style')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brand List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Brand List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @include('admin.layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <h3 class="card-title">Brand List Table</h3>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{ route('create.brand') }}" class="text-white"><button type="button"
                                class="btn btn-block btn-primary btn-sm">Add New Brand</button></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 13%;">Brand Name</th>
                            <th>Slug</th>
                            <th style="width: 13%;">Meta Title</th>
                            <th style="width: 20%;">Meta Description</th>
                            <th style="width: 13%;">Meta Keywords</th>
                            <th style="width: 13%;">Users</th>
                            <th style="width: 9%;">Status</th>

                            <th style="width: 14%;" class="text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="text-sm">{{ $detail['name'] }}</td>
                                <td class="text-sm">{{ $detail['slug'] }}</td>
                                <td class="text-sm">{{ $detail['meta_title'] }}</td>
                                <td class="text-sm">{{ $detail['meta_description'] }}</td>
                                <td class="text-sm">{{ $detail['meta_keywords'] }}</td>
                                <td class="text-sm">{{ $detail['created_by'] }}</td>
                                <td class="text-sm">{!! $detail['status'] == 1
                                    ? '<p class="text-success text-bold">Active</p>'
                                    : '<p class="text-danger text-bold">InActive</p>' !!}</td>

                                <td ><a href="{{ route('edit.brand', $detail['id']) }}"
                                        class="btn btn-primary btn-sm mr-1">Edit</a><a
                                        href="{{ route('delete.brand', $detail['id']) }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this User?');">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center" style="margin-top: 20px;">
                    {{ $details->links() }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>

    </div>

@endsection

@section('script')
    <script src="{{ asset('assest/dist/js/pages/dashboard3.js') }}"></script>

@endsection
