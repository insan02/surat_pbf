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
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Surat Masuk</h3>
                <hr />
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
                            <th>Balasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratMasuks as $index => $suratMasuk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $suratMasuk->user->namaorganisasi }}</td>
                            <td>{{ $suratMasuk->kategori->nama }}</td>
                            <td><a href="{{ route('suratmasuk.download', $suratMasuk->id) }}">{{ $suratMasuk->dokumen->nama_dokumen }}</a></td>
                            <td>{{ $suratMasuk->balasan }}</td> <!-- Tampilkan Balasan -->
                            <td>
                                <a class="btn btn-success btn-sm acc-btn" data-toggle="modal" data-target="#replyModal{{ $suratMasuk->id }}">Balas</a>
                                <a href="{{ route('suratmasuk.delete', $suratMasuk->id) }}" class="btn btn-danger btn-sm delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">Hapus</a>
                            </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@foreach($suratMasuks as $suratMasuk)
<!-- Reply Modal -->
<div class="modal fade" id="replyModal{{ $suratMasuk->id }}" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel{{ $suratMasuk->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel{{ $suratMasuk->id }}">Balas Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('suratmasuk.reply') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="suratmasuk_id" value="{{ $suratMasuk->id }}">
                    <div class="form-group">
                        <label for="replyText{{ $suratMasuk->id }}">Balasan</label>
                        <textarea class="form-control" id="replyText{{ $suratMasuk->id }}" name="replyText" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Balasan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
