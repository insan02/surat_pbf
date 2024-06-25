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
                    <div class="card-header">Edit Jabatan</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('jabatan.update', $jabatan->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <select class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                                    <option value="Pimpinan" {{ $jabatan->nama_jabatan == 'Pimpinan' ? 'selected' : '' }}>
                                        Pembina/Pimpinan Kampus</option>
                                    <option value="Ketua" {{ $jabatan->nama_jabatan == 'Ketua' ? 'selected' : '' }}>Ketua
                                    </option>
                                    <option value="Sekretaris"
                                        {{ $jabatan->nama_jabatan == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    value="{{ $jabatan->nama }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
