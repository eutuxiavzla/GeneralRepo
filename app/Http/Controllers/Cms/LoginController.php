<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            return redirect('/cms');
        }

    	return view('cms.auth.login');
    }


    public function login(Request $request)
    {
    	$user = User::where('email', $request->email)->first();
    	if(isset($user))
    	{
    		if($user->roles->title == 'administrador')
    		{
    			if(Hash::check($request->password, $user->password))
    			{
    				if($request->remember == 'on')
                    {
                        Auth::login($user, true);
                    } else {
                        Auth::login($user);
                    }
    				return redirect('/cms');
    			}

                return back()->with('message', 'Usuario no encontrado o datos incorrectos');

    		} else {
    			return back()->with('message', 'Usuario no encontrado o datos incorrectos');
    		}
    	} else {
    		return back()->with('message', 'Usuario no encontrado o datos incorrectos');
    	}
    }


    //logout de administracion
    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
}
