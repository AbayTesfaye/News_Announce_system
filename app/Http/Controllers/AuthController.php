<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authcontroller extends Controller
{       
    // register user
    public function register(Request $request){
        // validathe the request
       $fields = $request->validate([
                'username' => ['required','max:255'],
                'email' => ['required','max:255','email','unique:users'],
                'password' => ['required','min:4','confirmed']
     ]);
            // hash the password
            $fields['password'] = Hash::make($fields['password']);
        // register 
        $user =User::create($fields);
        
        // login
        Auth::login($user);

        // redirect
       return redirect() -> route('home');

    }
    public function login(Request $request){
        // validathe the request
        $fields = $request->validate([
            'email' => ['required','max:255','email'],
            'password' => ['required']
       ]);
       
          // try to login user
          if(Auth::attempt($fields, $request->remember)){
            return redirect()->intended('dashboard');
          }    
          else {
            return back() -> withInput($request->only('email', 'remember'))
            ->withErrors(['failed' => 'These credentials do not match our records.']);
          } 
        //                        
    }

    // logout user
    public function logout(Request $request){
      Auth::logout();
      
      $request->session()->invalidate();
      $request ->session() ->regenerateToken();

      return redirect('/');

    }
}
