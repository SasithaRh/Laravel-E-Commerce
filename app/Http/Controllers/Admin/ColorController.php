<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use Illuminate\Http\Request;
use Str;
use Auth;
class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Color List';
        $details = Color::select('colors.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'colors.created_by')
        ->where('colors.is_delete', '=', 0)
        ->orderBy('colors.id', 'desc')
        ->paginate(5);

        return view('admin.color.list',$data,compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Add New Color';
        return view('admin.color.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {

        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;

        Color::create($data);
        return redirect('admin/color/list')->with('success','Color was created successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $details = Color::findOrFail($request->id);
        $data['header_title'] = 'Color Edit';
        return view('admin/color/edit',$data,compact('details'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $item)
    {
        $data = $request->validated();


        $item->update($data);

        // Redirect with success message
        return redirect('admin/color/list')->with('success', 'Color was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Color::findOrFail($id)->update([
        'is_delete' => 1,


    ]);
    return redirect()->back()->with('success', 'Color was deleted successfully!');
}
}
