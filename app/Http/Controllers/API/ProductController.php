<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $products = Product::select('name_' . $lang . ' as name', 'slug', 'code', 'price', 'new', 'points', 'quantity', 'description_' . $lang . ' as name', 'category_id', 'brand_id', 'id')
            ->with(['colors' => function($colors) use ($lang){
                $colors->select('*','name_'.$lang.' as name');
            } , 'sizes', 'images','category' => function($category) use ($lang) {
                $category->select('id','name_'.$lang.' as name','slug','image');
            },'brand' => function($brand) use ($lang){
                $brand->select('id','name_'.$lang.' as name', 'slug');
            }])->get();
        return ProductResource::collection($products);
    }

    public function getProduct(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $product = Product::select('name_' . $lang . ' as name', 'slug', 'code', 'price', 'new', 'points', 'quantity', 'description_' . $lang . ' as name', 'category_id', 'brand_id', 'id')
            ->whereId($request->id)->with(['colors' => function($colors) use ($lang){
                $colors->select('*','name_'.$lang.' as name');
            } , 'sizes', 'images','category' => function($category) use ($lang) {
                $category->select('id','name_'.$lang.' as name','slug','image');
            },'brand' => function($brand) use ($lang){
                $brand->select('id','name_'.$lang.' as name', 'slug');
            }])->first();
        if ($request->id == null || !isset($product)){
            return response()->json(['message' => 'You should send valid category ID'],403);
        }
        return new ProductResource($product);
    }
}
