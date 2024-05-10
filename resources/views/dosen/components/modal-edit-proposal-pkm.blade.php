<!-- Modal -->
<div class="modal fade" id="modalEditProposalPKM" tabindex="-1" aria-labelledby="modalEditProposalPKMLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditProposalPKMLabel">
                    Edit Proposal
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Rencana Kegiatan -->
                <section class="mb-3">
                    <div class="card p-3 mb-3">
                        <h2 class="card-title text-body-secondary">
                            Rencana Kegiatan
                        </h2>
                        {{-- Judul --}}
                        <div id="judulError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="judul">Judul
                                <span class="text-danger">*</span>
                            </span>
                            <input name="judul" id="inputJudul" type="text" class="form-control"
                                placeholder="Masukkan judul" aria-label="judul" aria-describedby="judul" />
                        </div>
                        {{-- Lokasi --}}
                        <div id="lokasiError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="lokasi">Lokasi
                                <span class="text-danger">*</span>
                            </span>
                            <input name="lokasi" id="inputLokasi" type="text" class="form-control"
                                placeholder="Masukkan lokasi kegiatan" aria-label="lokasi" aria-describedby="lokasi" />
                        </div>
                        {{-- Tanggal/Hari --}}
                        <div id="tanggalError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="tanggal">Hari/Tanggal
                                <span class="text-danger">*</span>
                            </span>
                            <input type="text" id="inputTanggal" class="form-control"
                                placeholder="Masukkan tanggal/hari kegiatan" aria-label="tanggal"
                                aria-describedby="tanggal" />
                        </div>
                        {{-- Jam --}}
                        <div id="jamError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="jam">Jam
                                <span class="text-danger">*</span>
                            </span>
                            <input type="text" id="inputJam" class="form-control"
                                placeholder="Masukkan jam kegiatan" aria-label="jam" aria-describedby="jam" />
                        </div>
                        <div id="mediaError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="media">Media
                                <span class="text-danger">*</span>
                            </span>
                            <input name="media" id="inputMedia" type="text" class="form-control"
                                placeholder="Masukkan media yang digunakan" aria-label="media"
                                aria-describedby="media" />
                        </div>
                        <div id="jenis_kegiatanError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputJenisKegiatan">Jenis Kegiatan
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-select" id="inputJenisKegiatan">
                                <option disabled selected>Pilih Jenis Kegiatan...</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Pelatihan">Pelatihan</option>
                            </select>
                        </div>
                    </div>
                </section>
                <!-- Peserta Kegiatan -->
                <section id="pesertaList">
                    <div class="peserta card p-3 mb-3" id="peserta1">
                        <h2 class="card-title text-body-secondary">
                            Peserta Kegiatan
                        </h2>
                        {{-- Nim --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nim">NIM</span>
                            <input name="nim" id="inputNim" type="text" class="form-control"
                                placeholder="Masukkan NIM" aria-label="nim" aria-describedby="nim" />
                        </div>
                        {{-- Nama --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nama">Nama</span>
                            <input name="nama_peserta" id="inputNamaPeserta" type="text" class="form-control"
                                placeholder="Masukkan nama" aria-label="nama" aria-describedby="nama" />
                        </div>
                        {{-- Program Studi --}}
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputProgramStudiPeserta">Program
                                Studi</label>
                            <select class="form-control form-select prodi" id="inputProgramStudiPeserta">
                                <option selected>Pilih Program Studi...</option>
                                <option value="Teknik Informatika">
                                    Teknik Informatika
                                </option>
                                <option value="Sistem Informasi">
                                    Sistem Informasi
                                </option>
                            </select>
                        </div>
                        {{-- Peminatan --}}
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputPeminatanPeserta">Peminatan</label>
                            <select class="form-control form-select perminatan" id="inputPeminatanPeserta">
                                <option selected>Pilih Peminatan...</option>
                            </select>
                        </div>
                        <button class="btn btn-primary mb-3" id="addPeserta" type="button">
                            Tambah Peserta
                        </button>
                        <!-- Menambahkan elemen tabel dengan id "tabelPeserta" -->
                        <div class="table-responsive">
                            <table id="tabelPeserta"
                                class="table table-striped table-hover table-bordered text-center"
                                style="display: none">
                                <caption>
                                    Peserta Kegiatan
                                </caption>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Peminatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-primary" id="tombol_simpan">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
