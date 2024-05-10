@extends('admin.components.app')
@section('title')
    Daftar Laporan PKM
@endsection
@section('css')
    {{-- CSS DataTables 1.13.8, Buttons 2.4.2, HTML5 export 2.4.2, Print view 2.4.2, Responsive 2.5.0 --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endsection
@section('content')
    <!-- Toast untuk menampilkan pesan success -->
    <div class="toast border-0 text-bg-success" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="false" style="max-height: 70px; width: 100%;">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
    <!-- Toast untuk menampilkan pesan  hapus-->
    <div class="toast border-0 text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="false" style="max-height: 70px; width: 100%;" id="toastHapus">
        <div class="d-flex">
            <div class="toast-body" id="toastHapusBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table id="tabelDataLaporanPKM" class="table table-striped table-hover table-bordered" style="width: 100%"
            aria-describedby="tabellaporanpkm">
            <caption>
                Daftar Laporan PKM
            </caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>Judul PKM</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script')
    {{-- JavaScript untuk Datatables --}}
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin/data-laporan-pkm.js') }}"></script>
@endsection
