<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        return view('admin.subcategory.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory = new SubCategory();
        $subcategory->cate_id = $request->input('cate_id');
        $subcategory->name = $request->input('name');
        $subcategory->slug = $request->input('slug');
        $subcategory->description = $request->input('description');
        $subcategory->save();
        return redirect('sub-category')->with('status',"Sub Category Added Successfully"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        return view('admin.subcategory.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->name = $request->input('name');
        $subcategory->slug = $request->input('slug');
        $subcategory->description = $request->input('description');
        $subcategory->status = $request->input('status') == TRUE ? '1':'0';
        $subcategory->update();
        return redirect('sub-category')->with('status',"Sub-Category updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return redirect('sub-category')->with('status',"Sub category delete Successfully");
    }
}
