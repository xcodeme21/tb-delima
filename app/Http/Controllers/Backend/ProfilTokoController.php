<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class ProfilTokoController extends Controller
{
    protected $base = 'backend.profil-toko.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $rs=DB::table('profil')->where('id',1)->first();

        $data = array(  
            'indexPage' => "Profil Toko",
            'rs' => $rs
        );

        return view($this->base.'index')->with($data);
    }

    public function update(Request $request)
    {
        $tentang_toko=$request->input('tentang_toko');
        $alamat=$request->input('alamat');
        $email=$request->input('email');
        $telepon=$request->input('telepon');
        $waktu_buka=$request->input('waktu_buka');

        DB::table('profil')->where('id',1)->update(
            [
                'tentang_toko' => $tentang_toko,
                'alamat' => $alamat,
                'email' => $email,
                'telepon' => $telepon,
                'waktu_buka' => $waktu_buka,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('profil-toko');
    }
		
}