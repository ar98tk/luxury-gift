<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Alert;

class OrderController extends Controller
{
    public function index()
    {
        $type = 'Today\'s';
        $orders = Order::whereMonth('delivery_date', \Carbon\Carbon::now()->month)->whereYear('delivery_date', \Carbon\Carbon::now()->year)->whereDay('delivery_date', \Carbon\Carbon::now()->day)->get();
        return view('admin.orders.index', compact('orders','type'));
    }

    public function updateMainInfo(Request $request)
    {
        $order = Order::whereId($request->order_id)->first();
        if ($request->delivery_date != null) {
            $order->delivery_date = $request->delivery_date;
        }
        $order->shipping = $request->shipping;
        $order->status = $request->status;
        $order->note = $request->note;
        $order->update();
        Alert::success('تم تحديث البيانات الأساسية للطلب');
        return redirect()->back();
    }

    public function edit($id)
    {
        $products = Product::with('sizes', 'colors')->get();
        $colors = Color::all();
        $sizes = Size::all();
        $order = Order::with('items', 'customer')->whereId($id)->first();
        $orderProducts = OrderProduct::whereOrderId($id)->get();
        return view('admin.orders.edit', compact('order', 'orderProducts', 'products', 'sizes', 'colors'));
    }

    public function show($id)
    {
        $order = Order::with('items', 'customer')->whereId($id)->first();
        $orderProducts = OrderProduct::with(['product','size','color'])->whereOrderId($id)->get();
        return view('admin.orders.show', compact('order', 'orderProducts'));
    }

    public function print($id)
    {
        $order = Order::with('items', 'customer')->whereId($id)->first();
        $orderProducts = OrderProduct::with(['product','color','size'])->whereOrderId($id)->get();
        return view('admin.orders.print', compact('order', 'orderProducts'));
    }

    public function review(Request $request)
    {
        if ($request['customer'] == null) {
            Alert::error('يجب اختيار العميل');
            return redirect()->back();
        }

        if ($request->shipping == null) {
            Alert::error('يجب ادخال قيمة الشحن');
            return redirect()->back();
        }

        if ($request->delivery_date == null) {
            Alert::error('يجب اختيار تاريخ التوصيل');
            return redirect()->back();
        }

        if ($request['product_1'] == null || $request['color_1'] == null || $request['size_1'] == null || $request['count_1'] == null) {
            Alert::error('معلومات المنتج الأول غير صحيحة');
            return redirect()->back();
        }

        $values = ['shipping' => $request->shipping, 'delivery_date' => $request->delivery_date, 'note' => $request->note];
        $customer = Customer::whereId($request['customer'])->select('id', 'name', 'address', 'address_notes', 'email', 'phone')->first();


        $total_price = 0;
        $products = [];
        for ($i = 1; $i <= setting('products'); $i++) {
            if ($request['product_' . $i] !== null && $request['color_' . $i] != null && $request['size_' . $i] != null && $request['count_' . $i] != null) {
                $product = Product::whereId($request['product_' . $i])->first();
                //$color = Color::whereId($request['color_' . $i])->first();
                //$size = Size::whereId($request['size_' . $i])->first();
                $total_price += $product->price * $request['count_' . $i];
                array_push($products,
                    [
                        'product_id' => $product->id,
                        'product_name' => $product->name_ar,
                        'price' => $product->price,
                        'color' => $request['color_'.$i],
                        'size' => $request['size_'.$i],
                        'count' => $request['count_' . $i],
                        'total_price' => $product->price * $request['count_' . $i]
                    ]);
            }
        }
        return view('admin.orders.review', compact('values', 'total_price', 'products', 'customer'));
    }

    public function create()
    {
        $products = Product::with('sizes', 'colors')->get();
        $colors = Color::all();
        $sizes = Size::all();
        $customers = Customer::all('id', 'name', 'phone');
        return view('admin.orders.create', compact('products', 'colors', 'sizes', 'customers'));
    }

