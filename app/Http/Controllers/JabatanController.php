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
            'nama' => 'required|string|max:255|unique:jabatans,nama,NULL,id,id_user,' . $userId,
        ]);

        // Check for duplicate nama_jabatan or nama
        $duplicateJabatan = Jabatan::where('nama_jabatan', $request->nama_jabatan)
                            ->where('id_user', $userId)
                            ->exists();
        $duplicateNama = Jabatan::where('nama', $request->nama)
                            ->where('id_user', $userId)
                            ->exists();

        if ($duplicateJabatan || $duplicateNama) {
            return redirect()->route('jabatan.create')
                             ->withErrors([
                                 'nama_jabatan' => $duplicateJabatan ? 'Jabatan dengan nama tersebut sudah ada.' : '',
                                 'nama' => $duplicateNama ? 'Nama dengan nama tersebut sudah ada.' : '',
                             ])
                             ->withInput();
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
            'nama' => 'required|string|max:255|unique:jabatans,nama,' . $jabatan->id . ',id,id_user,' . $userId,
        ]);

        // Check for duplicate nama_jabatan or nama, excluding the current record
        $duplicateJabatan = Jabatan::where('nama_jabatan', $request->nama_jabatan)
                            ->where('id_user', $userId)
                            ->where('id', '!=', $jabatan->id)
                            ->exists();
        $duplicateNama = Jabatan::where('nama', $request->nama)
                            ->where('id_user', $userId)
                            ->where('id', '!=', $jabatan->id)
                            ->exists();

        if ($duplicateJabatan || $duplicateNama) {
            return redirect()->route('jabatan.edit', $jabatan->id)
                             ->withErrors([
                                 'nama_jabatan' => $duplicateJabatan ? 'Jabatan dengan nama tersebut sudah ada.' : '',
                                 'nama' => $duplicateNama ? 'Nama dengan nama tersebut sudah ada.' : '',
                             ])
                             ->withInput();
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
