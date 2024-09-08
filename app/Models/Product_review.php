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
    static public function getproductReview($product_id)  {
        $getReview = Product_review::select('*')
        ->join('users','users.id','product_reviews.user_id')

        ->where('product_id','=',$product_id)

        ->paginate(5);
        return $getReview;
    }
    static public function getproductReviewcount($product_id)  {
        $getReview = Product_review::select('*')
        ->join('users','users.id','product_reviews.user_id')

        ->where('product_id','=',$product_id)

        ->count();
        return $getReview;
    }
     public function getratingpercentage()  {

        $rating = $this->rating;
        if($rating == 1){
            return 20;
        }
        if($rating == 2){
            return 40;
        }
        if($rating == 3){
            return 60;
        }
        if($rating == 4){
            return 80;
        }
        if($rating == 5){
            return 100;
        }


    }




}
