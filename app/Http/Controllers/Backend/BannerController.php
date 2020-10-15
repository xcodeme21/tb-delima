<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;

class BannerController extends Controller
{
    protected $base = 'backend.banner.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }  

    public function index()
    {   
        $rs=DB::table('banner')->where('id',1)->first();

        $data = array(  
            'indexPage' => "Banner",
            'rs' => $rs
        );

        return view($this->base.'index')->with($data);
    }

    public function update1(Request $request)
    {
        $banner_1_judul=$request->input('banner_1_judul');
        $banner_1_deskripsi=$request->input('banner_1_deskripsi');
        
        $banner_1_img = $request->file('banner_1_img');

        if($banner_1_img == null)
        {
            DB::table('banner')->where('id',1)->update(
                [
                    'banner_1_judul' => $banner_1_judul,
                    'banner_1_deskripsi' => $banner_1_deskripsi,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $namafoto = date('Ymd').'-'.time().'.'.$banner_1_img->getClientOriginalExtension();
            $destinationPath = public_path('img/banner');
            $banner_1_img->move($destinationPath, $namafoto);

            DB::table('banner')->where('id',1)->update(
                [
                    'banner_1_judul' => $banner_1_judul,
                    'banner_1_deskripsi' => $banner_1_deskripsi,
                    'banner_1_img' => $namafoto,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay berhasil!')->success();
        return redirect()->route('banner');
    }

    public function update2(Request $request)
    {
        $banner_2_judul=$request->input('banner_2_judul');
        $banner_2_deskripsi=$request->input('banner_2_deskripsi');
        
        $banner_2_img = $request->file('banner_2_img');

        if($banner_2_img == null)
        {
            DB::table('banner')->where('id',1)->update(
                [
                    'banner_2_judul' => $banner_2_judul,
                    'banner_2_deskripsi' => $banner_2_deskripsi,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $namafoto = date('Ymd').'-'.time().'.'.$banner_2_img->getClientOriginalExtension();
            $destinationPath = public_path('img/banner');
            $banner_2_img->move($destinationPath, $namafoto);

            DB::table('banner')->where('id',1)->update(
                [
                    'banner_2_judul' => $banner_2_judul,
                    'banner_2_deskripsi' => $banner_2_deskripsi,
                    'banner_2_img' => $namafoto,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay berhasil!')->success();
        return redirect()->route('banner');
    }

    public function update3(Request $request)
    {
        $banner_3_judul=$request->input('banner_3_judul');
        $banner_3_deskripsi=$request->input('banner_3_deskripsi');
        
        $banner_3_img = $request->file('banner_3_img');

        if($banner_3_img == null)
        {
            DB::table('banner')->where('id',1)->update(
                [
                    'banner_3_judul' => $banner_3_judul,
                    'banner_3_deskripsi' => $banner_3_deskripsi,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        else
        {
            $namafoto = date('Ymd').'-'.time().'.'.$banner_3_img->getClientOriginalExtension();
            $destinationPath = public_path('img/banner');
            $banner_3_img->move($destinationPath, $namafoto);

            DB::table('banner')->where('id',1)->update(
                [
                    'banner_3_judul' => $banner_3_judul,
                    'banner_3_deskripsi' => $banner_3_deskripsi,
                    'banner_3_img' => $namafoto,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        flash('Yeay berhasil!')->success();
        return redirect()->route('banner');
    }

		
}