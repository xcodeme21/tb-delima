<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTransaksiController extends Controller
{
    protected $base = 'backend.transaksi.laporan.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Laporan Transaksi",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$transaksi = DB::table('transaksi')->where('status_pengiriman',3);  
			
		return Datatables::of($transaksi)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('no_invoice', '{{$no_invoice}}')  	    			    
			->editColumn('tanggal_transaksi', '{{$tanggal_transaksi}}') 
            ->editColumn('total_bayar', function ($transaksi) {
                return "Rp. ".number_format($transaksi->total_bayar,0,',','.');
            })  
			->editColumn('action', function ($transaksi) {
                    return '<a href="laporan-transaksi/view/'.$transaksi->id.'" class="btn btn-sm btn-warning btn-block"><i class="fa fa-fw fa-eye"></i> View</a>' 
                    ;
			})
            ->escapeColumns([])
			->make(true);
	} 

    public function view($id)
    {   
        $rs=DB::table('transaksi')->where('id',$id)->first();
        $detail=DB::table('detail_transaksi')
        ->join('produk','detail_transaksi.produk_id','=','produk.id')
        ->select('detail_transaksi.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('transaksi_id',$id)->get();
        $profil=DB::table('profil')->where('id',1)->first();

        $data=array(
            'indexPage' => "Detail Laporan Transaksi",
            'rs' => $rs,
            'detail' => $detail,
            'profil' => $profil,
        );

        return view($this->base.'view')->with($data);
    }

    public function viewinvoice($id)
    {   
        $rs=DB::table('transaksi')->where('id',$id)->first();
        $detail=DB::table('detail_transaksi')
        ->join('produk','detail_transaksi.produk_id','=','produk.id')
        ->select('detail_transaksi.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('transaksi_id',$id)->get();
        $profil=DB::table('profil')->where('id',1)->first();

        $data=array(
            'indexPage' => "Detail Laporan Transaksi",
            'rs' => $rs,
            'detail' => $detail,
            'profil' => $profil,
        );

        return view($this->base.'invoice')->with($data);
    }
 
    public function export()
    {
        return Excel::download(new TransaksiExport, 'Transaksi.xlsx');
    }
		
}