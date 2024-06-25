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
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,NULL,id,id_user,' . $userId,
            'nama' => 'required|string|max:255',
        ]);

        // Check for duplicate nama_jabatan
        $duplicate = Jabatan::where('nama_jabatan', $request->nama_jabatan)
                            ->where('id_user', $userId)
                            ->exists();

        if ($duplicate) {
            return redirect()->route('jabatan.create')
                             ->with('error', 'Jabatan dengan nama tersebut sudah ada.');
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
        $userId = Auth::id();
        $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $jabatan->id . ',id,id_user,' . $userId,
            'nama' => 'required|string|max:255',
        ]);

        // Check for duplicate nama_jabatan, excluding the current record
        $duplicate = Jabatan::where('nama_jabatan', $request->nama_jabatan)
                            ->where('id_user', $userId)
                            ->where('id', '!=', $jabatan->id)
                            ->exists();

        if ($duplicate) {
            return redirect()->route('jabatan.edit', $jabatan->id)
                             ->with('error', 'Jabatan dengan nama tersebut sudah ada.');
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
