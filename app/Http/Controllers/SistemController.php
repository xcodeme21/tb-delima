<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth, Validator, DB, Mail;

class SistemController extends Controller
{
    use AuthenticatesUsers;
 
    public function register()
    {
		$kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();

        $data=array(
            'kategori' => $kategori,
            'profil' => $profil,
        );

        return view('register')->with($data);
    }
 
    public function login()
    {
        $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();

        $data=array(
            'kategori' => $kategori,
            'profil' => $profil,
        );

        return view('login')->with($data);
    }
	
    public function postlogin(Request $request)
    {
        $rules = [
            'email'   => 'required',
            'password'=> 'required',
        ];
         $messages = [
            'required'=>"Form tidak boleh kosong",
        ];
        // $remember = $request->input('remember');
        $validation = Validator::make($request->all(),$rules, $messages);
        if($validation->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        } 

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'role'=>"USER"])) {  
            flash('Yeay login berhasil!')->success();
			return redirect('/');
        }else{ 
            flash('Login gagal. Silahkan cek kembali isian Anda!')->error();
			return redirect()->back(); 
        }

    }
	
    public function postlogout()
    {
        Auth::logout();
        flash('Yeay logout berhasil!')->success();
        return redirect('/');
    }

    public function postregister(Request $request)
    {
        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $address=$request->input('address');
        $password=$request->input('password');
        $repeatpassword=$request->input('repeatpassword');


        if($password != $repeatpassword)
        {
            flash('Password tidak sama!')->error();
            return redirect()->back();
        }

        $cekemail=DB::table('users')->where('email',$email)->first();
        if($cekemail != null)
        {
            flash('Email telah terdaftar!')->error();
            return redirect()->back();   
        }

        $cekphone=DB::table('users')->where('phone',$phone)->first();
        if($cekphone != null)
        {
            flash('Nomor HP telah terdaftar!')->error();
            return redirect()->back();   
        }
        
        $photo = $request->file('photo');
        $namafoto = date('Ymd').'-'.time().'.'.$photo->getClientOriginalExtension();
        $destinationPath = public_path('img/pelanggan');
        $photo->move($destinationPath, $namafoto);

        DB::table('users')->insert(
            [
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'phone' => $phone,
                'address' => $address,
                'role' => "USER",
                'photo' => $namafoto,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $profiltoko=DB::table('profil')->where('id',1)->first();

        $details = [
            'alamat_toko' => $profiltoko->alamat,
            'telepon_toko' => $profiltoko->telepon,
            'email_toko' => $profiltoko->email,
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        \Mail::to($email)->send(new \App\Mail\RegisteredMail($details));

        flash('Yeay berhasil! Silahkan login...')->success();
        return redirect()->route('pages-login');
    }
 
    public function profil()
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

        return view('profil')->with($data);
    }

    public function updatepasswordprofil(Request $request)
    {
        $password=$request->input('password');
        $repeatpassword=$request->input('repeatpassword');

        if($password != $repeatpassword)
        {
            flash('Password tidak sama!')->error();
            return redirect()->back();
        }
        else
        {
            DB::table('users')->where('id',Auth::user()->id)->update(
                [
                    'password' => bcrypt($password),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );

            flash('Yeay ganti password berhasil!')->success();
            return redirect()->back();
        }

    }

    public function updateprofil(Request $request)
    {
        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $address=$request->input('address');
        
        $photo = $request->file('photo');
        if($photo == null)
        {
            DB::table('users')->where('id',Auth::user()->id)->update(
                [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $namafoto = date('Ymd').'-'.time().'.'.$photo->getClientOriginalExtension();
            $destinationPath = public_path('img/pelanggan');
            $photo->move($destinationPath, $namafoto);

            DB::table('users')->where('id',Auth::user()->id)->update(
                [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'photo' => $namafoto,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay, update profil berhasil!')->success();
        return redirect()->back();
    }

    public function resetpassword()
    {
        $kategori=DB::table('kategori')->orderBy('nama_kategori','ASC')->get();
        $profil=DB::table('profil')->where('id',1)->first();

        $data=array(
            'kategori' => $kategori,
            'profil' => $profil,
        );

        return view('reset-password')->with($data);
    }

    public function postresetpassword(Request $request)
    {
        $email=$request->input('email');

        $cekemail=DB::table('users')->where('email',$email)->first();

        if($cekemail == null)
        {
            flash('Email tidak diketahui!')->error();
            return redirect()->back();
        }
        else
        {
            $random=$this->random();
            DB::table('users')->where('email',$email)->update(
                [
                    'password' => bcrypt($random),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );

            $profiltoko=DB::table('profil')->where('id',1)->first();

            $details = [
                'alamat_toko' => $profiltoko->alamat,
                'telepon_toko' => $profiltoko->telepon,
                'email_toko' => $profiltoko->email,
                'name' => $cekemail->name,
                'email' => $cekemail->email,
                'password' => $random,
            ];

            \Mail::to($cekemail->email)->send(new \App\Mail\ResetPasswordMail($details));

            flash('Password baru telah dikirim. Silahkan cek email, kemudian login!')->success();
            return redirect()->route('pages-login');
        }
    }

    public static function random($length=5)
    {
        $acak='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($acak, 5)), 0, $length);
    }
}
