<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class ProdukController extends Controller
{
    protected $base = 'backend.produk.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Produk",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
        $produk = DB::table('produk')
        ->leftJoin('kategori','produk.kategori_id','=','kategori.id')
        ->select('produk.*','kategori.nama_kategori');  
			
		return Datatables::of($produk)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('nama_produk', '{{$nama_produk}}')  	    			    
			->editColumn('nama_kategori', '{{$nama_kategori}}')  	    			    
			->editColumn('keterangan_produk', '{!! substr($keterangan_produk,0,500) !!}'.'...') 
			->editColumn('harga', function ($produk) {
                $hasil_rupiah = "Rp " . number_format($produk->harga,0,',','.');
	            return $hasil_rupiah;
            })	    			    
			->editColumn('stok', '{{$stok}}') 	
			->editColumn('foto_produk', function ($produk) {
                $url= asset('public/img/produk/'.$produk->foto_produk);
                return '<img src="'.$url.'" height="150" width="100" />';
            }) 	    			      
			->editColumn('action', function ($produk) {
                return '<a href="produk/update/'.$produk->id.'" class="btn btn-sm  btn-warning btn-block"><i class="fa fa-fw fa-edit"></i> Edit</a> 
                    <a href="produk/delete/'.$produk->id.'" class="btn btn-sm  btn-danger btn-block"><i class="fa fa-fw fa-trash"></i> Hapus</a>'
                    ; 
			})
            ->escapeColumns([])
			->make(true);
	}  
 
	public function getkategori() {
		$result = DB::table('kategori')->select('id','nama_kategori')->orderBy('nama_kategori','ASC')->get(); 
		$return = array(); 
			$return= array('' => '-- Pilih Kategori -- ');
			foreach($result  as $item) { 
				$return[$item->id] = $item->nama_kategori;
			} 
		return $return;
	}

    public function add()
    {   
        $data = array(  
            'indexPage' => "Produk",
            'kategori_id' => $this->getkategori()
        );

        return view($this->base.'add')->with($data);
    }

    public function tambah(Request $request)
    {
        $nama_produk=$request->input('nama_produk');
        $kategori_id=$request->input('kategori_id');
        $keterangan_produk=$request->input('keterangan_produk');
        $harga=$request->input('harga');
        $angka= str_replace(".", "", $harga);
        $stok=$request->input('stok');

        
        $foto_produk = $request->file('foto_produk');
		$namafoto = date('Ymd').'-'.time().'.'.$foto_produk->getClientOriginalExtension();
		$destinationPath = public_path('img/produk');
        $foto_produk->move($destinationPath, $namafoto);

        DB::table('produk')->insert(
            [
                'nama_produk' => $nama_produk,
                'kategori_id' => $kategori_id,
                'keterangan_produk' => $keterangan_produk,
                'harga' => $angka,
                'foto_produk' => $namafoto,
                'stok' => $stok,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('produk');
    }
    

    public function update($id)
    {   
        $rs=DB::table('produk')->where('id',$id)->first();

        $data = array(  
            'indexPage' => "Produk",
            'rs' => $rs,
            'kategori_id' => $this->getkategori()
        );

        return view($this->base.'update')->with($data);
    }

    public function edit(Request $request)
    {
        $id=$request->input('id');
        $nama_produk=$request->input('nama_produk');
        $kategori_id=$request->input('kategori_id');
        $keterangan_produk=$request->input('keterangan_produk');
        $harga=$request->input('harga');
        $angka= str_replace(".", "", $harga);
        $stok=$request->input('stok');
        
        $foto_produk = $request->file('foto_produk');

        if($foto_produk == null)
        {
            DB::table('produk')->where('id',$id)->update(
                [
                    'nama_produk' => $nama_produk,
                    'kategori_id' => $kategori_id,
                    'keterangan_produk' => $keterangan_produk,
                    'harga' => $angka,
                    'stok' => $stok,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $namafoto = date('Ymd').'-'.time().'.'.$foto_produk->getClientOriginalExtension();
            $destinationPath = public_path('img/produk');
            $foto_produk->move($destinationPath, $namafoto);

            DB::table('produk')->where('id',$id)->update(
                [
                    'nama_produk' => $nama_produk,
                    'kategori_id' => $kategori_id,
                    'keterangan_produk' => $keterangan_produk,
                    'harga' => $angka,
                    'foto_produk' => $namafoto,
                    'stok' => $stok,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay berhasil!')->success();
        return redirect()->route('produk');
    }


    public function delete($id)
    {
        DB::table('produk')->where('id',$id)->delete();
        flash('Yeay berhasil!')->success();
        return redirect()->route('produk');
    }
		
}