<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class FrontendController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $bestseller=DB::table('produk')
            ->join('kategori','produk.kategori_id','=','kategori.id')
            ->select('produk.*','kategori.nama_kategori')
            ->orderBy('total_penjualan','DESC')->limit(5)->get();
            $produk=DB::table('produk')->paginate(5);
            $profil=DB::table('profil')->where('id',1)->first();
            $banner=DB::table('banner')->where('id',1)->first();
            $onebest=DB::table('produk')->orderBy('total_penjualan','DESC')->first();
            $otherbest=DB::table('produk')->orderBy('total_penjualan','DESC')->skip(1)->limit(6)->get();
            $produkpilihan=DB::table('produk')->inRandomOrder()->limit(10)->get();
            $merek=DB::table('logo_merek')->get();
            
            $totalkategori=DB::table('kategori')->count();
            $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
            $isikeranjangku=DB::table('keranjang')
            ->join('produk','keranjang.produk_id','=','produk.id')
            ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
            ->where('user_id', Auth::user()->id)->get();
            $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');

            $data=array(
                'kategori' => $kategori,
                'bestseller' => $bestseller,
                'produk' => $produk,
                'profil' => $profil,
                'banner' => $banner,
                'onebest' => $onebest,
                'otherbest' => $otherbest,
                'produkpilihan' => $produkpilihan,
                'merek' => $merek,
                'totalkategori' => $totalkategori,
                'totalkeranjangku' => $totalkeranjangku,
                'isikeranjangku' => $isikeranjangku,
                'totalhargakeranjangku' => $totalhargakeranjangku,
            );
        }
        else
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $bestseller=DB::table('produk')
            ->join('kategori','produk.kategori_id','=','kategori.id')
            ->select('produk.*','kategori.nama_kategori')
            ->orderBy('total_penjualan','DESC')->limit(5)->get();
            $produk=DB::table('produk')->paginate(5);
            $profil=DB::table('profil')->where('id',1)->first();
            $banner=DB::table('banner')->where('id',1)->first();
            $onebest=DB::table('produk')->orderBy('total_penjualan','DESC')->first();
            $otherbest=DB::table('produk')->orderBy('total_penjualan','DESC')->skip(1)->limit(6)->get();
            $produkpilihan=DB::table('produk')->inRandomOrder()->limit(10)->get();
            $merek=DB::table('logo_merek')->get();
            
            $totalkategori=DB::table('kategori')->count();

            $data=array(
                'kategori' => $kategori,
                'bestseller' => $bestseller,
                'produk' => $produk,
                'profil' => $profil,
                'banner' => $banner,
                'onebest' => $onebest,
                'otherbest' => $otherbest,
                'produkpilihan' => $produkpilihan,
                'merek' => $merek,
                'totalkategori' => $totalkategori,
            );
        }
        

        return view('index')->with($data);
    }

    public function listbycategory($id)
    {
        if(Auth::check())
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $profil=DB::table('profil')->where('id',1)->first();
            $result=DB::table('produk')->where('kategori_id',$id)->inRandomOrder()->get();
            $rskategori=DB::table('kategori')->where('id',$id)->first();
            $countproduk=DB::table('produk')->get();
            $totalkategori=DB::table('kategori')->count();
            $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
            $isikeranjangku=DB::table('keranjang')
            ->join('produk','keranjang.produk_id','=','produk.id')
            ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
            ->where('user_id', Auth::user()->id)->get();
            $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');

            

            $data=array(
                'kategori' => $kategori,
                'profil' => $profil,
                'result' => $result,
                'rskategori' => $rskategori,
                'countproduk' => $countproduk,
                'totalkategori' => $totalkategori,
                'totalkeranjangku' => $totalkeranjangku,
                'isikeranjangku' => $isikeranjangku,
                'totalhargakeranjangku' => $totalhargakeranjangku,
            );
        }
        else
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $profil=DB::table('profil')->where('id',1)->first();
            $result=DB::table('produk')->where('kategori_id',$id)->inRandomOrder()->get();
            $rskategori=DB::table('kategori')->where('id',$id)->first();
            $countproduk=DB::table('produk')->get();
            $totalkategori=DB::table('kategori')->count();

            $data=array(
                'kategori' => $kategori,
                'profil' => $profil,
                'result' => $result,
                'rskategori' => $rskategori,
                'countproduk' => $countproduk,
                'totalkategori' => $totalkategori,
            );
        }

        return view('listbycategory')->with($data);
    }

    public function addkeranjang($id)
    {
        if(!Auth::check())
        {
            flash('Silahkan login dahulu!')->error();
            return redirect()->route('pages-login');
        }

        $cekkeranjang=DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->first();
        $produk=DB::table('produk')->where('id',$id)->first();
        $harga=$produk->harga;

        if($cekkeranjang == null)
        {
            $insert=DB::table('keranjang')->insert(
                [
                    'user_id' => Auth::user()->id,
                    'produk_id' => $id,
                    'jumlah' => 1,
                    'harga_per_produk' =>$harga,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $ditambahsatu=$cekkeranjang->jumlah+1;
            $hargaditambah=$cekkeranjang->harga_per_produk+$harga;
            $update=DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->update(
                [
                    'jumlah' => $ditambahsatu,
                    'harga_per_produk' => $hargaditambah,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Berhasil ditambahkan ke keranjang!')->success();
        return redirect()->back();
    }

    public function deletekeranjang($id)
    {
        DB::table('keranjang')->where('id',$id)->delete();

        flash('Produk berhasil dihapus di keranjang!')->success();
        return redirect()->back();
    }

    public function kurangikeranjang($id)
    {
        $cekkeranjang=DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->first();
        $produk=DB::table('produk')->where('id',$id)->first();
        $harga=$produk->harga;

        
        $dikurangisatu=$cekkeranjang->jumlah-1;
        $dikurangi=$cekkeranjang->harga_per_produk-$harga;

        if($cekkeranjang->jumlah == 1)
        {
            DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->delete();   
        }

        $update=DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->update(
            [
                'jumlah' => $dikurangisatu,
                'harga_per_produk' => $dikurangi,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Berhasil diupdate ke keranjang!')->success();
        return redirect()->back();
    }

    public function viewproduk($id)
    {
        if(Auth::check())
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $profil=DB::table('profil')->where('id',1)->first();

            $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
            $isikeranjangku=DB::table('keranjang')
            ->join('produk','keranjang.produk_id','=','produk.id')
            ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
            ->where('user_id', Auth::user()->id)->get();
            $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');
            $rs=DB::table('produk')
            ->join('kategori','produk.kategori_id','=','kategori.id')
            ->select('produk.*','kategori.nama_kategori')
            ->where('produk.id',$id)->first();
            $reviews=DB::table('reviews')->where('produk_id',$id)->orderBy('id','DESC')->get();

            

            $data=array(
                'kategori' => $kategori,
                'profil' => $profil,
                'totalkeranjangku' => $totalkeranjangku,
                'isikeranjangku' => $isikeranjangku,
                'totalhargakeranjangku' => $totalhargakeranjangku,
                'rs' => $rs,
                'reviews' => $reviews,
            );
        }
        else
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $profil=DB::table('profil')->where('id',1)->first();
            $rs=DB::table('produk')
            ->join('kategori','produk.kategori_id','=','kategori.id')
            ->select('produk.*','kategori.nama_kategori')
            ->where('produk.id',$id)->first();
            $reviews=DB::table('reviews')->where('produk_id',$id)->orderBy('id','DESC')->get();

            $data=array(
                'kategori' => $kategori,
                'profil' => $profil,
                'rs' => $rs,
                'reviews' => $reviews,
            );
        }

        return view('viewproduk')->with($data);
    }

    public function tambahkeranjang(Request $request)
    {
        if(!Auth::check())
        {
            flash('Silahkan login dahulu!')->error();
            return redirect()->route('pages-login');
        }

        $id=$request->input('id');
        $jumlah=$request->input('jumlah');

        $cekkeranjang=DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->first();
        $produk=DB::table('produk')->where('id',$id)->first();
        $harga=$produk->harga;

        if($cekkeranjang == null)
        {
            $totalharga=$harga*$jumlah;
            $insert=DB::table('keranjang')->insert(
                [
                    'user_id' => Auth::user()->id,
                    'produk_id' => $id,
                    'jumlah' => $jumlah,
                    'harga_per_produk' =>$totalharga,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $ditambahjumlah=$cekkeranjang->jumlah+$jumlah;
            $totalharga=$harga*$ditambahjumlah;
            $update=DB::table('keranjang')->where('user_id',Auth::user()->id)->where('produk_id',$id)->update(
                [
                    'jumlah' => $ditambahjumlah,
                    'harga_per_produk' => $totalharga,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Berhasil ditambahkan ke keranjang!')->success();
        return redirect()->back();
    }

    public function tulispenilaian (Request $request)
    {
        $produk_id=$request->input('produk_id');
        $reviews=$request->input('reviews');
        $user=DB::table('users')->where('id',Auth::user()->id)->first();

        DB::table('reviews')->insert(
            [
                'user_id' => Auth::user()->id,
                'produk_id' => $produk_id,
                'reviews' => $reviews,
                'nama' => $user->name,
                'email' => $user->email,
                'foto' => $user->photo,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay, berhasil menulis penilaian!')->success();
        return redirect()->back();
    }

    public function searchproduk(Request $request)
    {
        $search=$request->input('search');

        if(Auth::check())
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $profil=DB::table('profil')->where('id',1)->first();

            $countproduk=DB::table('produk')->get();
            $totalkategori=DB::table('kategori')->count();
            $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
            $isikeranjangku=DB::table('keranjang')
            ->join('produk','keranjang.produk_id','=','produk.id')
            ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
            ->where('user_id', Auth::user()->id)->get();
            $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');
            $result=DB::table('produk')->where('nama_produk','like','%'.$search.'%')->get();

            

            $data=array(
                'kategori' => $kategori,
                'profil' => $profil,
                'countproduk' => $countproduk,
                'totalkategori' => $totalkategori,
                'totalkeranjangku' => $totalkeranjangku,
                'isikeranjangku' => $isikeranjangku,
                'totalhargakeranjangku' => $totalhargakeranjangku,
                'result' => $result,
                'search' => $search,
            );
        }
        else
        {
            $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
            $profil=DB::table('profil')->where('id',1)->first();
            $countproduk=DB::table('produk')->get();
            $totalkategori=DB::table('kategori')->count();
            $result=DB::table('produk')->where('nama_produk','like','%'.$search.'%')->get();

            $data=array(
                'kategori' => $kategori,
                'profil' => $profil,
                'countproduk' => $countproduk,
                'totalkategori' => $totalkategori,
                'result' => $result,
                'search' => $search,
            );
        }

        return view('searchproduk')->with($data);
    }
 
    public function lihatkeranjang()
    {
        $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();
        $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
        $isikeranjangku=DB::table('keranjang')
        ->join('produk','keranjang.produk_id','=','produk.id')
        ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('user_id', Auth::user()->id)->get();
        $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');

        $data=array(
            'kategori' => $kategori,
            'profil' => $profil,
            'totalkeranjangku' => $totalkeranjangku,
            'isikeranjangku' => $isikeranjangku,
            'totalhargakeranjangku' => $totalhargakeranjangku,
        );

        return view('lihatkeranjang')->with($data);
    }
 
    public function checkout()
    {
        $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();
        $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
        $isikeranjangku=DB::table('keranjang')
        ->join('produk','keranjang.produk_id','=','produk.id')
        ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('user_id', Auth::user()->id)->get();
        $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');

        $data=array(
            'kategori' => $kategori,
            'profil' => $profil,
            'totalkeranjangku' => $totalkeranjangku,
            'isikeranjangku' => $isikeranjangku,
            'totalhargakeranjangku' => $totalhargakeranjangku,
        );

        return view('checkout')->with($data);
    }

    public function postcheckout(Request $request)
    {
        $nama_tujuan=$request->input('nama_tujuan');
        $no_hp_tujuan=$request->input('no_hp_tujuan');
        $alamat_tujuan=$request->input('alamat_tujuan');
        $metode_pembayaran=$request->input('metode_pembayaran');
        $no_invoice="INV/".date('y')."/".date('m')."/".date('H')."/".$this->random(); //var_dump($no_invoice);die();
        $total_bayar=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');

        if($total_bayar == 0)
        {
            flash('Anda belum memilih produk apapun!')->error();
            return redirect()->back();
        }
        if($metode_pembayaran == 1)
        {
            $status_pengiriman = 0;
        }
        else
        {   
            $status_pengiriman = 1;
        }

        $inserttransaksi=DB::table('transaksi')->insert(
            [
                'no_invoice' => $no_invoice,
                'tanggal_transaksi' => date('Y-m-d'),
                'user_id' => Auth::user()->id,
                'nama_tujuan' => $nama_tujuan,
                'no_hp_tujuan' => $no_hp_tujuan,
                'alamat_tujuan' => $alamat_tujuan,
                'total_bayar' => $total_bayar,
                'metode_pembayaran' => $metode_pembayaran,
                'status_pembayaran' => 0,
                'status_pengiriman' => $status_pengiriman,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ]
        );

        $transaksi=DB::table('transaksi')->where('no_invoice',$no_invoice)->first();
        $transaksi_id=$transaksi->id;

        $getallcart=DB::table('keranjang')->where('user_id',Auth::user()->id)->get();
        foreach($getallcart as $pindah)
        {
            DB::table('detail_transaksi')->insert(
                [
                    'transaksi_id' => $transaksi_id,
                    'user_id' => $pindah->user_id,
                    'produk_id' => $pindah->produk_id,
                    'jumlah' => $pindah->jumlah,
                    'harga_per_produk' => $pindah->harga_per_produk,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );

            $produk=DB::table('produk')->where('id',$pindah->produk_id)->first();
            $stok=$produk->stok - $pindah->jumlah;
            $total_penjualan = $produk->total_penjualan + $pindah->jumlah;

            $updateproduk=DB::table('produk')->where('id',$pindah->produk_id)->update(
                [
                    'stok' => $stok,
                    'total_penjualan' => $total_penjualan,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        
        $getallcart=DB::table('keranjang')->where('user_id',Auth::user()->id)->delete();

        flash('Yay, berhasil!')->success();
        return redirect('/');


    }

    public static function random($length=5)
    {
        $acak='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($acak, 5)), 0, $length);
    }

    public function riwayatpesanan()
    {
        $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();
        $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
        $isikeranjangku=DB::table('keranjang')
        ->join('produk','keranjang.produk_id','=','produk.id')
        ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('user_id', Auth::user()->id)->get();
        $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');
        $pesanan=DB::table('transaksi')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();

        $data=array(
            'kategori' => $kategori,
            'profil' => $profil,
            'totalkeranjangku' => $totalkeranjangku,
            'isikeranjangku' => $isikeranjangku,
            'totalhargakeranjangku' => $totalhargakeranjangku,
            'pesanan' => $pesanan,
        );

        return view('riwayatpesanan')->with($data);
    }

    public function riwayatpesanandetail($id)
    {
        $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();
        $totalkeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('jumlah');
        $isikeranjangku=DB::table('keranjang')
        ->join('produk','keranjang.produk_id','=','produk.id')
        ->select('keranjang.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('user_id', Auth::user()->id)->get();
        $totalhargakeranjangku=DB::table('keranjang')->where('user_id', Auth::user()->id)->sum('harga_per_produk');
        $rs=DB::table('transaksi')->where('user_id',Auth::user()->id)->where('id',$id)->first();
        $detail=DB::table('detail_transaksi')
        ->join('produk','detail_transaksi.produk_id','=','produk.id')
        ->select('detail_transaksi.*','produk.nama_produk','produk.harga','produk.foto_produk')
        ->where('user_id',Auth::user()->id)->where('transaksi_id',$id)->get();

        $data=array(
            'indexPage' => "Riwayat Pesanan",
            'kategori' => $kategori,
            'profil' => $profil,
            'totalkeranjangku' => $totalkeranjangku,
            'isikeranjangku' => $isikeranjangku,
            'totalhargakeranjangku' => $totalhargakeranjangku,
            'rs' => $rs,
            'detail' => $detail,
        );

        return view('detailriwayatpesanan')->with($data);
    }

    public function uploadbuktipembayaran(Request $request)
    {
        $id=$request->input('id');
        $bukti_pembayaran = $request->file('bukti_pembayaran');
        $namafoto = date('Ymd').'-'.time().'.'.$bukti_pembayaran->getClientOriginalExtension();
        $destinationPath = public_path('img/bukti');
        $bukti_pembayaran->move($destinationPath, $namafoto);

        DB::table('transaksi')->where('id',$id)->update(
            [
                'bukti_pembayaran' => $namafoto,
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yay, upload struk berhasil!')->success();
        return redirect()->back();
    }
}
