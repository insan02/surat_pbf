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
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Template</h3>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div>
                        <!-- Tombol Upload dengan Event Listener untuk Tampilkan Popup -->
                        <button class="btn btn-primary btn-sm my-1 mr-sm-1" onclick="showUploadPopup()"><i class="fas fa-plus"></i>Upload</button>
                        <!-- Tombol Form Template dengan Event Listener untuk Tampilkan Popup Form Template -->
                        <button class="btn btn-warning btn-sm my-1 mr-sm-1" id="viewPdfBtn">Default Template</button>
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
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
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

<!-- Popup untuk Upload Dokumen -->
<div id="uploadPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-center align-items-center" style="height: 60px;"> <!-- Tambahkan kelas text-center dan align-items-center di sini -->
                <h4 class="modal-title text-white" style="line-height: 60px; text-align: center;">Upload Template</h4> <!-- Tambahkan kelas text-white dan line-height di sini -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Form Upload Dokumen -->
                <form action="/upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Pilih File:</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Popup untuk Hapus Dokumen -->
<div id="deletePopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Hapus Template</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus template?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteDocument()">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk Menampilkan Popup Upload
    function showUploadPopup() {
        $('#uploadPopup').modal('show');
    }

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

    
    document.getElementById('viewPdfBtn').addEventListener('click', function() {
            window.open('{{ route("pdf-viewer") }}', '_blank');
        });
</script>

@endsection
