<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
