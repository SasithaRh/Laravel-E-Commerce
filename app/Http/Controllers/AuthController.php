<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login_admin()
    {
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1){
            return redirect('admin/dashboard');
        }

        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
       $remember = !empty($request->remember) ? true:false;
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin'=>1],$remember)){
        return redirect('admin/dashboard');
       }elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin'=>0],$remember)){
        return redirect('admin/admin/list');
       }
       else{
         return redirect()->back()->with('error','Please Enter Correct Email & Password');
       }

    }
    public function auth_logout_admin()
    {
        Auth::logout();
        return redirect('admin');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
