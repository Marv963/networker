<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('LoginView');
    }

    public function login(){
        //Hier Login Routine
        return redirect('/');
    }
}
