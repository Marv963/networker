<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateprofileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class UserController extends Controller
{
   
    public function edit(){
        return view('users.EditUserView')->with('user', auth()->user());
    }

    public function update(UpdateprofileRequest $request){
        $user = Auth::user();

        $user -> update([
            'givenname' => $request->givenname,
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'role_request' => $request->role_request,
            'password' =>  Hash::make($request->password)
        ]);

        session()->flash('success','Update erfolgreich');

        return redirect()->back();
        
    }
}
