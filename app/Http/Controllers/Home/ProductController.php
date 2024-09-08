<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Product_review;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProductsearch(Request $request)  {
       // dd($request->all());

        $getproducts =   Product::getproducts();

        $data['getcolors'] =   Color::getcolors();
        $data['getbrands'] =   Brand::getbrands();

        $page = 0;
        if(!empty($getproducts->nextPageUrl())){
            $parse_url = parse_url($getproducts->nextPageUrl());
           // dd($getproducts->nextPageUrl());
            if(!empty($parse_url['query'])){
                parse_str($parse_url['query'],$get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;

            }
        }
        $data['page'] =  $page;
        $data['getproducts'] = $getproducts;
        // dd($page);
        return view('home.product.list',$data);
    }
    public function getCategory($slug,$subslug="")
    {

        //dd($slug);
        $getproductsingle = Product::getproductsingle($slug);
       // dd($getproductsingle);
        $getcategory = Category::getSingleSlug($slug);
        //dd( $getcategory);
        $getsubcategory = SubCategory::getSingleSubSlug($subslug);
        $data['getcolors'] =   Color::getcolors();
        $data['getbrands'] =   Brand::getbrands();

         SubCategory::getSingleSubSlug($subslug);
//dd($getsubcategory);
        if(!empty($getproductsingle)){

            $data['getproductsingle'] = $getproductsingle;
            $data['getRelatedProduct'] =Product::getRelatedProduct($getproductsingle->id,$getproductsingle->sub_category_id);
            $data['getproductReview'] = Product_review::getproductReview($getproductsingle->id);
            $data['getproductReviewcount'] = Product_review::getproductReviewcount($getproductsingle->id);


            //dd($data['getproductReview']);
            return view('home.product.detail',$data);
        }
        else if(!empty($getcategory) && !empty($getsubcategory)){
            $data['getCategory'] =  $getcategory;
            // dd($data['getCategory']);
            $data['getsubcategory'] =  $getsubcategory;
            $data['getsubcategoryfilter'] =  SubCategory::getRecordSubCategory($getcategory->id);

            $getproducts =   Product::getproducts($getcategory->id,$getsubcategory->id);
            $page = 0;
            if(!empty($getproducts->nextPageUrl())){
                $parse_url = parse_url($getproducts->nextPageUrl());
               // dd($getproducts->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'],$get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;

                }
            }
            $data['page'] =  $page;
            $data['getproducts'] = $getproducts;
            return view('home.product.list',$data);
        }else if (!empty($getcategory)) {
            $data['getCategory'] =  $getcategory;
            $getproducts =   Product::getproducts($getcategory->id);
            $data['getsubcategoryfilter'] =  SubCategory::getRecordSubCategory($getcategory->id);
            // dd($data['getsubcategoryfilter']);


            $page = 0;
            if(!empty($getproducts->nextPageUrl())){
                $parse_url = parse_url($getproducts->nextPageUrl());
               // dd($getproducts->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'],$get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;

                }
            }
            $data['page'] =  $page;
            $data['getproducts'] = $getproducts;
            // dd($page);
            return view('home.product.list',$data);
        }
        else{
            abort(404);
        }


    }

    /**
     * Show the form for creating a new resource.
     */

    public function get_product_filter(Request $request)
    {
        // dd($request->all());
        $getproducts =   Product::getproducts();
        $page = 0;
        if(!empty($getproducts->nextPageUrl())){
            $parse_url = parse_url($getproducts->nextPageUrl());
           // dd($getproducts->nextPageUrl());
            if(!empty($parse_url['query'])){
                parse_str($parse_url['query'],$get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;

            }
        }
        // $data['page'] =  $page;
        // $data['getproducts'] = $getproducts;
        //dd($getproducts);
        if(!empty( $getproducts)){
            return response()->json([
                "status" =>true,
                "page" => $page,
                "success" => view('home.product._list',[
                    "getproducts" =>  $getproducts,


                ])

                ->render(),
             ],200);
        }

    }

    /**
     * Store a newly created resource in storage.
     */


     public function my_wishlist()  {

        $data['getproducts'] =   Product::get_my_wishlist(Auth::user()->id);
       // dd( $data['getproducts'] );
        return view('home.product.my_wishlist',$data);
     }
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
