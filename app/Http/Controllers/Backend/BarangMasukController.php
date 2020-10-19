<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class BarangMasukController extends Controller
{
    protected $base = 'backend.inventory.masuk.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Barang Masuk",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
        $inventory = DB::table('inventory')
        ->leftJoin('distributor','inventory.distributor_id','=','distributor.id')
        ->select('inventory.*','distributor.nama')->where('jenis_inventory',1);  
			
		return Datatables::of($inventory)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('no_invoice', '{{$no_invoice}}')  	    			    
			->editColumn('tanggal_invoice', '{{$tanggal_invoice}}')  	    			    
			->editColumn('nama', '{{$nama}}') 	
			->editColumn('gambar_invoice', function ($inventory) {
                $url= asset('public/img/inventory/'.$inventory->gambar_invoice);
                return '<a href="'.$url.'" target="_blank"><img src="'.$url.'" height="150" width="100" /></a>';
            }) 	    	
            ->editColumn('cost', function ($produk) {
                $hasil_rupiah = "Rp " . number_format($produk->cost,0,',','.');
                return $hasil_rupiah;
            })  		      
			->editColumn('action', function ($inventory) {
                return '<a href="barang-masuk/update/'.$inventory->id.'" class="btn btn-sm  btn-warning btn-block"><i class="fa fa-fw fa-edit"></i> Edit Invoice</a> 
                    <a href="produk" target="_blank" class="btn btn-sm  btn-success btn-block"><i class="fa fa-fw fa-edit"></i> Update Barang</a>'
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
            'indexPage' => "Barang Masuk",
            'distributor_id' => $this->getdistributor()
        );

        return view($this->base.'add')->with($data);
    }

    public function tambah(Request $request)
    {
        $no_invoice=$request->input('no_invoice');
        $distributor_id=$request->input('distributor_id');
        $tanggal_invoice=$request->input('tanggal_invoice');
        $cost=$request->input('cost');
        $angka= str_replace(".", "", $cost);

        
        $gambar_invoice = $request->file('gambar_invoice');
		$namafoto = date('Ymd').'-'.time().'.'.$gambar_invoice->getClientOriginalExtension();
		$destinationPath = public_path('img/inventory');
        $gambar_invoice->move($destinationPath, $namafoto);

        DB::table('inventory')->insert(
            [
                'no_invoice' => $no_invoice,
                'distributor_id' => $distributor_id,
                'tanggal_invoice' => $tanggal_invoice,
                'cost' => $angka,
                'gambar_invoice' => $namafoto,
                'jenis_inventory' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('barang-masuk');
    }
    

    public function update($id)
    {   
        $rs=DB::table('inventory')->where('id',$id)->first();

        $data = array(  
            'indexPage' => "Barang Masuk",
            'rs' => $rs,
            'distributor_id' => $this->getdistributor()
        );

        return view($this->base.'update')->with($data);
    }

    public function edit(Request $request)
    {
        $id=$request->input('id');
        $no_invoice=$request->input('no_invoice');
        $distributor_id=$request->input('distributor_id');
        $tanggal_invoice=$request->input('tanggal_invoice');
        $cost=$request->input('cost');
        $angka= str_replace(".", "", $cost);
        
        $gambar_invoice = $request->file('gambar_invoice');

        if($gambar_invoice == null)
        {
            DB::table('inventory')->where('id',$id)->update(
                [
                    'no_invoice' => $no_invoice,
                    'distributor_id' => $distributor_id,
                    'tanggal_invoice' => $tanggal_invoice,
                    'cost' => $angka,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $namafoto = date('Ymd').'-'.time().'.'.$gambar_invoice->getClientOriginalExtension();
            $destinationPath = public_path('img/inventory');
            $gambar_invoice->move($destinationPath, $namafoto);

            DB::table('inventory')->where('id',$id)->update(
                [
                    'no_invoice' => $no_invoice,
                    'distributor_id' => $distributor_id,
                    'tanggal_invoice' => $tanggal_invoice,
                    'cost' => $angka,
                    'gambar_invoice' => $namafoto,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay berhasil!')->success();
        return redirect()->route('barang-masuk');
    }
}