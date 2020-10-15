<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'FrontendController@index')->name('/');
Route::get('/category/{id}', 'FrontendController@listbycategory');
Route::get('/keranjang/add/{id}', 'FrontendController@addkeranjang');
Route::get('/keranjang/delete/{id}', 'FrontendController@deletekeranjang');
Route::get('/keranjang/kurangi/{id}', 'FrontendController@kurangikeranjang');
Route::get('/view/produk/{id}', 'FrontendController@viewproduk');
Route::post('/keranjang/tambah', 'FrontendController@tambahkeranjang')->name('tambah-keranjang');
Route::post('/tulis-penilaian', 'FrontendController@tulispenilaian')->name('tulis-penilaian');
Route::get('/search/produk', 'FrontendController@searchproduk')->name('search-produk');
Route::get('/lihat-keranjang', 'FrontendController@lihatkeranjang')->name('lihat-keranjang');
Route::get('/checkout', 'FrontendController@checkout')->name('checkout');
Route::post('/checkout/post', 'FrontendController@postcheckout')->name('post-checkout');
Route::get('/riwayat-pesanan', 'FrontendController@riwayatpesanan')->name('riwayat-pesanan');
Route::get('/riwayat-pesanan/detail/{id}', 'FrontendController@riwayatpesanandetail');
Route::post('/riwayat-pesanan/uploadbuktipembayaran', 'FrontendController@uploadbuktipembayaran')->name('uploadbuktipembayaran-riwayat-pesanan');




Route::get('/pages/login', 'SistemController@login')->name('pages-login');
Route::post('/login-frontend', 'SistemController@postlogin')->name('login-frontend');
Route::get('/pages/register', 'SistemController@register')->name('pages-register');
Route::post('/register-frontend', 'SistemController@postregister')->name('register-frontend');
Route::post('/logout-frontend', 'SistemController@postlogout')->name('logout-frontend');
Route::get('/pages/profil', 'SistemController@profil')->name('pages-profil');
Route::post('/pages/profil/update', 'SistemController@updateprofil')->name('pages-profil-update');
Route::post('/pages/profil/updatepassword', 'SistemController@updatepasswordprofil')->name('pages-profil-updatepassword');


// BACKEND
Route::get('/login', 'Auth\LoginController@login_form')->name('login');
Route::post('/login-aplikasi', 'Auth\LoginController@login')->name('login-aplikasi');
Route::post('/logout', 'Backend\DashboardController@logout')->name('logout');

Route::group(['namespace'=>'Backend', 'prefix'=>'backend', 'middleware'=>'auth'], function(){
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    
    Route::group(['middleware'=>"is_admin"], function() {

        /*MASTER PELANGGAN*/
		Route::get('pelanggan',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@index'
        ])->name('pelanggan');
        
		Route::get('pelanggan/data',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@data'
        ]);

		Route::get('pelanggan/add',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@add'
        ])->name('add-pelanggan');

		Route::post('pelanggan/tambah',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@tambah'
        ])->name('tambah-pelanggan');

		Route::get('pelanggan/update/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@update'
        ])->name('update-pelanggan');

		Route::post('pelanggan/edit',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@edit'
        ])->name('edit-pelanggan');

		Route::post('pelanggan/edit2',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@edit2'
        ])->name('edit2-pelanggan');

		Route::get('pelanggan/delete/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'PelangganController@delete'
		])->name('delete-pelanggan');




        /*MASTER KATEGORI*/
		Route::get('kategori',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@index'
        ])->name('kategori');
        
		Route::get('kategori/data',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@data'
        ]);

		Route::get('kategori/add',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@add'
        ])->name('add-kategori');

		Route::post('kategori/tambah',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@tambah'
        ])->name('tambah-kategori');

		Route::get('kategori/update/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@update'
        ])->name('update-kategori');

		Route::post('kategori/edit',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@edit'
        ])->name('edit-kategori');

		Route::get('kategori/delete/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'KategoriController@delete'
		])->name('delete-kategori');




        /*MASTER KATEGORI*/
		Route::get('produk',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@index'
        ])->name('produk');
        
		Route::get('produk/data',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@data'
        ]);

		Route::get('produk/add',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@add'
        ])->name('add-produk');

		Route::post('produk/tambah',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@tambah'
        ])->name('tambah-produk');

		Route::get('produk/update/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@update'
        ])->name('update-produk');

		Route::post('produk/edit',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@edit'
        ])->name('edit-produk');

		Route::get('produk/delete/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProdukController@delete'
		])->name('delete-produk');


        /*MASTER BANNER*/
		Route::get('banner',
		[
		  'middleware' => 'auth',
		  'uses' => 'BannerController@index'
		])->name('banner');
		
		Route::post('banner/update-1',
		[
		  'middleware' => 'auth',
		  'uses' => 'BannerController@update1'
        ])->name('update-1-banner');
		
		Route::post('banner/update-2',
		[
		  'middleware' => 'auth',
		  'uses' => 'BannerController@update2'
        ])->name('update-2-banner');
		
		Route::post('banner/update-3',
		[
		  'middleware' => 'auth',
		  'uses' => 'BannerController@update3'
        ])->name('update-3-banner');


        /*MASTER PROFIL TOKO*/
		Route::get('profil-toko',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProfilTokoController@index'
		])->name('profil-toko');
		
		Route::post('profil-toko/update',
		[
		  'middleware' => 'auth',
		  'uses' => 'ProfilTokoController@update'
        ])->name('update-profil-toko');


        /*MASTER LOGO MEREK*/
		Route::get('logo-merek',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@index'
		])->name('logo-merek');
		
		Route::get('logo-merek/data',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@data'
        ])->name('data-logo-merek');
		
		Route::get('logo-merek/add',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@add'
        ])->name('add-logo-merek');
		
		Route::post('logo-merek/tambah',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@tambah'
        ])->name('tambah-logo-merek');
		
		Route::get('logo-merek/delete/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@delete'
        ])->name('delete-logo-merek');


        /*MASTER AKUN*/
		Route::get('akun',
		[
		  'middleware' => 'auth',
		  'uses' => 'AkunController@index'
		])->name('akun');
		
		Route::post('akun/update',
		[
		  'middleware' => 'auth',
		  'uses' => 'AkunController@update'
        ])->name('update-akun');


        /*TRANSAKSI*/
		Route::get('transaksi',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@index'
		])->name('transaksi');
		
		Route::get('transaksi/data',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@data'
        ])->name('transaksi-data');
		Route::get('transaksi/view/{id}',
		[
		  'middleware' => 'auth',
		  'uses' => 'LogoMerekController@view'
        ])->name('view-transaksi');
	}); 
});   

