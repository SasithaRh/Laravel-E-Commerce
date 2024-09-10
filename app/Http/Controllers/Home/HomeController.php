<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slider;
use App\Models\Contact_us;
use Hash;
use Auth;
use Mail;
use App\Mail\ContactUsMail;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = Slider::select('sliders.*',)

        // ->where('categories.is_delete', '=', 0)
        ->orderBy('sliders.id', 'desc')
        ->get();
        return view('home.home',compact("details"));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function submit_contact(Request $request)
    {
      // dd($request->all());
       $save = new Contact_us;
       if(!empty(Auth::check())){
        $save->user_id = Auth::user()->id ;
       }

       $save->cname = $request->cname;
       $save->cemail = $request->cemail;
       $save->cphone = $request->cphone;
       $save->csubject = $request->csubject;
       $save->cmessage = $request->cmessage;
       $save->save();
       Mail::to($save->cemail)->send(new ContactUsMail($save));
        return redirect()->back()->with('success',"Thank you for Contact Us");

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {


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
