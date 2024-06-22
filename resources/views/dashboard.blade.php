@extends('layouts.master')

@section('content')
<style>
    .content {
        background-color: #f4f6f9;
        padding: 20px;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .small-box {
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        color: #fff;
        text-align: center;
    }
    .small-box .icon {
        font-size: 50px;
        margin-top: 10px;
    }
    .bg-light-blue {
        background-color: #007bff !important;
    }
    .bg-light-green {
        background-color: #28a745 !important;
    }
    .bg-light-yellow {
        background-color: #ffc107 !important;
    }
</style>

<section class="content card" style="padding: 20px;">
    <div class="box">
        <div class="row">
            <div class="col">
                <center>
                    <h3 class="font-weight-bold">SELAMAT DATANG DI SISFO SURAT MENYURAT BEM HIMA SE-UNAND</h3>
                    <hr />
                </center>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="card-body">
                <div class="filter-container p-0 row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-light-blue">
                            <div class="inner">
                                <h3>{{ DB::table('transaksi_surat')->count() }}</h3>
                                <p>Transaksi Surat</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-light-green">
                            <div class="inner">
                                <h3>{{ DB::table('kategori')->count() }}</h3>
                                <p>Kategori Surat</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->role == 'admin')
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-light-yellow">
                            <div class="inner">
                                <h3>{{ DB::table('users')->count() }}</h3>
                                <p>Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-users"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row">
                <div class="col-md-6">
                    <canvas id="transaksiSuratChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="kategoriChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
