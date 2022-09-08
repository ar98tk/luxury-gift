<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.users.index', compact('products'));
    }

    public function create()
    {
        $colors = Color::all('id','name_ar','name_en','code');
        $sizes  = Size::all('id','size');
        $categories = Category::whereStatus('Active')->select('id','name_ar','name_en')->get();
        $brands = Brand::all('id','name_en','name_ar');
        return view('admin.products.create',compact('colors','sizes','categories','brands'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->price = $request->price;
        $product->code = $request->code;
        $product->points = $request->points;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->new = $request->new;
        $product->save();
        $product->colors()->attach($request->colors);
        $product->sizes()->attach($request->sizes);
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = rand(100000000, 999999999999) . $file->getClientOriginalName();
                $file->move('product-images', $name);
                $image = new Image();
                $image->path = '/product-images/'.$name;
                $image->product_id = $product->id;
                $image->save();
            }
        }
        Alert::success('Product Created Successfully.');
        return redirect()->back();
    }
}
