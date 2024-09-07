<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodct_Color;
use App\Models\Prodct_Size;
use App\Models\Prodct_Image;
use App\Models\Category;
use Request;
use Auth;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'sub_category_id',
        'brand_id',
        'old_price',
        'price',
        'short_description',
        'description',
        'additional_information',
        'shipping_return',
        'status',
        'created_by',
        'is_delete'
    ];

    static public function checkSlug($slug){

        return self::where('slug','=',$slug)->count();

    }
    static public function getproducts($category_id = "" , $subcategory_id = "")  {

       $return = self::select('products.*', 'users.name as users_name','categories.slug as category_slug','categories.name as category_name','sub_categories.name as sub_category_name','sub_categories.slug as slugs')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id');
        if (!empty($category_id)) {
            $return =  $return->where('products.category_id', '=', $category_id);
        }
        if (!empty($subcategory_id)) {
            $return =  $return->where('products.sub_category_id', '=', $subcategory_id);
        }
        if (!empty(Request::get('sub_category_id'))) {
            $subcategory_id =rtrim(Request::get('sub_category_id'),',');

            $subcategory_id_array = explode(",",$subcategory_id);

            $return =  $return->whereIn('products.sub_category_id', $subcategory_id_array);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return =  $return->where('products.category_id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_subcategory_id'))) {
                $return =  $return->where('products.sub_category_id', '=',Request::get('old_subcategory_id'));
            }
        }
        if (!empty(Request::get('brand_id'))) {
            $brand_id =rtrim(Request::get('brand_id'),',');

            $brand_id_array = explode(",",$brand_id);

            $return =  $return->whereIn('products.brand_id', $brand_id_array);
        }
        if (!empty(Request::get('color_id'))) {
            $color_id =rtrim(Request::get('color_id'),',');

            $color_id_array = explode(",",$color_id);

            $return =  $return->join('prodct__colors', 'prodct__colors.product_id','=','products.id');
            $return =  $return->whereIn('prodct__colors.color_id', $color_id_array);
        }
        if(!empty(Request::get('start_price'))&& !empty(Request::get('end_price'))){

            $start_price = str_replace('$','',Request::get('start_price'));
            $end_price = str_replace('$','',Request::get('end_price'));
            $return =  $return->where('products.price', '>=', $start_price);
            $return =  $return->where('products.price', '<=', $end_price);
            // dd($start_price.$end_price);
        }
        if(!empty(Request::get('q'))){
            $return =  $return->where('products.title', 'like','%'.(Request::get('q').'%'));
        }
        $return =  $return->where('products.is_delete', '=', 0)
        ->where('products.status', '=', 1)
         ->groupBy('products.id')
        ->orderBy('products.id', 'desc')
        ->paginate(3);

        return $return;

    }


    static public function getproductsingle($slug)  {
        return Product::where('slug','=',$slug)->where('products.is_delete', '=', 0)->where('products.status', '=', 1)->first();
    }
    static public function getRelatedProduct($product_id,$sub_category_id)  {
        $return = self::select('products.*', 'users.name as created_by','categories.slug as category_slug','categories.name as category_name','sub_categories.name as sub_category_name','sub_categories.slug as slugs')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->where('products.id', '!=', $product_id)
        // ->where('products.sub_category_id', '!=', $sub_category_id)
       ->where('products.is_delete', '=', 0)
        ->where('products.status', '=', 1)
         ->groupBy('products.id')
        ->orderBy('products.id', 'desc')
        ->limit(10)
        ->get();

        return $return;
    }
        public function getColor()
        {
            return $this->hasMany(Prodct_Color::class, 'product_id');
        }
        public function getSize()
        {
            return $this->hasMany(Prodct_Size::class, 'prodcut_id');
        }
        public function getImage()
        {
            return $this->hasMany(Prodct_Image::class, 'prodcut_id');
        }

        public function getCategory()
        {
            return $this->belongsTo(Category::class, 'category_id');

        }
        public function getSubCategory()
        {
            return $this->belongsTo(SubCategory::class, 'sub_category_id');

        }

        static public function getImageSingle($prodcut_id)
        {
            return Prodct_Image::where('prodcut_id','=',$prodcut_id)->first();
        }

        static public function getAllImage($prodcut_id)  {
            return Prodct_Image::where('prodcut_id','=',$prodcut_id)->get();
       }
       static public function checkWishlist($prodcut_id)
       {
        return Product_wishlist::checkAlready($prodcut_id,Auth::user()->id);
       }
       static public function get_my_wishlist($user_id)
       {
        $return = self::select('products.*', 'users.name as created_by','categories.slug as category_slug','categories.name as category_name','sub_categories.name as sub_category_name','sub_categories.slug as slugs')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->join('product_wishlists', 'product_wishlists.product_id', '=', 'products.id')

        ->where('product_wishlists.user_id', '=', $user_id)
       ->where('products.is_delete', '=', 0)
        ->where('products.status', '=', 1)
         ->groupBy('products.id')
        ->orderBy('products.id', 'desc')

        ->get();

        return $return;
       }




}
