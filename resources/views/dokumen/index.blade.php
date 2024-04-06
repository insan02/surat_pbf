@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Dokumen</h3>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div>
                        <!-- Tombol Upload dengan Event Listener untuk Tampilkan Popup -->
                        <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i>
                            Tambah Data</a>
                        <a class="btn btn-warning btn-sm my-1 mr-sm-1" href="createtemp" role="button"><i class="fas fa-file"></i>
                            From Template</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id='tabelSuratmasuk'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Event/Acara</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <!-- Tombol Hapus dengan Event Listener untuk Tampilkan Popup Hapus -->
                            <a class="btn btn-danger btn-sm delete-btn" href="#" onclick="showDeletePopup()"><i class="fas fa-trash-alt"></i>Hapus</a>
                        </td>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<!-- Popup untuk Hapus Dokumen -->
<div id="deletePopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Hapus Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus dokumen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteDocument()">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>

    // Fungsi untuk Menampilkan Popup Hapus
    function showDeletePopup() {
        $('#deletePopup').modal('show');
    }

    // Fungsi untuk Menghapus Dokumen
    function deleteDocument() {
        // Tambahkan logika untuk menghapus dokumen di sini
        // Setelah dokumen dihapus, Anda dapat menutup popup
        $('#deletePopup').modal('hide');
    }
</script>

@endsection
