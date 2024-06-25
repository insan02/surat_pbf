@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                <div class="card-header">Daftar Jabatan</div>

                <div class="card-body">
                    <a href="{{ route('jabatan.create') }}" class="btn btn-primary mb-3">Tambah Jabatan</a>

                    <table class="table table-bordered" id="tabelJabatan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Nama</th>
                                <th>NIM/NIP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jabatans as $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>{{ $jabatan->nama }}</td>
                                <td>{{ $jabatan->nim_nip }}</td>
                                <td>
                                    <a href="{{ route('jabatan.edit', ['jabatan' => $jabatan->id]) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('jabatan.delete', ['jabatan' => $jabatan->id]) }}" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabelJabatan').DataTable();
    });
</script>
@endsection
