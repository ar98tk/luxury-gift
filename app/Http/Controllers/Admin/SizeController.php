<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sizes\CreateSizeRequest;
use App\Http\Requests\Admin\Sizes\UpdateSizeRequest;
use App\Models\Size;
use Alert;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::select('id','size')->get();
        return view('admin.sizes.index',compact('sizes'));
    }

    public function store(CreateSizeRequest $request)
    {
        Size::create([
            'size'     => $request->size,
        ]);
        Alert::success('Size Created Successfully.');
        return redirect()->back();
    }

    public function update(UpdateSizeRequest $request)
    {
        $size = Size::whereId($request->id)->first();
        $size->size  = $request->size;
        $size->update();
        Alert::success('Size Updated Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        Alert::success('Size Deleted Successfully.');
        return redirect()->back();
    }
}
