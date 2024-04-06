<?php

namespace App\Http\Controllers;
use App\SuratKeluar;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Instansi;

class SuratKeluarController extends Controller
{
    public function index()
    {
        
        // Mendapatkan peran pengguna
        $role = Auth::user()->role;

        // Mengirimkan peran pengguna ke tampilan
        return view('suratkeluar.index', ['role' => $role]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        
        return view('suratkeluar/create');
    }

    //function untuk tambah
    public function tambah ()
    {
    
       return redirect('/suratkeluar/index')->with("sukses", "Data Surat Keluar Berhasil Ditambahkan");
    }

    public function edit()
    {
        
        return view('suratkeluar/edit');
    }

    
    public function update ()
    {
        return redirect('suratkeluar/index') ->with('sukses','Data Surat Keluar Berhasil Diedit');
    }

    //function untuk hapus
    public function delete()
    {
    
        return redirect('suratkeluar/index') ->with('sukses','Data Surat Keluar Berhasil Dihapus');
    }
}
