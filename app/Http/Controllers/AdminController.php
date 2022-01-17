<?php

namespace App\Http\Controllers;
use App\Http\Requests\Users\UpdateprofileRequestByAdmin;
use App\Http\Requests\Users\UpdateprofileRequestByAdminPW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.AdminView', ['users' => $users]);
    }

    public function edit($id){
        $user = User::where('id', $id)->get();
        return view('admin.editAdminView',['user'=>$user]);
    }


    public function update(UpdateprofileRequestByAdmin $request, $id){
        $user = User::findOrFail($id);

        $user -> update([
            'givenname' => $request->givenname,
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'role' => $request->role,
            'role_request' => '',
        ]);

        session()->flash('success','Update erfolgreich');

        return redirect()->back();
        
    }
    public function updatepw(UpdateprofileRequestByAdminPW $request, $id){
        $user = User::findOrFail($id);  

        $user -> update([
            'password' =>  Hash::make($request->password)
        ]);

        session()->flash('success','Update erfolgreich');

        return redirect()->back();
        
    }

    public function delete($id){
        User::where('id', $id)->delete();
        session()->flash('success','User erfolgreich gelöscht');
        return redirect('admin');
    }
}
