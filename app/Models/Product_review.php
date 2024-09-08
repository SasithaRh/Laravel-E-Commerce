<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    use HasFactory;

    static public function getReview($product_id,$order_id,$user_id)  {
        $getReview = Product_review::select('product_reviews.*')
        ->where('order_id','=',$order_id)
        ->where('product_id','=',$product_id)
        ->where('user_id','=',$user_id)
        ->first();
        return $getReview;
    }


}
