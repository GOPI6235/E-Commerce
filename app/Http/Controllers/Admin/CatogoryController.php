<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\File;

class CatogoryController extends Controller
{
    public function index()
    {
        $category = category::all();
        return view('admin.category.index', compact('category'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function insert(Request $request)
    {
        try {
            $category = new Category();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('assets/upload/category', $filename);
                $category->image = $filename;
            }

            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == TRUE ? '1' : '0';
            $category->popular = $request->input('popular') == TRUE ? '1' : '0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_keyword = $request->input('meta_keyword');
            $category->meta_description = $request->input('meta_description');

            // Save the category
            $category->save();

            return response()->json(['message' => 'Category added successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCategoryData()
    {
        try {
            $categories = Category::select('id', 'name')->get();
    
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {

        $category = category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {

        $category = category::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/upload/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/upload/category', $filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keyword = $request->input('meta_keyword');
        $category->meta_description = $request->input('meta_description');
        $category->update();
        return redirect('categories')->with('status', "Category updated Successfully");
    }

    public function destroy($id)
    {
        $category = category::find($id);
        if ($category->image) {
            $path = 'assets/upload/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('categories')->with('status', "Category delete Successfully");
    }
}
