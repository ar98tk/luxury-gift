<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Alert;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        Setting::where('key','phone')->first()->update(['value' => serialize($request->phone)]);
        Setting::where('key','whatsapp')->first()->update(['value' => serialize($request->whatsapp)]);
        Setting::where('key','email')->first()->update(['value' =>serialize($request->email)]);
        Setting::where('key','address_ar')->first()->update(['value' =>serialize($request->address_ar)]);
        Setting::where('key','address_en')->first()->update(['value' =>serialize($request->address_en)]);
        Setting::where('key','location')->first()->update(['value' =>serialize($request->location)]);
        Setting::where('key','terms_ar')->first()->update(['value' =>$request->terms_ar]);
        Setting::where('key','terms_en')->first()->update(['value' =>$request->terms_en]);
        Setting::where('key','footer_en')->first()->update(['value' =>$request->footer_en]);
        Setting::where('key','footer_ar')->first()->update(['value' =>$request->footer_ar]);
        Setting::where('key','about_en')->first()->update(['value' =>$request->about_en]);
        Setting::where('key','about_ar')->first()->update(['value' =>$request->about_ar]);
        Alert::success('Settings Updated Successfully.');
        return redirect()->back();
    }
}
