<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Brand;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategory($slug,$subslug="")
    {

        //dd($subslug);
        $getcategory = Category::getSingleSlug($slug);
        $getsubcategory = SubCategory::getSingleSubSlug($subslug);
        $data['getcolors'] =   Color::getcolors();
        $data['getbrands'] =   Brand::getbrands();

         SubCategory::getSingleSubSlug($subslug);
//dd($getsubcategory);
        if(!empty($getcategory) && !empty($getsubcategory)){
            $data['getCategory'] =  $getcategory;
            $data['getsubcategory'] =  $getsubcategory;
            $data['getsubcategoryfilter'] =  SubCategory::getRecordSubCategory($getcategory->id);

            $data['getproducts'] =   Product::getproducts($getcategory->id,$getsubcategory->id);

            return view('home.product.list',$data);
        }elseif (!empty($getcategory)) {
            $data['getCategory'] =  $getcategory;
            $data['getproducts'] =   Product::getproducts($getcategory->id);
            $data['getsubcategoryfilter'] =  SubCategory::getRecordSubCategory($getcategory->id);
            // dd($data['getsubcategoryfilter']);
            return view('home.product.list',$data);
        }
        else{
            abort(404);
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