    public function store(Request $request)
    {
        $values = json_decode($request->values);
        $products = json_decode($request->products);
        $order = new Order();
        $order->customer_id = $request->customer;
        $order->price = $request->total_price;
        $order->delivery_date = $values->delivery_date;
        $order->note = $values->note;
        $order->shipping = $values->shipping;
        $order->status = 'Confirmed';
        $order->save();
        foreach ($products as $product) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->product_id;
            $orderProduct->count = $product->count;
            $orderProduct->price = $product->price;
            $orderProduct->total_price = $product->total_price;
            $orderProduct->size_id = $product->size;
            $orderProduct->color_id = $product->color;
            $orderProduct->save();
        }
        Alert::success('تم إضافة الطلب بنجاح');
        return redirect()->route('orders.show', $order->id);
    }

    public function waiting()
    {
        $type = 'Waiting';
        $orders = Order::with('customer:id,name,email,phone', 'items')->whereStatus('Waiting')->whereMonth('created_at', '=', Carbon::now()->month)
            ->whereYear('created_at', '=', Carbon::now()->year)->get();
        return view('admin.orders.index', compact('orders','type'));
    }

    public function confirmed()
    {
        $type = 'Confirmed';
        $orders = Order::with('customer:id,name,email,phone', 'items')->whereStatus('Confirmed')->whereMonth('created_at', '=', Carbon::now()->month)
            ->whereYear('created_at', '=', Carbon::now()->year)->get();
        return view('admin.orders.index', compact('orders','type'));
    }

    public function shipping()
    {
        $type = 'Shipping';
        $orders = Order::with('customer:id,name,email,phone', 'items')->whereStatus('Shipping')->whereMonth('created_at', '=', Carbon::now()->month)
            ->whereYear('created_at', '=', Carbon::now()->year)->get();
        return view('admin.orders.index', compact('orders','type'));
    }

    public function delivered()
    {
        $type = 'Delivered';
        $orders = Order::with('customer:id,name,email,phone', 'items')->whereStatus('Delivered')->whereMonth('created_at', '=', Carbon::now()->month)
            ->whereYear('created_at', '=', Carbon::now()->year)->get();
        return view('admin.orders.index', compact('orders','type'));
    }

    public function cancelled()
    {
        $type = 'Cancelled';
        $orders = Order::with('customer:id,name,email,phone', 'items')->whereStatus('Cancelled')->whereMonth('created_at', '=', Carbon::now()->month)
            ->whereYear('created_at', '=', Carbon::now()->year)->get();
        return view('admin.orders.index', compact('orders','type'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        Alert::success('تم حذف الطلب بنجاح');
        return redirect()->back();
    }

    public function destroyOrderItem($id)
    {
        $orderItem = OrderProduct::findOrFail($id);
        $order = Order::whereId($orderItem->order_id)->first();
        $orderProducts = OrderProduct::whereOrderId($order->id)->count();
        if ($orderProducts > 1) {
            $order->price -= $orderItem->total_price;
            $order->update();
            $orderItem->delete();
            Alert::success('تم حذف المنتج من الطلب بنجاح');
            return redirect()->back();
        } else {
            Alert::error('لا يمكن حذف أخر منتج في الطلب');
            return redirect()->back();
        }
    }

    public function addMoreProducts(Request $request)
    {
        if($request->count == null || $request->color == null || $request->size == null || $request->product == null){
            Alert::error('يجب اختيار المنتج و اللون و الكمية و الحجم');
            return redirect()->back();
        }
        $order = Order::whereId($request->order_id)->first();
        $product = Product::whereId($request->product)->first();
        $orderProduct = new OrderProduct();
        $orderProduct->product_id = $product->id;
        $orderProduct->order_id = $order->id;
        $orderProduct->size_id = $request->size;
        $orderProduct->color_id = $request->color;
        $orderProduct->count = $request->count;
        $orderProduct->price = $product->price;
        $orderProduct->total_price = $product->price * $request->count;
        $orderProduct->save();
        $order->price += $orderProduct->total_price;
        $order->update();
        Alert::success('تم إضافة المنتج للطلب');
        return redirect()->back();
    }
}
