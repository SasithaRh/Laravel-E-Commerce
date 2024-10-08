<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    public function getProduct() {
        return $this->belongsTo(Product::class,'product_id');

    }
}
