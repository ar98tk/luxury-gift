<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cities\CreateCityRequest;
use App\Http\Requests\Admin\Cities\UpdateCityRequest;
use App\Models\City;
use Alert;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::select('id','name_ar','name_en','fee')->get();
        return view('admin.cities.index',compact('cities'));
    }

    public function store(CreateCityRequest $request)
    {
        City::create([
            'name_en'     => $request->name_en,
            'name_ar'     => $request->name_ar,
            'fee'         => $request->fee,
        ]);
        Alert::success('City Created Successfully.');
        return redirect()->back();
    }

    public function update(UpdateCityRequest $request)
    {
        $city = City::whereId($request->id)->first();
        $city->name_en  = $request->name_en;
        $city->name_ar  = $request->name_ar;
        $city->fee  = $request->fee;
        $city->update();
        Alert::success('City Updated Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        Alert::success('City Deleted Successfully.');
        return redirect()->back();
    }
}
