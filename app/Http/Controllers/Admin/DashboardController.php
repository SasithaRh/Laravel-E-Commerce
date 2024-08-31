<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Hash;
use App\Models\Order;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(Request $request)
    {


        $data['header_title'] = 'Dashboard';
        $data['total_orders'] = Order::getTotal();
        $data['today_orders'] = Order::getTodayTotal();
        $data['total_customers'] = User::getTotalCustomers();
        $data['total_payements'] = Order::getTotalpayements();
        $data['latest_orders'] = Order::latestorders();

        if (!empty($request->year)) {
          $year =  $request->year ;
        } else {
            $year =date('Y');
        }


        $getTotalCustomersMonth = '';
        $getTotalOrdersMonth = '';
        $getTotalPaymentsMonth = '';

        for($m = 1; $m<= 12; $m++)
        {
            $startDate= new \DateTime("$year-$m-01");
            $endDate= new \DateTime("$year-$m-01");
            $endDate->modify('last day of this month');

            $startDate = $startDate->format('Y-m-d');
            $endDate = $endDate->format('Y-m-d');


            $customers = User::getTotalCustomersMonth($startDate,$endDate);
            $orders = Order::getTotalOrdersMonth($startDate,$endDate);
            $payments = Order::getTotalPaymentsMonth($startDate,$endDate);
            $getTotalCustomersMonth .= $customers.',';
            $getTotalOrdersMonth .= $orders.',';
            $getTotalPaymentsMonth .= $payments.',';

        }
        $data['getTotalCustomersMonth'] = trim($getTotalCustomersMonth,",");
        $data['getTotalOrdersMonth'] = trim($getTotalOrdersMonth,",");
        $data['getTotalPaymentsMonth'] = trim($getTotalPaymentsMonth,",");

        $data['year'] = $year;
//         dd($data['$getTotalCustomersMonth']);
// die;
        return view('admin.dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
