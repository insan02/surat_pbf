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

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin']], function () {
    Route::get('/', function () {
        return redirect('/dashboard'); // Mengarahkan pengguna admin langsung ke dashboard
    });
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('/pengguna','PenggunaController');

    Route::get('/kategori', 'KategoriController@index');
    Route::get('/kategori/index','KategoriController@index');
    Route::get('/kategori/create','KategoriController@create');
    Route::post('/kategori/tambah','KategoriController@tambah');
    Route::get('/kategori/{id}/edit','KategoriController@edit');
    Route::post('/kategori/{id}/update','KategoriController@update');
    Route::get('/kategori/{id}/delete','KategoriController@delete');
});

Route::group(['middleware' => ['auth','checkRole:user']], function () {
    Route::get('/', function () {
        return redirect('home'); // Mengarahkan pengguna admin langsung ke dashboard
    });
    Route::get('/home','HomeController@index')->name('home');
    
});

Route::group(['middleware' => ['auth','checkRole:admin,user']], function () {

    // Rute untuk menampilkan halaman profil
    Route::get('/profil', 'ProfilController@index')->name('profil');

    // Rute untuk menampilkan form edit password
    Route::get('/profil/edit-password', 'ProfilController@editPassword')->name('edit-password');

    // Rute untuk memproses update password
    Route::post('/profil/update-password', 'ProfilController@updatePassword')->name('update-password');
    Route::resource('/instansi','InstansiController');


    Route::get('/suratmasuk','SuratMasukController@index');
    Route::get('/suratmasuk/index','SuratMasukController@index');

    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index','SuratKeluarController@index');
    Route::get('/suratkeluar/create','SuratKeluarController@create');
    Route::post('/suratkeluar/tambah','SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil','SuratKeluarController@tampil');
    Route::get('viewAlldownloadfile','SuratKeluarController@downfunc');
    Route::get('/suratkeluar/{id}/edit','SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update','SuratKeluarController@update');
    Route::get('/suratkeluar/{id}/delete','SuratKeluarController@delete');

    // Rute untuk menampilkan halaman index dokumen
    Route::get('/dokumen/index', 'DokumenController@index')->name('dokumen.index');

    // Rute untuk menampilkan form tambah dokumen
    Route::get('/dokumen/create', 'DokumenController@create')->name('dokumen.create');

    // Rute untuk memproses penambahan dokumen
    Route::post('/dokumen', 'DokumenController@store')->name('dokumen.store');


    Route::get('/dokumen/createtemp', 'DokumenController@createtemp')->name('dokumen.createtemp');
    Route::delete('/dokumen/{dokumen}', 'DokumenController@destroy')->name('dokumen.delete');

    Route::get('/template/index','TemplateController@index');

    Route::get('/pdf-viewer', 'TemplateController@defaultTemplate')->name('pdf-viewer');

    // untuk open file example template
    Route::get('/pdf-viewer', 'TemplateController@defaultTemplate')->name('pdf-viewer');
    Route::post('/edit-template', 'DokumenController@editTemplate')->name('edit-template');

});
