<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderStatus;
use Auth;
use App\Models\Notification;
use Mail;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Order List';
        $details = Order::getRecord();
        return view('admin.order.list',$data,compact("details"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details($id)
    {
        //dd($id);
        $data['header_title'] = 'Order Details';
        $details = Order::getDetail($id);
        return view('admin.order.details',$data,compact("details"));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function orders_status(Request $request)
    {
      //  dd($request->all());
        $details = Order::getDetail($request->order_id);
       // dd($details);
        $details->status = $request->status;
        $details->save();
       // $json['status'] =true;
       $user_id= Auth::user()->id;
       $url = url("admin/order/list");
       $message = "Order No: ".$request->order_id. " Status Updated";
       Notification::insertRecord($user_id,$url,$message);
       Mail::to($details->email)->send(new OrderStatus($details));

        $json['message'] ="Order Status Updated Successfully";
        echo json_encode($json);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
