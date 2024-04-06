<?php

namespace App\Http\Controllers;

class DokumenController extends Controller
{
    public function index()
    {
        return view('dokumen.index');
    }

    public function create()
    {
        return view('dokumen.create');
    }
    
    public function createtemp()
    {
        return view('dokumen.createtemp');
    }
}
