<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if ($lang != 'en' && $lang != 'ar') {
            $lang = 'en';
        }
        $values = Setting::all();
        $settings = [
            'phone' => explode(',', unserialize($values->where('key', '=', 'phone')->first()->value)),
            'whatsapp' => explode(',', unserialize($values->where('key', '=', 'whatsapp')->first()->value)),
            'email' => explode(',', unserialize($values->where('key', '=', 'email')->first()->value)),
            'location' => explode(',', unserialize($values->where('key', '=', 'location')->first()->value)),
            'address' => explode(',', unserialize($values->where('key', '=', 'address_' . $lang)->first()->value)),
            'about' => $values->where('key', '=', 'about_' . $lang)->first()->value,
            'footer' => $values->where('key', '=', 'footer_' . $lang)->first()->value,
            'terms' => $values->where('key', '=', 'terms_' . $lang)->first()->value,
        ];
        return response()->json($settings);
    }
}
