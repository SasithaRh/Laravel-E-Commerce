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
static public function get_orders($users)  {
    $return= Order::select('orders.*')
    ->where('orders.user_id', '=', $users)
     ->where('orders.is_delete', '=', 0)
     ->orderBy('orders.id', 'desc')
     ->paginate(10);
     return $return;
 }
 static public function get_order_detail($id)  {
    $return= Order::select('orders.*')
    ->where('orders.id', '=', $id)
     ->where('orders.is_delete', '=', 0)
    ->first();
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
 static public function getTotalUser($userid) {
    $return= Order::select('orders.*')
    ->where('orders.user_id', '=', $userid)
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
 static public function getTodayTotalUser($userid)  {
    $return= Order::select('orders.*')
    ->where('orders.user_id', '=', $userid)
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
static public function getTotalpayementsUser($userid) {
    $return = Order::where('orders.is_payment', '=', 1)
    ->where('orders.user_id', '=', $userid)
        ->where('orders.is_delete', '=', 0)
        ->sum(DB::raw('CAST(REPLACE(amount, ",", "") AS DECIMAL(10,2))'));

    return $return;
}
static public function getTodayTotalpayementsUser($userid) {
    $return = Order::where('orders.is_payment', '=', 1)
    ->where('orders.user_id', '=', $userid)
        ->where('orders.is_delete', '=', 0)
        ->whereDate('orders.created_at', '=', date('Y-m-d'))
        ->sum(DB::raw('CAST(REPLACE(amount, ",", "") AS DECIMAL(10,2))'));

    return $return;
}
static public function getpending_orders($userid) {
    $return = Order::where('orders.is_payment', '=', 1)
    ->where('orders.user_id', '=', $userid)
        ->where('orders.is_delete', '=', 0)
        ->where('orders.status', '=', 1)
        ->count();

    return $return;
}
static public function getprogress_orderss($userid) {
    $return = Order::where('orders.is_payment', '=', 1)
    ->where('orders.user_id', '=', $userid)
        ->where('orders.is_delete', '=', 0)
        ->where('orders.status', '=', 2)
        ->count();

    return $return;
}
static public function getcomplete_orders($userid) {
    $return = Order::where('orders.is_payment', '=', 1)
    ->where('orders.user_id', '=', $userid)
        ->where('orders.is_delete', '=', 0)
        ->where('orders.status', '=', 3)
        ->count();

    return $return;
}
static public function getOrders($userid)  {
    $return= Order::select('orders.*')
    ->where('orders.user_id', '=', $userid)
     ->where('orders.is_delete', '=', 0)
     ->orderBy('orders.id', 'desc')
     ->get();
     return $return;
 }

static public function getcancelled_orders($userid) {
    $return = Order::where('orders.is_payment', '=', 1)
    ->where('orders.user_id', '=', $userid)
        ->where('orders.is_delete', '=', 0)
        ->where('orders.status', '=', 4)
        ->count();

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
