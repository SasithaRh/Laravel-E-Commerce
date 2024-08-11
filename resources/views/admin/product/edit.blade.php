@extends('admin.layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('assest/plugins/summernote/summernote-bs4.min.css')}}">
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Prodcut</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item ">Edit Prodcut </li>
                            <li class="breadcrumb-item active">Edit Prodcut</li>

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

                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="{{ route('update.product', $products['id']) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $products->title }}" placeholder="Enter Product Title">
                                                @error('title')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Select Category</label>
                                                <select name="category_id" id="changeccategory" class="form-control">
                                                    @foreach ($categroy as $detail)
                                                        <option  value="{{ $detail->id }}">{{ $detail->name }}</option>
                                                    @endforeach



                                                </select>
                                                @error('status')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Select Brand</label>
                                                <select name="category_id" class="form-control">
                                                    @foreach ($brand as $brands)
                                                        <option value="{{ $brands->id }}">{{ $brands->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product SKU</label>
                                                <input type="text" name="sku" class="form-control"
                                                    value="{{ $products->sku }}" placeholder="Enter Product SKU">
                                                @error('sku')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Select Sub Category</label>
                                                <select name="sub_category_id" id="getsubcategory" class="form-control">

                                                    <option value="">Select One</option>




                                                </select>
                                                @error('status')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Color</label>
                                                <div class="row">
                                                    @foreach ($color as $colors)
                                                    @php
                                                        $checked='';
                                                    @endphp
                                                    @foreach ($products->getColor as $oldcolor)
                                                    @if($oldcolor->color_id == $colors->id)

                                                    @php
                                                    $checked='checked';
                                                    @endphp
                                                     @endif
                                                    @endforeach
                                                        <div class="col-md-3">
                                                            <label for=""><input type="checkbox" {{ $checked }}
                                                                    value="{{ $colors->id }}" name="color_id[]"
                                                                    id=""> {{ $colors->name }}</label>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Size</label>
                                                <div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Name</th>
                                                                <th class="text-center">Price ($)</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                            <tbody id="attach">
                                                                @php
                                                                    $i_s = 1;
                                                                @endphp
                                                                @foreach ($products->getSize as $size)

                                                                <tr id="deletesize{{ $i_s }}">
                                                                    <td><input type="text" name="size[{{ $i_s }}][name]"
                                                                          value="{{ $size['name'] }}"  class="form-control"></td>
                                                                    <td><input type="text" name="size[{{ $i_s }}][price]"
                                                                        value="{{ $size['price'] }}" class="form-control"></td>
                                                                    <td class="text-center">
                                                                            <button id="{{ $i_s }}" type="button" class="btn btn-danger btn-sm deletes">Delete</button>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $i_s++;
                                                                @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td><input type="text" name="size[100][name]"
                                                               class="form-control"></td>
                                                        <td><input type="text" name="size[100][price]"
                                                           class="form-control"></td>
                                                        <td class="text-center"><button
                                                                class="btn btn-primary btn-sm"
                                                                id="add">Add</button>

                                                        </td>
                                                    </tr>



                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Price</label>
                                                <input type="text" name="price" class="form-control"
                                                    value="{{ $products->price }}" placeholder="Enter Product Price">
                                                @error('price')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Old Price</label>
                                                <input type="text" name="old_price" class="form-control"
                                                    value="{{$products->old_price }}"
                                                    placeholder="Enter Product Old Price">
                                                @error('old_price')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Choose Images</label>
                                                <input type="file" name="image[]" id="" class="form-control" multiple accept="image/*">

                                            </div>
                                        </div>

                                    </div>
                                    @if(!empty($products->getImage->count()))
                                        <div class="row" id="sortable">
                                            @foreach ($products->getImage as $Image)
                                            <div  class="col-md-1 sortable_image" id="{{ $Image->id }}">
                                                <img src="{{ asset('storage/upload/products/' . $Image->image_name) }}" alt="Uploaded Image" style="max-width: 150px; max-height: 150px; margin: 10px;">
                                                    <a style="margin-left: 20%;"  href="{{ route("image.delete", $Image['id']) }}" onclick="return confirm('Are you sure you want to delete this Image?');" class="btn btn-danger btn-sm">Delete</a>

                                            </div>

                                            @endforeach
                                        </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Short Description</label>
                                                <textarea name="short_description" class="form-control" placeholder="Enter Product Short Description">{{ $products->short_description }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Description</label>
                                                <textarea name="description" class="form-control" id="summernote">{{ $products->description }}</textarea>
                                                @error('description')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Additional Description</label>
                                                <textarea name="additional_information" class="form-control" id="summernote2">{{ $products->additional_information }}</textarea>
                                                @error('additional_information')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Shipping Returns</label>
                                                <textarea  name="shipping_return" class="form-control" id="summernote3">{{ $products->shipping_return }}</textarea>
                                                @error('shipping_return')
                                                    <span class="text-danger" align="center">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option {{ $products->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $products->status == 0 ? 'selected' : '' }} value="0">InActive
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger" align="center">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Upadte</button>
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
    <script src="{{ asset('assest/plugins/summernote/summernote-bs4.min.js') }}"></script>
     <script src="{{ asset('assest/plugins/sortable/jquery-ui.js') }}"></script>
    {{--<script>
    $(document).ready(function () {
    $("#sortable").sortable({
        update: function(e, ui){
            var photo_id = [];
            $('.sortable_image').each(function(){
                var id = $(this).attr('id');
                photo_id.push(id);
            });
            $.ajax({
                type: "POST",
                url: "{{ url('admin/product_image_sortable') }}",
                data: {
                    "photo_id": photo_id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        console.log("Order updated successfully");
                    } else {
                        console.error("Error: " + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX error: " + textStatus + " : " + errorThrown);
                }
            });
        }
    });
});


        </script> --}}
    <script>
        $(function () {
          // Summernote
          $('#summernote').summernote()

          $('#summernote2').summernote()
          $('#summernote3').summernote()
        })
      </script>
    <script>
            var i = 101;
    $('body').delegate("#add", 'click', function(e) {
    e.preventDefault();

    var html = `<tr id="deletesize${i}">
                    <td><input type="text" name="size[${i}][name]"  class="form-control"></td>
                    <td><input type="text" name="size[${i}][price]" class="form-control"></td>
                    <td class="text-center"><button
                                                                        class="btn btn-primary mr-1 btn-sm"
                                                                        id="add">Add</button><button id="${i}" type="button" class="btn btn-danger btn-sm deletes">Delete</button></td>
                </tr>`;
                i++;
    $('#attach').append(html);

});
$('body').delegate(".deletes", 'click', function(e) {
    e.preventDefault();
var id=$(this).attr('id');

$("#deletesize"+id).remove();

});

        $('body').delegate("#changeccategory", 'change', function(e) {
            e.preventDefault();
            var id = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ url('admin/get_subcategory') }}",
                data: {
                    'id': id,
                    "_token": "{{ csrf_token() }}"

                },
                dataType: "json",
                success: function(data) {
                    $('#getsubcategory').html(data.html);
                },
                error: function(data) {

                }
            })
        })


    </script>

@endsection
