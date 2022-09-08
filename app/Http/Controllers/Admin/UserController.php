<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateAddressRequest;
use App\Http\Requests\Admin\Users\CreateUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;
use Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('addresses')->select('id','name','email','phone','created_at')->get();
        return view('admin.users.index',compact('users'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'     => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        Alert::success('User Created Successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $cities = City::all('id','name_en');
        $user = User::with('addresses')->whereId($id)->first();
        return view('admin.users.edit', compact('user', 'cities'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::whereId($id)->first();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone  = $request->phone;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->update();
        Alert::success('User Updated Successfully.');
        return redirect()->back();
    }

    public function storeAddress(CreateAddressRequest $request)
    {
        $address = new Address();
        $address->user_id = $request->id;
        $address->city_id = $request->city;
        $address->address = $request->address;
        $address->save();
        Alert::success('Address Added Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('User Deleted Successfully.');
        return redirect()->back();
    }

    public function destroyAddress($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        Alert::success('Address Deleted Successfully.');
        return redirect()->back();
    }
}
