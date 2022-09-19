<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProfileResource;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $success['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] = $user->name;
            if ($lang == 'en') {
                return response()->json(['data' => $success, 'message' => 'Login Successfully.', 'success' => true], 200);
            } else {
                return response()->json(['data' => $success, 'message' => 'تم تسجيل الدخول بنجاح.', 'success' => true], 200);
            }

        } else {
            if ($lang == 'en') {
                return response()->json(['message' => 'Email Or Password isn\'t correct.', 'success' => false], 403);
            } else {
                return response()->json(['message' => 'البريد الإلكتروني أو كلمة المرور غير صحيحين.', 'success' => false], 403);
            }
        }
    }

    public function register(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        if ($lang == 'en') {
            $messages = [
                'name.required'    => 'Name field is required',
                'email.required'   => 'Email field is required',
                'email.unique'     => 'Email is taken',
                'email.email'      => 'Email field should be a valid Email',
                'phone.required'   => 'Phone filed is required',
                'password.required' => 'Password filed is required',
                'password.min'      => 'Password can\'t be less than 8 characters.',
            ];
        } else {
            $messages = [
                'name.required'    => 'حقل الاسم مطلوب.',
                'email.required'   => 'حقل البريد الإلكتروني مطلوب',
                'email.unique'     => 'البريد الإلكتروني مستخدم من قبل.',
                'email.email'      => 'البريد الإلكتروني غير صالح.',
                'phone.required'   => 'رقم الهاتف مطلوب',
                'password.required' => 'كلمة المرور مطلوبة.',
                'password.min'      => 'كلمة المرور لا يمكن أن تقل عن 8 أحرف.',
            ];
        }
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required',
        ],$messages);
        if ($validate->fails()) {
            return response()->json(['messages' => $validate->messages(), 'success' => false]);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($user && Hash::check($request->password, $user->password)) {
            $success['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] = $user->name;
            /*$email['subject'] = 'Welcome to Luxury Gift';
            $email['message'] = 'Thank you for registering in Luxury-Gift.';*/
            /*Mail::to($request->email)
                ->send(new SendEmail($email));*/
            if ($lang == 'en') {
                return response()->json(['data' => $success, 'message' => 'Registered Successfully.', 'success' => true]);
            } else {
                return response()->json(['data' => $success, 'message' => 'تم التسجيل بنجاح.', 'success' => true]);;
            }

        }
    }

    public function logout(Request $request)
    {
        $lang = $request->lang == null ? 'en' : $request->lang;
        if($lang != 'en' && $lang != 'ar'){
            $lang = 'en';
        }
        $request->user()->currentAccessToken()->delete();
        if ($lang == 'en') {
            return response()->json(['message' => 'Logged Out Successfully.', 'success' => true]);
        } else {
            return response()->json(['message' => 'تم تسجيل الدخول', 'success' => true]);
        }

    }

}
