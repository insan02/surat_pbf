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
                                <option value="Pimpinan" {{ old('nama_jabatan') == 'Pimpinan' ? 'selected' : '' }}>Pembina/Pimpinan Kampus</option>
                                <option value="Ketua" {{ old('nama_jabatan') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                <option value="Sekretaris" {{ old('nama_jabatan') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="nim_nip">NIM/NIP</label>
                            <input type="text" id="nim_nip" name="nim_nip" class="form-control" value="{{ old('nim_nip') }}" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
