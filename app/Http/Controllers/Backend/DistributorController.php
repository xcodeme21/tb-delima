<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class DistributorController extends Controller
{
    protected $base = 'backend.distributor.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Distributor",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$distributor = DB::table('distributor');  
			
		return Datatables::of($distributor)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('nama', '{{$nama}}')  	    			    
			->editColumn('email', '{{$email}}')  	    			    
			->editColumn('telepon', '{{$telepon}}')  	    			    
			->editColumn('alamat', '{{$alamat}}') 
			->editColumn('action', function ($distributor) {
                return '<a href="distributor/update/'.$distributor->id.'" class="btn btn-sm  btn-warning"><i class="fa fa-fw fa-edit"></i> Edit</a>'
                    ; 
			})
            ->escapeColumns([])
			->make(true);
	}  

    public function add()
    {   
        $data = array(  
            'indexPage' => "Distributor",
        );

        return view($this->base.'add')->with($data);
    }

    public function tambah(Request $request)
    {
        $nama=$request->input('nama');
        $email=$request->input('email');
        $telepon=$request->input('telepon');
        $alamat=$request->input('alamat');

        $cekemail=DB::table('distributor')->where('email',$email)->first();
        if($cekemail != null)
        {
            flash('Email telah terdaftar!')->error();
            return redirect()->back();   
        }

        $cektelepon=DB::table('distributor')->where('telepon',$telepon)->first();
        if($cektelepon != null)
        {
            flash('Nomor HP telah terdaftar!')->error();
            return redirect()->back();   
        }

        DB::table('distributor')->insert(
            [
                'nama' => $nama,
                'email' => $email,
                'telepon' => $telepon,
                'alamat' => $alamat,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('distributor');
    }
    

    public function update($id)
    {   
        $rs=DB::table('distributor')->where('id',$id)->first();

        $data = array(  
            'indexPage' => "Distributor",
            'rs' => $rs
        );

        return view($this->base.'update')->with($data);
    }

    public function edit(Request $request)
    {
        $id=$request->input('id');
        $nama=$request->input('nama');
        $email=$request->input('email');
        $telepon=$request->input('telepon');
        $alamat=$request->input('alamat');

        DB::table('distributor')->where('id',$id)->update(
            [
                'nama' => $nama,
                'email' => $email,
                'telepon' => $telepon,
                'alamat' => $alamat,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('distributor');
    }

		
}