<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

static public function getRecord()  {
   $return= Order::select('orders.*')

    ->where('orders.is_delete', '=', 0)
    ->orderBy('orders.id', 'desc')
    ->paginate(10);
    return $return;
}
static public function getDetail($id)  {
    return self::find($id);

 }

 public function getItem()  {
   // return 0;
    return $this->hasMany(Order_item::class,'order_id');
}

}
