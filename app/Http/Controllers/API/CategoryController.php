<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $categories = Category::whereStatus('Active')->select('slug', 'image', 'name_' . $lang . ' as name')->get();
        return CategoryResource::collection($categories);
    }

    public function getCategoryProducts(Request $request)
    {

        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $category = Category::whereId($request->id)->select('name_' . $lang . ' as name', 'slug', 'image')->first();
        if ($request->id == null || !isset($category)){
            return response()->json(['message' => 'You should send valid category ID'],403);
        }
        $products = Product::select('name_' . $lang . ' as name', 'slug', 'code', 'price', 'new', 'points', 'quantity', 'description_' . $lang . ' as name', 'category_id', 'brand_id', 'id')
            ->whereCategoryId($request->id)->with(['colors' => function($colors) use ($lang){
                $colors->select('*','name_'.$lang.' as name');
            } , 'sizes', 'images','category' => function($category) use ($lang) {
                $category->select('id','name_'.$lang.' as name','slug','image');
            },'brand' => function($brand) use ($lang){
                $brand->select('id','name_'.$lang.' as name', 'slug');
            }])->get();
        return response()->json([
            'category' => new CategoryResource($category),
            'products' => ProductResource::collection($products)
        ]);
    }
}
