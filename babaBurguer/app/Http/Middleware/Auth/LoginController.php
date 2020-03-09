<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
      $validator = validator($request->all(), [
        'email' => 'required|min:3|max:100',
        'password' => 'required|min:3|max:100',
      ]);
      if($validator->fails()){
        return redirect('/login')
            ->withErrors($validator)
            ->withInput();
      }

      $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

      if(auth()->guard('web')->attempt($credentials) ) {
        return redirect('/');
      }else{

        return redirect('/login')
                  ->withErrors(['errors' => 'Login inválido'])
                  ->withInput();
      }
      }
}
