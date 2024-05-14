@extends('layouts.master')
@section('content')
<style>
    .button-container {
        display: flex;
        justify-content: center;
    }

    .button-container .btn {
        background-color: transparent;
        border: 2px solid #4CAF50; /* Warna garis tombol */
        color: #000; /* Warna teks tombol (hitam) */
        text-decoration: none;
        padding: 0.5rem 1rem;
        margin: 0.5rem;
        border-radius: 0.25rem;
        box-shadow: 0px 0px 5px #888888; /* Bayangan tombol */
        transition: all 0.3s ease;
    }

    .button-container .btn:hover {
        background-color: #4CAF50; /* Warna latar belakang saat hover */
        color: #fff; /* Warna teks saat hover (putih) */
    }
</style>
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Surat Masuk</h3>
                <hr />
            </div>
        </div>
        <div>
            <div class="col text-center">
                <div class="button-container">
                    <!-- Tombol Semua dengan Ikon Plus -->
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="#" role="button">
                        <i class="fas fa-plus"></i> Semua
                    </a>
                    <!-- Tombol Undangan dengan Ikon yang Sesuai -->
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="#" role="button">
                        <i class="fas fa-envelope"></i> Undangan
                    </a>
                    <!-- Tombol Rapat dengan Ikon yang Sesuai -->
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="#" role="button">
                        <i class="fas fa-handshake"></i> Rapat
                    </a>
                </div>
            </div>
        </div>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id='tabelSuratmasuk'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Pengirim</th>
                            <th>Jenis</th>
                            <th>File</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                    <a class="btn btn-success btn-sm acc-btn" href="#"></i>ACC</a>
                                    <a class="btn btn-warning btn-sm reject-btn" href="#"></i>Tolak</a>
                                    <a class="btn btn-danger btn-sm delete-btn" href="#"></i>Hapus</a>  
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</section>
@endsection
