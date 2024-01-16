<!-- Modal -->
<div class="modal fade" id="modalDetailProposalPKM" tabindex="-1" aria-labelledby="modalDetailProposalPKMLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailProposalPKMLabel">
                    Detail Proposal PKM
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Profil Pelaksana -->
                <section>
                    <div class="card p-3 mb-3">
                        <h2 class="card-title text-body-secondary">
                            Profil Pelaksanaan Kegiatan
                        </h2>
                        {{-- NIDN --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nidn">NIDN
                                <span class="text-danger">*</span>
                            </span>
                            <input name="nidn" id="inputNidn" type="text" class="form-control"
                                placeholder="Masukan NIDN" aria-label="ndin" aria-describedby="ndin"
                                autocomplete="username" value="" disabled />
                        </div>
                        {{-- Nama --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nama">Nama<span class="text-danger">*</span></span>
                            <input name="nama" id="inputNamaDosen" type="text" class="form-control"
                                placeholder="Masukan nama" aria-label="Nama" aria-describedby="Nama" value=""
                                disabled />
                        </div>
                        {{-- Golongan --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="golongan">Golongan
                                <span class="text-danger">*</span>
                            </span>
                            <input name="golongan" id="inputGolongan" type="text" class="form-control"
                                placeholder="Masukan golongan" aria-label="Golongan" aria-describedby="Golongan"
                                value="" disabled />
                        </div>
                        {{-- Program Studi --}}
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="program_studi">Program Studi
                                <span class="text-danger">*</span>
                            </span>
                            <input name="program_studi" id="inputProgramStudi" type="text" class="form-control"
                                placeholder="Masukan program studi" aria-label="Program studi"
                                aria-describedby="Program studi" value="" disabled />
                        </div>
                    </div>
                </section>
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
                                placeholder="Masukkan judul" aria-label="judul" aria-describedby="judul" disabled />
                        </div>
                        {{-- Lokasi --}}
                        <div id="lokasiError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="lokasi">Lokasi
                                <span class="text-danger">*</span>
                            </span>
                            <input name="lokasi" id="inputLokasi" type="text" class="form-control"
                                placeholder="Masukkan lokasi kegiatan" aria-label="lokasi" aria-describedby="lokasi"
                                disabled />
                        </div>
                        {{-- Tanggal/Hari --}}
                        <div id="tanggalError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="tanggal">Tanggal/Hari
                                <span class="text-danger">*</span>
                            </span>
                            <input type="text" id="inputTanggal" class="form-control"
                                placeholder="Masukkan tanggal/hari kegiatan" aria-label="tanggal"
                                aria-describedby="tanggal" disabled />
                        </div>
                        {{-- Jam --}}
                        <div id="jamError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="jam">Jam
                                <span class="text-danger">*</span>
                            </span>
                            <input type="text" id="inputJam" class="form-control"
                                placeholder="Masukkan jam kegiatan" aria-label="jam" aria-describedby="jam"
                                disabled />
                        </div>
                        <div id="mediaError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="media">Media
                                <span class="text-danger">*</span>
                            </span>
                            <input name="media" id="inputMedia" type="text" class="form-control"
                                placeholder="Masukkan media yang digunakan" aria-label="media"
                                aria-describedby="media" disabled />
                        </div>
                        {{-- Jenis Kegiatan --}}
                        <div id="jenis_kegiatanError" class="text-danger"></div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="media">Jenis Kegiatan
                                <span class="text-danger">*</span>
                            </span>
                            <input name="jenis_kegiatan" id="inputJenisKegiatan" type="text" class="form-control"
                                placeholder="Masukkan jenis_kegiatan yang digunakan" aria-label="jenis_kegiatan"
                                aria-describedby="jenis_kegiatan" disabled />
                        </div>
                    </div>
                </section>
                <!-- Peserta Kegiatan -->
                <section id="pesertaList">
                    <div class="peserta card p-3 mb-3" id="peserta1">
                        <h2 class="card-title text-body-secondary">
                            Peserta Kegiatan
                        </h2>
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
                                </tr>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="tombol_terima_proposal">
                    Terima Proposal
                </button>
                <button type="button" class="btn btn-warning" id="tombol_tolak_proposal">
                    Tolak Proposal
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
