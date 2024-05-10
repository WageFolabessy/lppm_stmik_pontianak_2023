<div class="d-flex justify-content-center align-items-center">
    <a href="#" id="tombol-detail" class="btn btn-primary btn-icon-split mb-4 mr-2"
        data-bs-toggle="modal"
        data-bs-target="#modalDetailProposalPKM"
        title="Detail"
        data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-info-circle"></i>
        </span>
    </a>
    <a type="button" href="#" id="tombol-komentar" class="btn btn-secondary btn-icon-split mb-4 mr-2"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahKomentar"
        title="Komentar"
        data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-comments"></i>
        </span>
    </a>
    <a href="{{ route('admin.toWord', $data->id) }}" id="tombol-word" class="btn btn-primary btn-icon-split mb-4 mr-2"
        title="Word" data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-file-word" aria-hidden="true"></i>
        </span>
    </a>
    <a href="#" id="tombol-hapus" class="btn btn-danger btn-icon-split mb-4"
        title="Hapus" data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
        </span>
    </a>
</div>
