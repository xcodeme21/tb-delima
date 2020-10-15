<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth, Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;
 
    public function login_form()
    {
		if (Auth::check()) {
			// The user is logged in...
			return redirect('backend/dashboard');
		}
        $querySistem = null;
		$data = array(   
			'querySistem' => $querySistem, 
		);
		
        return view('auth.login')->with($data);;
    }
	
    public function login(Request $request)
    {
        $rules = [
            'email'   => 'required',
            'password'=> 'required',
        ];
         $messages = [
            'required'=>"Form tidak boleh kosong",
        ];
        // $remember = $request->input('remember');
        $validation = Validator::make($request->all(),$rules, $messages);
        if($validation->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        } 

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'role'=>"ADMIN"])) {  
            flash('Yeay login berhasil!')->success();
			return redirect('backend/dashboard');
        }else{ 
            flash('Login gagal. Silahkan cek kembali isian Anda!')->error();
			return redirect('/login'); 
        }

    }
	
    public function reloadCaptcha()
    {
        return captcha_img();
    }
}
