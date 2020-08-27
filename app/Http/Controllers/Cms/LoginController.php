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
    				Auth::login($user, true);
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
}
