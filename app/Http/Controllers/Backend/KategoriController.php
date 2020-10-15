<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class KategoriController extends Controller
{
    protected $base = 'backend.kategori.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Kategori",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$kategori = DB::table('kategori');  
			
		return Datatables::of($kategori)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('nama_kategori', '{{$nama_kategori}}')  	
			->editColumn('action', function ($kategori) {
                return '<a href="kategori/update/'.$kategori->id.'" class="btn btn-sm  btn-warning"><i class="fa fa-fw fa-edit"></i> Edit</a> 
                    <a href="kategori/delete/'.$kategori->id.'" class="btn btn-sm  btn-danger"><i class="fa fa-fw fa-trash"></i> Hapus</a>'
                    ; 
			})
            ->escapeColumns([])
			->make(true);
	}  

    public function add()
    {   
        $data = array(  
            'indexPage' => "Kategori",
        );

        return view($this->base.'add')->with($data);
    }

    public function tambah(Request $request)
    {
        $nama_kategori=$request->input('nama_kategori');

        DB::table('kategori')->insert(
            [
                'nama_kategori' => $nama_kategori,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('kategori');
    }
    

    public function update($id)
    {   
        $rs=DB::table('kategori')->where('id',$id)->first();

        $data = array(  
            'indexPage' => "Kategori",
            'rs' => $rs
        );

        return view($this->base.'update')->with($data);
    }

    public function edit(Request $request)
    {
        $id=$request->input('id');
        $nama_kategori=$request->input('nama_kategori');

        DB::table('kategori')->where('id',$id)->update(
            [
                'nama_kategori' => $nama_kategori,
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('kategori');
    }

    public function delete($id)
    {
        DB::table('kategori')->where('id',$id)->delete();
        flash('Yeay berhasil!')->success();
        return redirect()->route('kategori');
    }
		
}