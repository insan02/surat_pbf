@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">Tambah Jabatan</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jabatan.store') }}">
                        @csrf  
                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <select class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                                <option value="">Pilih Nama Jabatan</option>
                                <option value="Pimpinan">Pembina/PimpinanKampus</option>
                                <option value="Ketua">Ketua</option>
                                <option value="Sekretaris">Sekretaris</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
