<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function getBrands(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $brands = Brand::select('slug', 'name_' . $lang . ' as name')->get();
        return BrandResource::collection($brands);
    }

    public function getBrandProducts(Request $request)
    {

        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $brand = Brand::whereId($request->id)->select('name_' . $lang . ' as name', 'slug')->first();
        if ($request->id == null || !isset($brand)){
            return response()->json(['message' => 'You should send valid brand ID'],403);
        }
        $products = Product::select('name_' . $lang . ' as name', 'slug', 'code', 'price', 'new', 'points', 'quantity', 'description_' . $lang . ' as name', 'category_id', 'brand_id', 'id')
            ->whereBrandId($request->id)->with(['colors' => function($colors) use ($lang){
                $colors->select('*','name_'.$lang.' as name');
            } , 'sizes', 'images'])->get();
        return response()->json([
            'brand' => new BrandResource($brand),
            'products' => ProductResource::collection($products)
        ]);
    }
}
