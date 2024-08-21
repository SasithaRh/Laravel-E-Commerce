<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Http\Requests\StoreDiscountCodeRequest;
use App\Http\Requests\UpdateDiscountCodeRequest;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Discount Code';
        $details = DiscountCode::select('discount_code.*')
        ->where('discount_code.is_delete', '=', 0)
        ->where('discount_code.status', '=', 1)
        ->orderBy('discount_code.id', 'desc')
        ->paginate(5);

        return view('admin.discountcode.list',$data,compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Add New Discount Code';
        return view('admin.color.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountCodeRequest $request)
    {
        $data = $request->validated();


        DiscountCode::create($data);
        return redirect('admin/discountcode/list')->with('success','Discount Code was created successfully !');

    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountCode $discountCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

        public function edit(Request $request)
        {
            $details = DiscountCode::findOrFail($request->id);
            $data['header_title'] = 'Discount Code Edit';
            return view('admin/discountcode/edit',$data,compact('details'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountCodeRequest $request, DiscountCode $discountCode)
    {
        $data = $request->validated();


        $item->update($data);

        // Redirect with success message
        return redirect('admin/discountcode/list')->with('success', 'Discount Code was updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DiscountCode::findOrFail($id)->update([
        'is_delete' => 1,


    ]);
    return redirect()->back()->with('success', 'Discount Code was deleted successfully!');
}
}
