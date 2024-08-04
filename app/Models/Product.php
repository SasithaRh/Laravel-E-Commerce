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



}
