<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class AkunController extends Controller
{
    protected $base = 'backend.akun.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Akun"
        );

        return view($this->base.'index')->with($data);
    }

    public function update(Request $request)
    {
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');

        if($password == null)
        {
            DB::table('users')->where('id',Auth::user()->id)->update(
                [
                    'name' => $name,
                    'email' => $email,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            DB::table('users')->where('id',Auth::user()->id)->update(
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt('password'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay berhasil!')->success();
        return redirect()->route('akun');
    }
		
}