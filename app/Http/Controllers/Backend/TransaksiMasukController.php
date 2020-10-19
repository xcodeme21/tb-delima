<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class TransaksiMasukController extends Controller
{
    protected $base = 'backend.transaksi.masuk.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Transaksi Masuk",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$transaksi = DB::table('transaksi')->where('status_pengiriman',0);  
			
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
                    return '<a href="transaksi-masuk/view/'.$transaksi->id.'" class="btn btn-sm btn-warning btn-block"><i class="fa fa-fw fa-eye"></i> View</a>' 
                    ;
			})
            ->escapeColumns([])
			->make(true);
	} 

    public function count()
    {
        $count = DB::table('transaksi')->where('status_pengiriman',0)->count();
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
            'indexPage' => "Detail Transaksi Masuk",
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
            'indexPage' => "Detail Transaksi Masuk",
            'rs' => $rs,
            'detail' => $detail,
            'profil' => $profil,
        );

        return view($this->base.'invoice')->with($data);
    }

    public function proses($id)
    {
        $cek=DB::table('transaksi')
        ->join('users','transaksi.user_id','=','users.id')
        ->select('transaksi.*','users.email')
        ->where('transaksi.id',$id)->first();

        if($cek->metode_pembayaran == 1)
        {
            DB::table('transaksi')->where('id',$id)->update(
                [
                    'status_pengiriman' =>1,
                    'status_pembayaran' =>1,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
        }
        else
        {
            DB::table('transaksi')->where('id',$id)->update(
                [
                    'status_pengiriman' =>1,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
        }
        
        $produks=DB::table('detail_transaksi')
        ->join('produk','detail_transaksi.produk_id','produk.id')
        ->select('detail_transaksi.*','produk.nama_produk')
        ->where('transaksi_id',$id)
        ->get();

        $profiltoko=DB::table('profil')->where('id',1)->first();

        $details = [
            'alamat_toko' => $profiltoko->alamat,
            'telepon_toko' => $profiltoko->telepon,
            'email_toko' => $profiltoko->email,
            'nama_tujuan' => $cek->nama_tujuan,
            'email' => $cek->email,
            'no_invoice' => $cek->no_invoice,
            'metode_pembayaran' => $cek->metode_pembayaran,
            'total_bayar' => $cek->total_bayar,
            'produks' => $produks,
        ];

        \Mail::to($cek->email)->send(new \App\Mail\ProsesMail($details));

        flash('Transaksi berhasil diproses!')->success();
        return redirect()->route('transaksi-masuk');
    }
		
}