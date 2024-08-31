<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
static public function latestorders()  {
    $return= Order::select('orders.*')

     ->where('orders.is_delete', '=', 0)
     ->orderBy('orders.id', 'desc')
     ->limit(10)
     ->get();
     return $return;
 }
static public function getDetail($id)  {
    return self::find($id);

 }
 static public function getTotal() {
    $return= Order::select('orders.*')

    ->where('orders.is_delete', '=', 0)

    ->count();
    return $return;
 }
 static public function getTodayTotal()  {
    $return= Order::select('orders.*')
    ->whereDate('orders.created_at', '=', date('Y-m-d'))
    ->where('orders.is_delete', '=', 0)

    ->count();
    return $return;
 }

 static public function getTotalpayements() {
    $return = Order::where('orders.is_payment', '=', 1)
        ->where('orders.is_delete', '=', 0)
        ->sum(DB::raw('CAST(REPLACE(amount, ",", "") AS DECIMAL(10,2))'));

    return $return;
}
static public function getTotalOrdersMonth($startDate,$endDate) {
    $details = Order::select('orders.*')
    ->where('is_delete','=',0)
    ->whereDate('created_at','>=',$startDate)
    ->whereDate('created_at','<=',$endDate)
    ->count();
    return $details;
    }
    static public function getTotalPaymentsMonth($startDate,$endDate) {
        $details = Order::select('orders.*')
        ->where('is_delete','=',0)
        ->whereDate('created_at','>=',$startDate)
        ->whereDate('created_at','<=',$endDate)
        ->sum(DB::raw('CAST(REPLACE(amount, ",", "") AS DECIMAL(10,2))'));
        return $details;
        }

 public function getItem()  {
   // return 0;
    return $this->hasMany(Order_item::class,'order_id');
}

}
