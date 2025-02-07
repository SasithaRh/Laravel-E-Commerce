<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Hash;
use Auth;
use Mail;
use App\Mail\RegisterMail;
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
    public function auth_register(Request $request)
    {
       //dd($request->all());
        $checkMail = User::select('users.*')
        ->where('users.email', '=', $request->email)
        ->first();
        if(empty($checkMail)){

            $save = new User;
            $save->name = $request->name;
            $save->email = $request->email;
            $save->status = 1;
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save));
            $user_id= $save->id;
            $url = url("admin/customers/list");
            $message = "New Customer Registered";
            Notification::insertRecord($user_id,$url,$message);
            $json['status'] =true;
            $json['message'] ="User Registered successfully. Please verify your email";

        }else{
            $json['status'] =false;
            $json['message'] ="This Email already registered";
        }
        echo json_encode($json);
    }
    public function auth_signin(Request $request)
    {
       //dd($request->all());
       $remember = !empty($request->is_remember) ? true:false;
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status'=>1,'is_delete'=>0],$remember)){
        if(!empty(Auth::user()->email_verified_at)){
            $json['status'] =true;
            $json['message'] ="Your successfully login";
        }else{
            $save = User::findOrFail(Auth::user()->$id);
            Mail::to($save->email)->send(new RegisterMail($save));
            Auth::logout();
            $json['status'] =false;
            $json['message'] ="Please verify your email";
        }

       }
       else{
        $json['status'] =false;
        $json['message'] ="Please Enter Correct Email & Password";

       }
       echo json_encode($json);
    }
    public function user_logout()  {
        Auth::logout();

    return redirect('home');
    }
public function activate_email($id)  {
    $id = base64_decode($id);
    $user = User::findOrFail($id);
    $user->email_verified_at= date('Y-m-d H:i:s');
    $user->save();
    return redirect('/')->with('success',"Email successfully verified");

}

    public function auth_login_admin(Request $request)
    {
       $remember = !empty($request->remember) ? true:false;
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin'=>1,'status'=>1,'is_delete'=>0],$remember)){
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
