@extends('admin.layouts.app')
@section('style')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Slider List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Slider List</li>
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
                        <h3 class="card-title">Sliders List Table</h3>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{ route('create.slider') }}" class="text-white"><button type="button"
                                class="btn btn-block btn-primary btn-sm">Add New Slider</button></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th style="width: 13%;">Sub Title</th>
                            <th style="width: 20%;">Button Link</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="text-sm"><img src="{{ asset('storage/upload/sliders/' . $detail->image) }}" alt="Product image"  style="height:100px !important;
                                    height: 280px;" ></td>
                                <td class="text-sm">{{ $detail['title'] }}</td>
                                <td class="text-sm">{{ $detail['sub_title'] }}</td>
                                <td class="text-sm">{{ $detail['button_link'] }}</td>

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
