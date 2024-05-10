@extends('dosen.components.app')
@section('title')
    Proposal Saya
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endsection
@section('content')
    {{-- Modal Edit Proposal PKM --}}
    @include('dosen.components.modal-edit-proposal-pkm')

    <!-- Toast untuk menampilkan pesan  -->
    <div class="toast border-0 text-bg-success" id="toastProposalSaya" role="alert"
        aria-live="assertive" aria-atomic="true"
        data-bs-autohide="false" style="max-height: 70px; max-width: 100%">
        <div class="d-flex">
            <div class="toast-body" id="toastProposalSayaBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table id="tabelProposalSaya" class="table table-striped table-hover table-bordered" style="width: 100%"
            aria-describedby="tabelproposal">
            <caption>
                Proposal PKM
            </caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Lokasi</th>
                    <th>Hari/Tanggal</th>
                    <th>Jam</th>
                    <th>Media</th>
                    <th>Jenis Kegiatan</th>
                    <th>Peserta Kegiatan</th>
                    <th>Status</th>
                    <th>Komentar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dosen/proposal-saya.js') }}"></script>
@endsection
