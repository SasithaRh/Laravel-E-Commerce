<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Illuminate\Http\Request;
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
        // $details = Category::select('categories.*', 'users.name as created_by')
        // ->join('users', 'users.id', '=', 'categories.created_by')
        // ->where('categories.is_delete', '=', 0)
        // ->orderBy('categories.id', 'desc')
        // ->paginate(5);
        return view('admin.product.list',$data);
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
        return view('admin/product/edit',$data,compact('products'));
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}
