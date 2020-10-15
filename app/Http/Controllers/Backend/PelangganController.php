<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class PelangganController extends Controller
{
    protected $base = 'backend.pelanggan.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Pelanggan",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$users = DB::table('users')->where('role',"USER");  
			
		return Datatables::of($users)
			->editColumn('id', '{{$id}}')			    			    
			->editColumn('name', '{{$name}}')  	    			    
			->editColumn('email', '{{$email}}')  	    			    
			->editColumn('phone', '{{$phone}}')  	    			    
			->editColumn('address', '{{$address}}')   	
			->editColumn('photo', function ($users) {
                $url= asset('public/img/pelanggan/'.$users->photo);
                return '<img src="'.$url.'" height="150" width="100" />';
            })
			->editColumn('action', function ($users) {
                if($users->role == "ADMIN")
                {
                    return '<button class="btn btn-sm  btn-default btn-disabled">Not allowed</button>';
                }
                else
                {
                    return '<a href="pelanggan/update/'.$users->id.'" class="btn btn-sm  btn-warning"><i class="fa fa-fw fa-edit"></i> Edit</a> 
                    <a href="pelanggan/delete/'.$users->id.'" class="btn btn-sm  btn-danger"><i class="fa fa-fw fa-trash"></i> Hapus</a>'
                    ; 
                }
			})
            ->escapeColumns([])
			->make(true);
	}  

    public function add()
    {   
        $data = array(  
            'indexPage' => "Pelanggan",
        );

        return view($this->base.'add')->with($data);
    }

    public function tambah(Request $request)
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

        flash('Yeay berhasil!')->success();
        return redirect()->route('pelanggan');
    }
    

    public function update($id)
    {   
        $rs=DB::table('users')->where('id',$id)->first();

        $data = array(  
            'indexPage' => "Pelanggan",
            'rs' => $rs
        );

        return view($this->base.'update')->with($data);
    }

    public function edit(Request $request)
    {
        $id=$request->input('id');
        $name=$request->input('name');
        $email=$request->input('email');
        $phone=$request->input('phone');
        $address=$request->input('address');
        
        $photo = $request->file('photo');

        if($photo == null)
        {
            DB::table('users')->where('id',$id)->update(
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

            DB::table('users')->where('id',$id)->update(
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

        flash('Yeay berhasil!')->success();
        return redirect()->route('pelanggan');
    }

    public function edit2(Request $request)
    {
        $id=$request->input('id2');
        $password=$request->input('password');
        $repeatpassword=$request->input('repeatpassword');


        if($password != $repeatpassword)
        {
            flash('Password tidak sama!')->error();
            return redirect()->back();
        }

        DB::table('users')->where('id',$id)->update(
            [
                'password' => bcrypt($password),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        return redirect()->route('pelanggan');
    }


    public function delete($id)
    {
        DB::table('users')->where('id',$id)->delete();
        flash('Yeay berhasil!')->success();
        return redirect()->route('pelanggan');
    }
		
}