<!-- Modal -->
<div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="modalTambahDosenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTambahDosenLabel">
                    Tambah Dosen Baru
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card p-3 mb-3">
                    <div id="namaError" class="text-danger"></div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="Nama">Nama</span>
                        <input name="nama" id="inputNamaDosen" type="text" class="form-control"
                            placeholder="Masukan nama" aria-label="Nama" aria-describedby="Nama" />
                    </div>
                    <div id="golonganError" class="text-danger"></div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGolongan">Golongan</label>
                        <select class="form-control form-select" id="inputGolongan">
                            <option disabled selected>Pilih Golongan...</option>
                            <option value="Asisten Ahli (III/A)">Asisten Ahli (III/A)</option>
                            <option value="Asisten Ahli (III/B)">Asisten Ahli (III/B)</option>
                            <option value="Lektor">Lektor</option>
                            <option value="Lektor Kepala (IV/C)">Lektor Kepala (IV/C)</option>
                            <option value="dll">dll</option>
                            <option value="Tidak Ada Golongan">Tidak Ada Golongan</option>
                        </select>
                    </div>
                    <div id="prodiError" class="text-danger"></div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputProdi">Program Studi</label>
                        <select class="form-control form-select" id="inputProdi">
                            <option disabled selected>Pilih Program Studi...</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>
                    </div>
                    <div id="NIDNError" class="text-danger"></div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="NIDN">NIDN</span>
                        <input name="nidn" id="inputNidn" type="text" class="form-control"
                            placeholder="Masukan NIDN" aria-label="NIDN" aria-describedby="NIDN"
                            autocomplete="username" />
                    </div>
                    <div id="passwordError" class="text-danger"></div>
                    <div class="input-group">
                        <span class="input-group-text" id="Password">Password</span>
                        <input name="password" id="inputPassword" type="password" class="form-control"
                            placeholder="Masukan password" aria-label="Password" aria-describedby="Password"
                            autocomplete="new-password" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-primary" id="tombol_simpan">
                    Tambah
                </button>
            </div>
        </div>
    </div>
</div>
