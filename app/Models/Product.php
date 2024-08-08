<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodct_Color;
use App\Models\Prodct_Size;
use App\Models\Prodct_Image;
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
       $return = self::select('products.*', 'users.name as created_by','categories.slug as category_slug','categories.name as category_name','sub_categories.name as sub_category_name','sub_categories.slug as slug')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id');
        if (!empty($category_id)) {
            $return =  $return->where('products.category_id', '=', $category_id);
        }
        if (!empty($subcategory_id)) {
            $return =  $return->where('products.sub_category_id', '=', $subcategory_id);
        }
        $return =  $return->where('products.is_delete', '=', 0)
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'desc')
        ->paginate(6);

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
        static public function getImageSingle($prodcut_id)
        {
            return Prodct_Image::where('prodcut_id','=',$prodcut_id)->first();
        }
        static public function getAllImage($prodcut_id)  {
            return Prodct_Image::where('prodcut_id','=',$prodcut_id)->get();
       }


}
