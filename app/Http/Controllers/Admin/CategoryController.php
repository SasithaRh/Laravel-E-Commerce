<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data['header_title'] = 'Category List';
        $details = Category::select('categories.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'categories.created_by')
        ->where('categories.is_delete', '=', 0)
        ->orderBy('categories.id', 'desc')
        ->paginate(5);
        return view('admin.category.list',$data,compact("details"));
    }
    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $data['header_title'] = 'New Category';
        return view('admin.category.add',$data);
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreCategoryRequest $request)
    {

        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;

        Category::create($data);
        return redirect('admin/category/list')->with('success','Category was created successfully !');
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $details = Category::findOrFail($request->id);
        $data['header_title'] = 'Category Edit';
        return view('admin/category/edit',$data,compact('details'));

    }
    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateCategoryRequest $request,Category $item)
    {

        $data = $request->validated();


    $item->update($data);

    // Redirect with success message
    return redirect('admin/category/list')->with('success', 'Category was updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Category::findOrFail($id)->update([
            'is_delete' => 1,


        ]);
        return redirect()->back()->with('success', 'Category was deleted successfully!');
    }
}
