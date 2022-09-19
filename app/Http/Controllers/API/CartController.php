<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        if ($lang == 'en') {
            $messages = [
                'product.required'    => 'You should choose valid product',
                'quantity.required'   => 'You should enter the product quantity',
                'quantity.numeric'    => 'Quantity should be numeric and between 1 to 50 Items',
            ];
        } else {
            $messages = [
                'product.required'    => 'يجب اختيار منتج',
                'quantity.required'   => 'يجب ادخال عدد القطع المطلوبة من المنتج',
                'quantity.numeric'    => 'الكمية يجب أن تكون بين 1 و 50',
            ];
        }
        $validate = Validator::make($request->all(), [
            'product'  => 'required',
            'quantity' => 'required|numeric|between:1,50',
            'color'    => 'nullable',
            'size'     => 'nullable',
        ],$messages);
        if ($validate->fails()) {
            return response()->json(['messages' => $validate->messages(), 'success' => false]);
        }
        $cart = new Cart();
        $cart->product_id = $request->product;
        $cart->quantity = $request->quantity;
        $cart->color_id = $request->color;
        $cart->size_id = $request->size;
        $cart->user_id = $request->user()->id;
        $cart->save();
        if ($lang == 'en') {
            return response()->json(['message' => 'Product Added To Cart.', 'success' => true]);
        } else {
            return response()->json(['message' => 'تم اضافة المنتج للعربة', 'success' => true]);
        }
    }

    public function deleteFromCart(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $cart = Cart::whereUserId($request->user()->id)->whereId($request->id)->first();
        if ($cart){
            $cart->delete();
            if ($lang == 'en') {
                return response()->json(['message' => 'Product Deleted From Cart Successfully.', 'success' => true]);
            } else {
                return response()->json(['message' => 'تم حذف المنتج من العربة', 'success' => true]);
            }
        } else {
            if ($lang == 'en') {
                return response()->json(['message' => 'Something went wrong.', 'success' => true]);
            } else {
                return response()->json(['message' => 'حدث خطأ ما', 'success' => true]);
            }
        }

    }

    public function emptyCart(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $carts = Cart::whereUserId($request->user()->id)->get();
        foreach ($carts as $cart){
            $cart->delete();
        }
        if ($lang == 'en') {
            return response()->json(['message' => 'Cart Deleted.', 'success' => true]);
        } else {
            return response()->json(['message' => 'حذف منتجات العربة', 'success' => true]);
        }
    }

    public function cartSummary(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $carts = Cart::with([
            'product' => function($product) use ($lang) {
                $product->select('*','name_' .$lang.' as name')->with(['category' => function($category) use ($lang){
                    $category->select('*','name_'.$lang.' as name');
                },'brand' => function($brand) use ($lang){
                    $brand->select('*','name_'.$lang.' as name');
                }]);
            },
            'color'=> function($color) use ($lang) {
                $color->select('*','name_' .$lang.' as name');
            },
            'size'
        ])->whereUserId($request->user()->id)->get();
        return CartResource::collection($carts);
    }
}
