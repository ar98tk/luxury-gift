<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Colors\CreateColorRequest;
use App\Http\Requests\Admin\Colors\UpdateColorRequest;
use App\Models\Color;
use Alert;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::select('id','name_en','name_ar','code')->get();
        return view('admin.colors.index',compact('colors'));
    }

    public function store(CreateColorRequest $request)
    {
        Color::create([
            'name_en'     => $request->name_en,
            'name_ar'     => $request->name_ar,
            'code'    => $request->code,
        ]);
        Alert::success('Color Created Successfully.');
        return redirect()->back();
    }

    public function update(UpdateColorRequest $request)
    {
        $color = Color::whereId($request->id)->first();
        $color->name_en  = $request->name_en;
        $color->name_ar = $request->name_ar;
        $color->code  = $request->code;
        $color->update();
        Alert::success('Color Updated Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        Alert::success('Color Deleted Successfully.');
        return redirect()->back();
    }
}
