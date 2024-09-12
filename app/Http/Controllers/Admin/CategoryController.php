<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Auth;
use Str;
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

        $files = $request->file('image');
        $randomStr = date('YmdHis') . Str::random(10);
        $filename = strtolower($randomStr) . '.' . $files->getClientOriginalExtension();

        // Store the file and get the path
        $path = $files->storeAs('upload/sliders', $filename,'public');
        $data['image'] = $filename;
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

     public function update(UpdateCategoryRequest $request, Category $item)
     {
         // Debug to check request data
         // dd($request->all());

         $data = $request->validated();

         $files = $request->file('image');
         if ($files) {
             $randomStr = date('YmdHis') . Str::random(10);
             $filename = strtolower($randomStr) . '.' . $files->getClientOriginalExtension();

             // Store the file and get the path
             $path = $files->storeAs('upload/category', $filename, 'public');
             $data['image'] = $filename;
         } else {
             // Optionally handle cases where no new image is uploaded
             $data['image'] = $item->image; // Keep the old image if no new file is provided
         }

         $data['created_by'] = Auth::user()->id;

         // Update the category with the new data
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
