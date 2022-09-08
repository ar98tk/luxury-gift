<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CreateCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name_en', 'name_ar', 'image')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        if ($file = $request->file('image')) {
            $name = rand(100000000, 999999999999) . '.' . $file->getClientOriginalExtension();
            $file->move('images/category-image', $name);
            $category->image = $name;
        }
        $category->save();
        Alert::success('Category Created Successfully.');
        return redirect()->back();
    }

    public function update(UpdateCategoryRequest $request)
    {
        $category = Category::whereId($request->id)->first();
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        if ($request->image != null) {
            if ($file = $request->file('image')) {
                $name = $category->image;
                $file->move('images/category-image', $name);
                $category->image = $name;
            }
        }
        $category->save();
        $category->update();
        Alert::success('Category Updated Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Alert::success('Category Deleted Successfully.');
        return redirect()->back();
    }
}
