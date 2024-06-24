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
        return redirect('home');
    });
    Route::get('/home','HomeController@index')->name('home');
    
});

Route::group(['middleware' => ['auth','checkRole:admin,user']], function () {

    Route::get('/profil', 'ProfilController@index')->name('profil.index');
    Route::get('/profil/edit-password', 'ProfilController@editPassword')->name('profil.editPassword');
    Route::post('/profil/update-password', 'ProfilController@updatePassword')->name('profil.updatePassword');
    
    Route::resource('/instansi','InstansiController');
    
    Route::get('/suratmasuk/index','TransaksiSuratController@indexSuratMasuk')->name('suratmasuk.index');
    Route::get('/suratmasuk/download/{id}', 'TransaksiSuratController@tampilSuratMasuk')->name('suratmasuk.download');
    Route::post('/suratmasuk/reply', 'TransaksiSuratController@reply')->name('suratmasuk.reply');
    Route::get('/suratmasuk/delete/{id}', 'TransaksiSuratController@deleteSuratMasuk')->name('suratmasuk.delete');

    Route::get('/suratkeluar/index', 'TransaksiSuratController@indexSuratKeluar')->name('suratkeluar.index');
    Route::get('/suratkeluar/create', 'TransaksiSuratController@createSuratKeluar')->name('suratkeluar.create');
    Route::post('/suratkeluar/tambah', 'TransaksiSuratController@tambahSuratKeluar')->name('suratkeluar.tambah');
    Route::get('/suratkeluar/{id}/tampil', 'TransaksiSuratController@tampilSuratKeluar')->name('suratkeluar.tampil');
    Route::get('/suratkeluar/edit/{id}', 'TransaksiSuratController@editSuratKeluar')->name('suratkeluar.edit');
    Route::put('/suratkeluar/update/{id}', 'TransaksiSuratController@updateSuratKeluar')->name('suratkeluar.update');
    Route::get('/suratkeluar/{id}/delete', 'TransaksiSuratController@deleteSuratKeluar')->name('suratkeluar.delete');

    Route::get('/dokumen/index', 'DokumenController@index')->name('dokumen.index');
    Route::get('/dokumen/create', 'DokumenController@create')->name('dokumen.create');
    Route::post('/dokumen', 'DokumenController@store')->name('dokumen.store');
    Route::get('/dokumen/createtemp', 'DokumenController@createtemp')->name('dokumen.createtemp');
    Route::delete('/dokumen/{dokumen}', 'DokumenController@destroy')->name('dokumen.delete');

    Route::get('/template/index','TemplateController@index');
    Route::get('/pdf-viewer', 'TemplateController@defaultTemplate')->name('pdf-viewer');
    Route::get('/pdf-viewer', 'TemplateController@defaultTemplate')->name('pdf-viewer');
    Route::post('/edit-template', 'DokumenController@editTemplate')->name('edit-template');

});
