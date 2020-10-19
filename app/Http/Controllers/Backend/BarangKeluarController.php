<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class BarangKeluarController extends Controller
{
    protected $base = 'backend.inventory.keluar.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Barang Keluar",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
        $inventory = DB::table('inventory')
        ->leftJoin('distributor','inventory.distributor_id','=','distributor.id')
        ->select('inventory.*','distributor.nama')->where('jenis_inventory',2);  
			
		return Datatables::of($inventory)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('no_invoice', '{{$no_invoice}}')  	    			    
			->editColumn('tanggal_invoice', '{{$tanggal_invoice}}')  	    			    
			->editColumn('nama', '{{$nama}}') 	
            ->editColumn('cost', function ($produk) {
                $hasil_rupiah = "Rp " . number_format($produk->cost,0,',','.');
                return $hasil_rupiah;
            })  		      
			->editColumn('action', function ($inventory) {
                return '<a href="barang-keluar/detail/'.$inventory->id.'" class="btn btn-sm  btn-warning btn-block"><i class="fa fa-fw fa-edit"></i> Detail Invoice</a>
                <a href="barang-keluar/cetak/'.$inventory->id.'" target="_blank" class="btn btn-sm  btn-success btn-block"><i class="fa fa-fw fa-print"></i> Cetaik Invoice</a>'
                    ; 
			})
            ->escapeColumns([])
			->make(true);
	}  
 
	public function getdistributor() {
		$result = DB::table('distributor')->select('id','nama')->orderBy('nama','ASC')->get(); 
		$return = array(); 
			$return= array('' => '-- Pilih Distributor -- ');
			foreach($result  as $item) { 
				$return[$item->id] = $item->nama;
			} 
		return $return;
	}

    public function add()
    {   
        $data = array(  
            'indexPage' => "Barang Keluar",
            'distributor_id' => $this->getdistributor()
        );

        return view($this->base.'add')->with($data);
    }

    public function tambah(Request $request)
    {
        $distributor_id=$request->input('distributor_id');
        $no_invoice="INV/OUT/".date('y')."/".date('m')."/".$this->random();

        DB::table('inventory')->insert(
            [
                'no_invoice' => $no_invoice,
                'distributor_id' => $distributor_id,
                'tanggal_invoice' => date('Y-m-d'),
                'cost' => 0,
                'jenis_inventory' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('barang-keluar');
    }

    public static function random($length=5)
    {
        $acak='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($acak, 5)), 0, $length);
    }
    

    public function detail($id)
    {   
        $rs=DB::table('inventory')
        ->join('distributor','inventory.distributor_id','=','distributor.id')
        ->select('inventory.*','distributor.nama')
        ->where('inventory.id',$id)->first();

        $detail=DB::table('detail_inventory')
        ->join('produk','detail_inventory.produk_id','=','produk.id')
        ->select('detail_inventory.*','produk.nama_produk')->where('inventory_id',$id)->orderBy('id','DESC')->get();
        $arrayproduk = DB::table('produk')->orderBy('nama_produk','ASC')->get();

        $data = array(  
            'indexPage' => "Barang Keluar",
            'rs' => $rs,
            'detail' => $detail,
            'arrayproduk' => $arrayproduk,
            'distributor_id' => $this->getdistributor(),
            'produk_id' => $this->getproduk()
        );

        return view($this->base.'detail')->with($data);
    }
 
    public function getproduk() {
        $result = DB::table('produk')->select('id','nama_produk')->orderBy('nama_produk','ASC')->get(); 
        $return = array(); 
            $return= array('' => '-- Pilih Produk -- ');
            foreach($result  as $item) { 
                $return[$item->id] = $item->nama_produk;
            } 
        return $return;
    }

    public function tambahdetail(Request $request)
    {
        $produk_id=$request->input('produk_id');
        $inventory_id=$request->input('inventory_id');
        $distributor_id=$request->input('distributor_id');
        $jumlah=$request->input('jumlah');

        $cekproduk=DB::table('produk')->where('id',$produk_id)->first();
        $harga_satuan=$cekproduk->harga;
        $harga_per_produk=$harga_satuan*$jumlah;
        $kurangistok=$cekproduk->stok-$jumlah;


        DB::table('detail_inventory')->insert(
            [
                'inventory_id' => $inventory_id,
                'produk_id' => $produk_id,
                'distributor_id' => $distributor_id,
                'harga_satuan' => $harga_satuan,
                'jumlah' => $jumlah,
                'harga_per_produk' => $harga_per_produk,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $cekinv=DB::table('inventory')->where('id',$inventory_id)->first();
        $cost=$cekinv->cost;
        $plus=$cost+$harga_per_produk;

        DB::table('inventory')->where('id',$inventory_id)->update(
            [
                'cost' => $plus,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('produk')->where('id',$produk_id)->update(
            [
                'stok' => $kurangistok,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Tambah produk berhasil!')->success();
        return redirect()->back();
    }

    public function hapusdetailproduk($inventory_id,$produk_id)
    {
        $cekdetinv=DB::table('detail_inventory')->where('inventory_id',$inventory_id)->where('produk_id',$produk_id)->first();

        $cekinv=DB::table('inventory')->where('id',$inventory_id)->first();
        $cost=$cekinv->cost;
        $minus=$cost-$cekdetinv->harga_per_produk;

        DB::table('inventory')->where('id',$inventory_id)->update(
            [
                'cost' => $minus,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $cekproduk=DB::table('produk')->where('id',$produk_id)->first();
        $tambahstok=$cekproduk->stok+$cekdetinv->jumlah;

        DB::table('produk')->where('id',$produk_id)->update(
            [
                'stok' => $tambahstok,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('detail_inventory')->where('inventory_id',$inventory_id)->where('produk_id',$produk_id)->delete();

        flash('Hapus produk berhasil!')->success();
        return redirect()->back();
                
    }

    public function cetak($id)
    {   
        $rs=DB::table('inventory')
        ->join('distributor','inventory.distributor_id','=','distributor.id')
        ->select('inventory.*','distributor.nama','distributor.telepon','distributor.email','distributor.alamat')
        ->where('inventory.id',$id)->first();

        $detail=DB::table('detail_inventory')
        ->join('produk','detail_inventory.produk_id','=','produk.id')
        ->select('detail_inventory.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('inventory_id',$id)->get();
        $profil=DB::table('profil')->where('id',1)->first();

        $data=array(
            'indexPage' => "Cetak Invoice",
            'rs' => $rs,
            'detail' => $detail,
            'profil' => $profil,
        );

        return view($this->base.'invoice')->with($data);
    }
}