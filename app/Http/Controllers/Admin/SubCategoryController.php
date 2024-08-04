<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Sub Category';
        $details = SubCategory::select('sub_categories.*', 'users.name as created_by','categories.name as category_name')
        ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->join('users', 'users.id', '=', 'sub_categories.created_by')
        ->where('sub_categories.is_delete', '=', 0)
        ->orderBy('sub_categories.id', 'desc')
        ->paginate(5);
        return view('admin.sub_category.list',$data,compact("details"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'New Sub Category';
        $categroy = Category::select('categories.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'categories.created_by')
        ->where('categories.is_delete', '=', 0)
        ->orderBy('categories.id', 'asc')
        ->get();
        return view('admin.sub_category.add',$data,compact("categroy"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        // dd($request->all());
          $data = $request->validated();
        // $data = $request->all();

        $data['created_by'] = Auth::user()->id;

        SubCategory::create($data);
        return redirect('admin/sub_category/list')->with('success','Sub Category was created successfully !');

    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $details = SubCategory::findOrFail($request->id);
        $data['header_title'] = 'Sub Category Edit';
        $categroy = Category::select('categories.*', 'users.name as created_by')
        ->join('users', 'users.id', '=', 'categories.created_by')
        ->where('categories.is_delete', '=', 0)
        ->orderBy('categories.id', 'asc')
        ->get();
        return view('admin/sub_category/edit',$data,compact('details','categroy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $item)
    {
        // dd($subCategory);
        $data = $request->validated();


        $item->update($data);

        // Redirect with success message
        return redirect('admin/sub_category/list')->with('success', 'Sub Category was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        SubCategory::findOrFail($id)->update([
            'is_delete' => 1,


        ]);
        return redirect()->back()->with('success', 'Sub Category was deleted successfully!');
    }
    public function get_subcategory(Request $request)  {

        $cat_id= $request->id;

        $details = SubCategory::select('sub_categories.*')
        ->join('users', 'users.id', '=', 'sub_categories.created_by')
        ->where('sub_categories.is_delete', '=', 0)
        ->where('sub_categories.status', '=', 1)
        ->where('sub_categories.category_id', '=', $cat_id)
        ->orderBy('sub_categories.name', 'asc')
        ->get();

        $html='';
        $html.='<option  value="">Select One</option>';
        foreach ($details as $detail){
            $html.='<option  value="'.$detail->id.'">'.$detail->name.'</option>';

        }
        $json['html'] =$html;

        echo json_encode($json);

    }

}
