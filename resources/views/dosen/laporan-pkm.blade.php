@extends('dosen.components.app')
@section('title')
    Laporan PKM
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')
    {{-- Modal Upload Laporan PKM --}}
    @include('dosen.components.modal-upload-laporan')
    <button href="#" class="btn btn-primary btn-icon-split mb-4" data-bs-toggle="modal"
        data-bs-target="#modalUploadLaporanPKM">
        <span class="icon text-white-50">
            <i class="fas fa-upload"></i>
        </span>
        <span class="text">Unggah Laporan PKM</span>
    </button>

    <!-- Toast untuk menampilkan pesan  -->
    <div class="toast border-0 text-bg-success" id="toastLaporanSaya" role="alert"
        aria-live="assertive" aria-atomic="true"
        data-bs-autohide="false" style="max-height: 70px; max-width: 100%">
        <div class="d-flex">
            <div class="toast-body" id="toastLaporanSayaBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table id="tabelLaporanSaya" class="table table-striped table-hover table-bordered" style="width: 100%"
            aria-describedby="tabellaporan">
            <caption>
                Laporan PKM
            </caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="{{ asset('assets/js/dosen/upload-laporan-pkm.js') }}"></script>
@endsection
