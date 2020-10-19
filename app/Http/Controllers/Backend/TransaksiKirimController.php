<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class TransaksiKirimController extends Controller
{
    protected $base = 'backend.transaksi.kirim.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Transaksi Kirim",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$transaksi = DB::table('transaksi')->where('status_pengiriman',2);  
			
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
                    return "Belum DiKirim"; 
                }
                elseif($transaksi->status_pengiriman == 1) 
                {
                    return "Sedang DiKirim";
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
                    return '<a href="transaksi-kirim/view/'.$transaksi->id.'" class="btn btn-sm btn-warning btn-block"><i class="fa fa-fw fa-eye"></i> View</a>' 
                    ;
			})
            ->escapeColumns([])
			->make(true);
	} 

    public function count()
    {
        $count = DB::table('transaksi')->where('status_pengiriman',2)->count();
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
            'indexPage' => "Detail Transaksi Kirim",
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
            'indexPage' => "Detail Transaksi Kirim",
            'rs' => $rs,
            'detail' => $detail,
            'profil' => $profil,
        );

        return view($this->base.'invoice')->with($data);
    }

    public function upload(Request $request)
    {
        $id=$request->input('id');
        $bukti_pembayaran = $request->file('bukti_pembayaran');
        $namafoto = date('Ymd').'-'.time().'.'.$bukti_pembayaran->getClientOriginalExtension();
        $destinationPath = public_path('img/bukti');
        $bukti_pembayaran->move($destinationPath, $namafoto);

        DB::table('transaksi')->where('id',$id)->update(
            [
                'bukti_pembayaran' => $namafoto,
                'status_pembayaran' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yay, upload struk berhasil!')->success();
        return redirect()->back();
    }

    public function selesai($id)
    {
        $cek=DB::table('transaksi')
        ->join('users','transaksi.user_id','=','users.id')
        ->select('transaksi.*','users.email')
        ->where('transaksi.id',$id)->first();

        if($cek->bukti_pembayaran == null)
        {
            flash('Harap upload bukti pembayaran COD')->error();
            return redirect()->back();
        }
        DB::table('transaksi')->where('id',$id)->update(
            [
                'status_pengiriman' =>3,
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        
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

        \Mail::to($cek->email)->send(new \App\Mail\SelesaiMail($details));

        flash('Transaksi selesai!')->success();
        return redirect()->route('transaksi-kirim');
    }
		
}