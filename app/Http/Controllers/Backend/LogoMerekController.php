<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class LogoMerekController extends Controller
{
    protected $base = 'backend.logo-merek.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $data = array(  
            'indexPage' => "Logo Merek",
        );

        return view($this->base.'index')->with($data);
    }
	
	public function data()
	{
		$logo_merek = DB::table('logo_merek');  
			
		return Datatables::of($logo_merek)
			->editColumn('id', '{{$id}}')			    	
			->editColumn('logo_merek', function ($logo_merek) {
                $url= asset('public/img/logo-merek/'.$logo_merek->logo_merek);
                return '<img src="'.$url.'" height="150" width="150" />';
            })
			->editColumn('action', function ($logo_merek) {
                return '<a href="logo-merek/delete/'.$logo_merek->id.'" class="btn btn-sm  btn-danger"><i class="fa fa-fw fa-trash"></i> Hapus</a>'; 
			})
            ->escapeColumns([])
			->make(true);
    }  

    public function add()
    {   
        $data = array(  
            'indexPage' => "Logo Merek",
        );

        return view($this->base.'add')->with($data);
    }
    
    public function tambah(Request $request)
    {   
        $logo_merek = $request->file('logo_merek');
		$namafoto = date('Ymd').'-'.time().'.'.$logo_merek->getClientOriginalExtension();
		$destinationPath = public_path('img/logo-merek');
        $logo_merek->move($destinationPath, $namafoto);

        DB::table('logo_merek')->insert(
            [
                'logo_merek' => $namafoto,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        flash('Yeay berhasil!')->success();
        return redirect()->route('logo-merek');
    }

    public function delete($id)
    {
        DB::table('logo_merek')->where('id',$id)->delete();
        flash('Yeay berhasil!')->success();
        return redirect()->route('logo-merek');
    }
		
}