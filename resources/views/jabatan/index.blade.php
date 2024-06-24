@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Jabatan</div>

                <div class="card-body">
                    <a href="{{ route('jabatan.create') }}" class="btn btn-primary mb-3">Tambah Jabatan</a>

                    <table class="table table-bordered" id="tabelJabatan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @foreach($jabatans as $jabatan)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{ $jabatan->id }}</td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>{{ $jabatan->nama }}</td>
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
