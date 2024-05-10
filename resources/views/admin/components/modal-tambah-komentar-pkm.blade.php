<!-- Modal -->
<div class="modal fade" id="modalTambahKomentar" tabindex="-1" aria-labelledby="modalTambahKomentar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTambahKomentarLabel">
                    Komentar
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card p-3 mb-3">
                    <div id="komentarPKMError" class="text-danger"></div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="komentar">Komentar</span>
                        <textarea name="komentar" id="inputKomentarPKM" type="text" class="form-control"
                            placeholder="Masukan komentar" aria-label="Komentar" aria-describedby="Komentar"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-primary" id="tombol_simpan_komentar">
                    Tambah
                </button>
            </div>
        </div>
    </div>
</div>
