@extends('layouts.master')

@section('content')
<style>
    .button-container {
        display: flex;
        justify-content: center;
    }

    .button-container .btn {
        background-color: transparent;
        border: 2px solid #4CAF50;
        color: #000;
        text-decoration: none;
        padding: 0.5rem 1rem;
        margin: 0.5rem;
        border-radius: 0.25rem;
        box-shadow: 0px 0px 5px #888888;
        transition: all 0.3s ease;
    }

    .button-container .btn:hover {
        background-color: #4CAF50;
        color: #fff;
    }
    .balasan-column {
        white-space: pre-wrap;
        word-wrap: break-word;
        max-width: 300px; /* Adjust this value as needed */
    }
</style>

<section class="content card" style="padding: 10px;">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Surat Keluar</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="{{ route('suratkeluar.create') }}" role="button">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <br>
            </div>
        </div>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id="tabelSuratkeluar">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Penerima</th>
                            <th>Kategori</th>
                            <th>File</th>
                            <th>Keterangan</th>
                            <th>Balasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiSurats as $index => $transaksiSurat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaksiSurat->penerimaUser}}</td>
                            <td>{{ $transaksiSurat->kategori->nama }}</td>
                            <td><a href="{{ route('suratkeluar.tampil', $transaksiSurat->id) }}">{{ $transaksiSurat->dokumen->nama_dokumen }}</a></td>
                            <td>{{ $transaksiSurat->keterangan }}</td>
                            <td class="balasan-column">{{ $transaksiSurat->balasan }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm edit-btn"
                                    href="{{ route('suratkeluar.edit', $transaksiSurat->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm delete-btn"
                                    href="{{ route('suratkeluar.delete', $transaksiSurat->id) }}"
                                    onclick="showDeletePopup()">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
