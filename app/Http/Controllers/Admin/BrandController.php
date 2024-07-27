<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\StorebrandRequest;
use App\Http\Requests\UpdatebrandRequest;
use Illuminate\Http\Request;
use Str;
use Auth;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Brand List';
        $details = Brand::select('brands.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'brands.created_by')
        ->where('brands.is_delete', '=', 0)
        ->orderBy('brands.id', 'desc')
        ->paginate(5);

        return view('admin.brand.list',$data,compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Add New Brand';
        return view('admin.brand.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebrandRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;

        Brand::create($data);
        return redirect('admin/brand/list')->with('success','Brand was created successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $details = Brand::findOrFail($request->id);
        $data['header_title'] = 'Brand Edit';
        return view('admin/brand/edit',$data,compact('details'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebrandRequest $request, brand $item)
    {
        $data = $request->validated();


        $item->update($data);

        // Redirect with success message
        return redirect('admin/brand/list')->with('success', 'Brand was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Brand::findOrFail($id)->update([
            'is_delete' => 1,


        ]);
        return redirect()->back()->with('success', 'Brand was deleted successfully!');
    }
}
