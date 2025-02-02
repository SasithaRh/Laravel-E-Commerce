<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Str;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Home Slider';
        $details = Slider::select('sliders.*',)

        // ->where('categories.is_delete', '=', 0)
        ->orderBy('sliders.id', 'desc')
        ->paginate(5);
        return view('admin.slider.list',$data,compact("details"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'New Slider';
        return view('admin.slider.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $save = new Slider;
        $save->title = $request->title;
        $save->sub_title = $request->sub_title;


        $files = $request->file('image');
        $randomStr = date('YmdHis') . Str::random(10);
        $filename = strtolower($randomStr) . '.' . $files->getClientOriginalExtension();

        // Store the file and get the path
        $path = $files->storeAs('upload/sliders', $filename,'public');
        $save->image = $filename;
        $save->button_link = $request->button_link;
        $save->save();
        return redirect('admin/slider/list')->with('success', 'Slider is saved successfully!');



    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
