<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResoucre;
use App\Http\Resources\ProfileResource;
use App\Models\Address;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getInfo(Request $request)
    {
        $user = User::whereId($request->user()->id)->with('addresses')
            ->select('id','name', 'email', 'phone')->first();
        return new ProfileResource($user);
    }

    public function updateProfile(Request $request){
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        if ($lang == 'en') {
            $messages = [
                'name.required'    => 'Name field is required',
                'password.min'   => 'Password field shouldn\'t be less than 8 characters',
                'phone.numeric'   => 'Phone field should be a number',
            ];
        } else {
            $messages = [
                'name.required'    => 'حقل الأسم مطلوب',
                'password.min'   => 'حقل كلمة المرور يجب الا تقل عن 8 أحرف',
                'phone.numeric'   => 'حقل الهاتف يجب أن يكون رقم',
            ];
        }
        $validate = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'nullable|numeric',
            'password' => 'nullable|min:8',
        ],$messages);
        if ($validate->fails()) {
            return response()->json(['messages' => $validate->messages(), 'success' => false]);
        }
        $user = User::whereId($request->user()->id)->first();
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->password != null)
        {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        if ($lang == 'en') {
            return response()->json(['message' => 'Profile Updated Successfully.', 'success' => true]);
        } else {
            return response()->json(['message' => 'تم تحديث البيانات', 'success' => true]);
        }
    }

    public function getCities(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $cities = City::select('id','name_'.$lang.' as name', 'fee')->get();
        return CityResoucre::collection($cities);
    }

    public function addAddress(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        if ($lang == 'en') {
            $messages = [
                'address.required'    => 'Address field is required',
                'city.required'   => 'City field is required',
            ];
        } else {
            $messages = [
                'address.required'    => 'حقل العنوان مطلوب.',
                'city.required'   => 'حقل المدينة مطلوب',
            ];
        }
        $validate = Validator::make($request->all(), [
            'address' => 'required',
            'city' => 'required',
        ],$messages);
        if ($validate->fails()) {
            return response()->json(['messages' => $validate->messages(), 'success' => false]);
        }
        $address = new Address();
        $address->address = $request->address;
        $address->city_id = $request->city;
        $address->user_id = $request->user()->id;
        $address->save();
        if ($lang == 'en') {
            return response()->json(['message' => 'Address Added Successfully.', 'success' => true]);
        } else {
            return response()->json(['message' => 'تم اضافة العنوان', 'success' => true]);
        }
    }

    public function deleteAddress(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $address = Address::whereId($request->id)->whereUserId($request->user()->id)->first();
        if($address != null){
            $address->delete();
            if ($lang == 'en') {
                return response()->json(['message' => 'Address Deleted Successfully.', 'success' => true]);
            } else {
                return response()->json(['message' => 'تم حذف العنوان', 'success' => true]);
            }
        } else {
            if ($lang == 'en') {
                return response()->json(['message' => 'Something went wrong.', 'success' => false]);
            } else {
                return response()->json(['message' => 'حدث خطأ ما', 'success' => false]);
            }
        }
    }
}
