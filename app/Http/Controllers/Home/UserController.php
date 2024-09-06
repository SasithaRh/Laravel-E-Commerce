<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Dashboard';
        $data['total_orders'] = Order::getTotalUser(Auth::user()->id);
        $data['today_orders'] = Order::getTodayTotalUser(Auth::user()->id);
        $data['total_payements'] = Order::getTotalpayementsUser(Auth::user()->id);
        $data['today_payements'] = Order::getTodayTotalpayementsUser(Auth::user()->id);
        $data['pending_orders'] = Order::getpending_orders(Auth::user()->id);
        $data['progress_orders'] = Order::getprogress_orderss(Auth::user()->id);
        $data['complete_orders'] = Order::getcomplete_orders(Auth::user()->id);
        $data['cancelled_orders'] = Order::getcancelled_orders(Auth::user()->id);

        return view('home.user.dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function auth_logout_user()
    {
        Auth::logout();
        return redirect('');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function user_orders()
    {
        $data['header_title'] = 'Orders';

        $data['get_orders'] = Order::getOrders(Auth::user()->id);

        return view('home.user.orders',$data);
    }
    /**
     * Display the specified resource.
     */
    public function user_editprofile(User $user)
    {
        $data['header_title'] = 'Profile';
        return view('home.user.profile',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function change_password(User $user)
    {
        $data['header_title'] = 'Paassword Change';
        return view('home.user.change_password',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function user_orders_details($id)
    {
       //dd($id);
       $data['header_title'] = 'Order Details';

        $data['get_order_detail'] = Order::get_order_detail($id);

        return view('home.user.orders_details',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
