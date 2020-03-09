<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class GarcomController extends Controller{
    public function __construct(){
      // this->middleware('auth');
    }

    public function login(){
      return view('auth.loginGarcom');
    }

    public function logout(){
      auth()->guard('garcom')->logout();
      return redirect('/garcom/login');
    }

    public function postLogin(Request $request){
      $validator = validator($request->all(), [
        'email' => 'required|min:3|max:100',
        'password' => 'required|min:3|max:100',
      ]);
      if($validator->fails()){
        return redirect('/garcom/login')
            ->withErrors($validator)
            ->withInput();
      }

      $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

      if(auth()->guard('garcom')->attempt($credentials) ) {
        return redirect('/garcom');
      }else{

        return redirect('/garcom/login')
                  ->withErrors(['errors' => 'Login inválido'])
                  ->withInput();
      }
    }
}
