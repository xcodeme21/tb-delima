<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;

class DashboardController extends Controller
{
    protected $base = 'backend.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  

    public function dashboard()
    {   
        $totalpelanggan=DB::table('users')->where('role',"USER")->count();
        $totalkategori=DB::table('kategori')->count();
        $totalproduk=DB::table('produk')->count();

        $data = array(  
            'indexPage' => "Dashboard",
            'totalpelanggan' => $totalpelanggan,
            'totalkategori' => $totalkategori,
            'totalproduk' => $totalproduk,
        );

        return view($this->base.'index')->with($data);
    }
	
	public function logout(Request $request)
	{
        Auth::logout();
        flash('Yeay logout berhasil!')->success();
		return redirect('/login');
    }
		
}