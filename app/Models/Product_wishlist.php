<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_wishlist extends Model
{
    use HasFactory;

    // static public function checkAlready($product_id,$user_id)  {
    //     self::where('product_id','=',$product_id)->where('user_id','=',$user_id)->count();
    // }
    static public function checkAlready($product_id,$user_id)  {
        $return= Product_wishlist::select('product_wishlists.*')
        ->where('product_wishlists.product_id', '=', $product_id)
         ->where('product_wishlists.user_id', '=', $user_id)
            ->count();
         return $return;
     }
}
