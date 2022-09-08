<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Admins\CreateAdminRequest;
use App\Http\Requests\Admin\Admins\UpdateAdminRequest;
use Alert;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::select('id','name','email','role','created_at')->get();
        return view('admin.admins.index',compact('admins'));
    }

    public function store(CreateAdminRequest $request)
    {
        $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);
        $admin->projects()->sync($request->projects);
        Alert::success('Admin Created Successfully.');
        return redirect()->back();
    }

    public function update(UpdateAdminRequest $request)
    {
        $admin = Admin::whereId($request->id)->first();
        $admin->name  = $request->name;
        $admin->email = $request->email;
        $admin->role  = $request->role;
        if($request->password != null){
            $admin->password = Hash::make($request->password);
        }
        $admin->update();
        Alert::success('Admin Updated Successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        Alert::success('Admin Deleted Successfully.');
        return redirect()->back();
    }
}
