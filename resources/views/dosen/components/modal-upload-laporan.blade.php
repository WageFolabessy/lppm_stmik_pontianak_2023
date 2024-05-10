<!-- Modal -->
<div class="modal fade" id="modalUploadLaporanPKM" tabindex="-1" aria-labelledby="modalUploadLaporanPKMLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalUploadLaporanPKMLabel">
                    Unggah Laporan PKM
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Urutan laporan PKM -->
                <section class="mb-3">
                    <div class="card p-3 mb-3">
                        <h2 class="card-title text-body-secondary">
                            Urutan Laporan PKM
                        </h2>
                        <ol class="list-group list-group-flush">
                            <li class="list-group-item">1. Cover</li>
                            <li class="list-group-item">2. Surat Keterangan Laporan Pengabdian Kepada Masyarakat</li>
                            <li class="list-group-item">3. Surat Tugas</li>
                            <li class="list-group-item">4. Surat Keterangan PkM</li>
                            <li class="list-group-item">5. Sertifikat</li>
                            <li class="list-group-item">6. Flayer</li>
                            <li class="list-group-item">7. Materi PkM</li>
                            <li class="list-group-item">8. Daftar Absensi</li>
                            <li class="list-group-item">9. Bukti Dokumentasi (Foto)</li>
                        </ol>
                    </div>
                </section>
                <!-- Upload laporan PKM -->
                <section class="mb-3">
                    <div class="card p-3 mb-3">
                        <h2 class="card-title text-body-secondary">
                            Ungggah Laporan PKM
                        </h2>
                        <div id="judulError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="judul">Judul PKM
                                <span class="text-danger">*</span>
                            </span>
                            <input name="judul_pkm" id="judul_pkm" type="text" class="form-control"
                                placeholder="Masukan judul PKM" aria-label="Judul PKM" aria-describedby="Judul PKM" />
                        </div>
                        <div id="fileLaporanError" class="text-danger"></div>
                        <div class="dropzone" id="dropzone"></div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-primary" id="tombol_upload">
                    Unggah
                </button>
            </div>
        </div>
    </div>
</div>
