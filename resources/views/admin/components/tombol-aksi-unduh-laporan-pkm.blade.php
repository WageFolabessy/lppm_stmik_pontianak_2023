<div class="d-flex justify-content-center align-items-center">
    <a href="{{ route('admin.unduhLaporanPKM', $data->id) }}"
        id="tombol-unduh" class="btn btn-primary btn-icon-split mb-4"
        title="Unduh file laporan PKM"
        data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-download" aria-hidden="true"></i>
        </span>
    </a>
</div>
