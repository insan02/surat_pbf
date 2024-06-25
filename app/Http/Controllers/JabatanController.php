<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $jabatans = Jabatan::where('id_user', $userId)->get();
        return view('jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        $users = User::all();
        return view('jabatan.create', compact('users'));
    }

    public function store(Request $request)
{
    $userId = Auth::id();
    $request->validate([
        'nama_jabatan' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
    ]);

    // Check for duplicate combination of nama_jabatan and nama
    $duplicate = Jabatan::where('nama_jabatan', $request->nama_jabatan)
                        ->where('nama', $request->nama)
                        ->exists();

    if ($duplicate) {
        return redirect()->route('jabatan.create')
                         ->with('error', 'Kombinasi nama jabatan dan nama tersebut sudah ada.');
    }

    Jabatan::create([
        'nama_jabatan' => $request->nama_jabatan,
        'nama' => $request->nama,
        'id_user' => $userId,
    ]);

    return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
}


    public function edit(Jabatan $jabatan)
    {
        $users = User::all();
        return view('jabatan.edit', compact('jabatan', 'users'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        // Check for duplicate combination of nama_jabatan and nama, excluding the current record
        $duplicate = Jabatan::where('nama_jabatan', $request->nama_jabatan)
                            ->where('nama', $request->nama)
                            ->where('id', '!=', $jabatan->id)
                            ->exists();

        if ($duplicate) {
            return redirect()->route('jabatan.edit', $jabatan->id)
                             ->with('error', 'Kombinasi nama jabatan dan nama tersebut sudah ada.');
        }

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'nama' => $request->nama,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diupdate.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
