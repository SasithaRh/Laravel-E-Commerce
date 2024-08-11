<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'is_delete'
    ];
    static public function getSingleSubSlug($slug) {
        return self::where('slug', '=', $slug)
        ->where('sub_categories.is_delete', '=', 0)
        ->where('sub_categories.status', '=', 1)
        ->first();
    }
    static public function getRecordSubCategory($category_id) {
        return self::select('sub_categories.*')
        ->join('users', 'users.id', '=', 'sub_categories.created_by')
        ->where('sub_categories.is_delete', '=', 0)
        ->where('sub_categories.status', '=', 1)
        ->where('sub_categories.category_id', '=', $category_id )
        ->orderBy('sub_categories.name', 'asc')
        ->get();
    }

        public function totalproducts()
        {
            return $this->hasMany(Product::class, 'sub_category_id')->where('products.is_delete', '=', 0)->where('products.status', '=', 1)->count();
        }

}
