<div class="d-flex justify-content-center align-items-center">
    @if ($data->status == 'Belum Diproses')
        <a href="#" id="tombol-edit" class="btn btn-warning btn-icon-split mb-4 mr-2" title="Edit"
            data-id="{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#modalEditProposalPKM">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
        </a>
    @endif
    <a href="{{ route('toWord', $data->id) }}" id="tombol-word" class="btn btn-primary btn-icon-split mb-4 mr-2"
        title="Word" data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-file-word" aria-hidden="true"></i>
        </span>
    </a>
    <a href="#" id="tombol-hapus" class="btn btn-danger btn-icon-split mb-4" title="Hapus"
        data-id="{{ $data->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
        </span>
    </a>
</div>
