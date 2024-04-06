<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SuratmasukController extends Controller
{
    public function index()
    {
        // Mendapatkan peran pengguna
        $role = Auth::user()->role;

        // Mengirimkan peran pengguna ke tampilan
        return view('suratmasuk.index', ['role' => $role]);
    }
}
