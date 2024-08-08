<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'is_delete'
    ];

    static public function getSingleSlug($slug) {
        return self::where('slug', '=', $slug)
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 1)
        ->first();
    }

    static public function getRecordMenu()
    {

       return self::select('categories.*')
        ->join('users', 'users.id', '=', 'categories.created_by')
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 1)
        ->orderBy('categories.id', 'desc')
        ->get();

    }

    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id')->where('sub_categories.is_delete', '=', 0)->where('sub_categories.status', '=', 1);
    }
}
