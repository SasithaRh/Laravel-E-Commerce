<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data['header_title'] = 'Admin List';
        $details = User::select('users.*')->where('is_admin','=',1)->where('is_delete','=',0)->orderBy('id','desc')->get();

        return view('admin.admin.list',$data,compact('details'));
    }
    public function add()
    {
        $data['header_title'] = 'Admin New';
        return view('admin.admin.add',$data);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $data = $request->validated();

        $data['email_verified_at'] = time();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect('admin/admin/list')->with('success','User was created successfully !');
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
    public function edit(Request $request)
    {
        $details = User::findOrFail($request->id);
        $data['header_title'] = 'Admin Edit';
        return view('admin/admin/edit',$data,compact('details'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,User $user)
    {

        $data = $request->validated();



    $password = $data['password'] ?? null;
    if ($password) {
        $data['password'] = bcrypt($password);
    } else {
        unset($data['password']);
    }

    // Update user
    $user->update($data);

    // Redirect with success message
    return redirect('admin/admin/list')->with('success', 'User was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        User::findOrFail($id)->update([
            'is_delete' => 1,


        ]);
        return redirect()->back()->with('success', 'User was deleted successfully!');
    }
}
