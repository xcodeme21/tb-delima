<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $base = 'backend.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  

    public function dashboard()
    {   
        $totalpelanggan=DB::table('users')->where('role',"USER")->count();
        $totalkategori=DB::table('kategori')->count();
        $totalproduk=DB::table('produk')->count();

        $data = array(  
            'indexPage' => "Dashboard",
            'totalpelanggan' => $totalpelanggan,
            'totalkategori' => $totalkategori,
            'totalproduk' => $totalproduk,
        );

        return view($this->base.'index')->with($data);
    }
    
    //METHOD INI UNTUK MENG-GENERATE DATA transaksi 7 HARI TERAKHIR
    public function getChart()
    {
        //MENGAMBIL TANGGAL 7 HARI YANG TELAH LALU DARI TANGGAL HARI INI
        $start = Carbon::now()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';
        //MENGAMBIL TANGGAL HARI INI
        $end = Carbon::now()->format('Y-m-d') . ' 23:59:00';
        
        //SELECT DATA KAPAN RECORDS DIBUAT DAN JUGA TOTAL PESANAN
        $transaksi = DB::table('transaksi')->select(DB::raw('date(created_at) as transaksi_date'), DB::raw('count(*) as total_bayar'))
            //DENGAN KONDISI ANTARA TANGGAL YANG ADA DI VARIABLE $start DAN $end 
            ->whereBetween('created_at', [$start, $end])
            //KEMUDIAN DI KELOMPOKKAN BERDASARKAN TANGGAL
            ->groupBy('created_at')
            ->get()->pluck('total_bayar', 'transaksi_date')->all();
        
        //LOOPING TANGGAL DENGAN INTERVAL SEMINGGU TERAKHIR
        for ($i = Carbon::now()->subWeek()->addDay(); $i <= Carbon::now(); $i->addDay()) {
            //JIKA DATA NYA ADA 
            if (array_key_exists($i->format('Y-m-d'), $transaksi)) {
                //MAKA TOTAL PESANANNYA DI PUSH DENGAN KEY TANGGAL
                $data[$i->format('Y-m-d')] = $transaksi[$i->format('Y-m-d')];
            } else {
                //JIKA TIDAK, MASUKKAN NILAI 0
                $data[$i->format('Y-m-d')] = 0;
            }
        }
        return response()->json($data);
    }
	
	public function logout(Request $request)
	{
        Auth::logout();
        flash('Yeay logout berhasil!')->success();
		return redirect('/login');
    }
		
}