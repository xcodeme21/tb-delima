<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class TransaksiProsesController extends Controller
{
    protected $base = 'backend.transaksi.proses.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Transaksi Proses",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$transaksi = DB::table('transaksi')->where('status_pengiriman',1);  
			
		return Datatables::of($transaksi)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('no_invoice', '{{$no_invoice}}')  	    			    
			->editColumn('tanggal_transaksi', '{{$tanggal_transaksi}}')      
            ->editColumn('metode_pembayaran', function ($transaksi) {
                if($transaksi->metode_pembayaran == 1)
                {
                    return "Transfer Bank";
                }
                elseif($transaksi->metode_pembayaran == 2)
                {
                    return "Cash On Delivery";
                }
            }) 
            ->editColumn('status_pembayaran', function ($transaksi) {
                if($transaksi->status_pembayaran == 0 && $transaksi->bukti_pembayaran == null) 
                {
                    return "<span class=".'text-danger'.">Belum Bayar</span>";
                }
                elseif($transaksi->status_pembayaran == 0 && $transaksi->bukti_pembayaran != null)
                {
                    return "<span class=".'text-info'.">Verifikasi Pembayaran</span>";
                }
                else
                {
                    return "<span class=".'text-success'.">Sudah Bayar </span>";
                } 
            })      
            ->editColumn('status_pengiriman', function ($transaksi) {
                if($transaksi->status_pengiriman == 0) 
                {
                    return "Belum Diproses"; 
                }
                elseif($transaksi->status_pengiriman == 1) 
                {
                    return "Sedang Diproses";
                }
                elseif($transaksi->status_pengiriman == 2) 
                {
                    return "Sedang Dikirim";
                }
                else
                {
                    return "Selesai";
                }
            })  
            ->editColumn('total_bayar', function ($transaksi) {
                return "Rp. ".number_format($transaksi->total_bayar,0,',','.');
            })  
			->editColumn('action', function ($transaksi) {
                    return '<a href="transaksi-proses/view/'.$transaksi->id.'" class="btn btn-sm btn-warning btn-block"><i class="fa fa-fw fa-eye"></i> View</a>' 
                    ;
			})
            ->escapeColumns([])
			->make(true);
	} 

    public function count()
    {
        $count = DB::table('transaksi')->where('status_pengiriman',1)->count();
        return $count;  
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
            'indexPage' => "Detail Transaksi Proses",
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
            'indexPage' => "Detail Transaksi Proses",
            'rs' => $rs,
            'detail' => $detail,
            'profil' => $profil,
        );

        return view($this->base.'invoice')->with($data);
    }

    public function kirim($id)
    {
        DB::table('transaksi')->where('id',$id)->update(
            [
                'status_pengiriman' =>2,
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        flash('Transaksi berhasil dikirim!')->success();
        return redirect()->route('transaksi-proses');
    }
		
}