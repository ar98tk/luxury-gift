<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brands\CreateBrandRequest;
use App\Http\Requests\Admin\Brands\UpdateBrandRequest;
use App\Models\Brand;
use Alert;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::select('id', 'name_en', 'name_ar')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function store(CreateBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name_en = $request->name_en;
        $brand->name_ar = $request->name_ar;
        $brand->save();
        Alert::success('Brand Created Successfully.');
        return redirect()->back();
    }

    public function update(UpdateBrandRequest $request)
    {
        $brand = Brand::whereId($request->id)->first();
        $brand->name_en = $request->name_en;
        $brand->name_ar = $request->name_ar;
        if ($request->image != null) {
            if ($file = $request->file('image')) {
                $name = $brand->image;
                $file->move('images/category-image', $name);
                $brand->image = $name;
            }
        }
        $brand->save();
        $brand->update();
        Alert::success('Brand Updated Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        Alert::success('Brand Deleted Successfully.');
        return redirect()->back();
    }
}
