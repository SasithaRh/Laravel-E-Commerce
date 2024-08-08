<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Prodct_Color;
use App\Models\Prodct_Size;
use App\Models\Prodct_Image;
use Illuminate\Support\Facades\Storage;

use Str;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Product List';

        $details = Product::select('products.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->where('products.is_delete', '=', 0)
        ->orderBy('products.id', 'desc')
        ->paginate(5);
        return view('admin.product.list',$data,compact("details"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'New Product';
        return view('admin.product.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request)
    {
        //dd($request->title);
        $data = $request->validated();
        $slug= Str::slug($request->input('title'),'-');
        $data['created_by'] = Auth::user()->id;
        //dd($data['slug']);

        $checkSlug=Product::checkSlug($slug);
        if(empty($checkSlug)){
            $data['slug'] = $slug;
            Product::create($data);
        }else{
            $new_slug= $slug.'-'.$data['id'];
            $data['slug'] = $new_slug;
            Product::create($data);

        }
        return redirect('admin/product/list')->with('success','Product was created successfully !');

    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($request)
    {

        $products = Product::findOrFail($request);

        if(!empty($products)){
            $data['product'] =$products;
            $data['header_title'] = 'Product Edit';
            $categroy = Category::select('categories.*')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 0)
            ->where('categories.status', '=', 1)
            ->orderBy('categories.name', 'asc')
            ->get();
            $brand=Brand::select('brands.*')
            ->join('users', 'users.id', '=', 'brands.created_by')
            ->where('brands.is_delete', '=', 0)
            ->where('brands.status', '=', 1)
            ->orderBy('brands.id', 'asc')
            ->get();
            $color = Color::select('colors.*')
            ->join('users', 'users.id', '=', 'colors.created_by')
            ->where('colors.is_delete', '=', 0)
            ->where('colors.status', '=', 1)
            ->orderBy('colors.id', 'desc')
            ->get();
        return view('admin/product/edit',$data,compact('products','categroy','brand','color'));
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
    //dd($request->all());
        $product = Product::findOrFail($id);

        $product->title = $request->title;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->old_price = $request->old_price;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->additional_information = $request->additional_information;
        $product->shipping_return = $request->shipping_return;
        $product->status = $request->status;
        $product->save();

        Prodct_Color::where('product_id', $id)->delete();

        if(!empty($request->color_id)){
                foreach($request->color_id as $color_id)
                {
                    $color = new Prodct_Color;
                    $color->product_id = $id;
                    $color->color_id = $color_id;
                    $color->save();
                }


        }
        $productSizes = Prodct_Size::where('prodcut_id', $id)->get();

// Check if any product sizes were found
if ($productSizes->isNotEmpty()) {
    // Delete the product sizes
    Prodct_Size::where('prodcut_id', $id)->delete();
}
        if(!empty($request->size)){
            foreach($request->size as $size)
            {
                if(!empty( $size['name'])){
                    $sizes = new Prodct_Size;
                    $sizes->prodcut_id = $id;
                    $sizes->name = $size['name'];
                    $sizes->price = !empty($size['price']) ? $size['price'] : 0.00;
                    $sizes->save();
                }

            }


    }
    if ($request->hasFile('image')) {

        // Retrieve all uploaded files
        $files = $request->file('image');

        foreach ($files as $image) {
            // Check if the file is valid
            if ($image->isValid()) {
                // Generate a unique filename
                $randomStr = date('YmdHis') . Str::random(10);
                $filename = strtolower($randomStr) . '.' . $image->getClientOriginalExtension();

                // Store the file and get the path
                $path = $image->storeAs('upload/products', $filename,'public');

                $iamge_upload = new Prodct_Image;
                    $iamge_upload->prodcut_id = $id;
                    $iamge_upload->image_name = $filename;
                    $iamge_upload->image_extension = $image->getClientOriginalExtension();
                    // $iamge_upload->order_by =
                    $iamge_upload->save();
            } else {
                // Handle the case where the file is not valid
            }
        }

    } else {
        // Handle the case where no files are uploaded

    }
        return redirect('admin/product/list')->with('success', 'Product was updated successfully!');





    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($item)
    {
        Prodct_Image::where('id', $item)->delete();

        return redirect()->back()->with('success', 'Image was deleted successfully!');

    }
    // public function product_image_sortable(Request $request) {
    //     // Validate incoming data
    //     $validator = Validator::make($request->all(), [
    //         'photo_id' => 'required|array',
    //         'photo_id.*' => 'exists:product_images,id', // Ensure IDs exist in the table
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 422);
    //     }

    //     if(!empty($request->photo_id)){
    //         $i = 1;
    //         foreach ($request->photo_id as $photo_id) {
    //             $Product_Image = Product_Image::findOrFail($photo_id);


    //             $Product_Image->order_by = $i;
    //             $Product_Image->save();
    //             $i++;
    //         }
    //     }
    //     return response()->json(['success' => true]);
    // }
}
