@extends('dosen.components.app')
@section('title')
    Profil
@endsection
@section('content')
    <section>
        {{-- Profil Saya --}}
        <div class="card p-3 mb-3">
            <h2 class="card-title text-body-secondary text-center">
                Profil Saya
            </h2>
            <!-- Toast untuk menampilkan pesan  -->
            <div class="toast border-0 text-bg-success" id="toastProfil"
                role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="false" style="max-height: 50px;">
                <div class="d-flex">
                    <div class="toast-body" id="toastProfilBody"></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <div class="card p-3 mb-3">
                <div id="NIDNError" class="text-danger"></div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="NIDN">NIDN</span>
                    <input name="nidn" id="inputNidn" type="text" class="form-control" placeholder="Masukan NIDN"
                        aria-label="NIDN" aria-describedby="NIDN" autocomplete="username" value="{{ $user->nidn }}" />
                </div>
                <div id="namaError" class="text-danger"></div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="Nama">Nama</span>
                    <input name="nama" id="inputNamaDosen" type="text" class="form-control" placeholder="Masukan nama"
                        aria-label="Nama" aria-describedby="Nama" value="{{ $user->nama }}" />
                </div>
                <div id="golonganError" class="text-danger"></div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGolongan">Golongan</label>
                    <select class="form-control form-select" id="inputGolongan">
                        <option value="Asisten Ahli (III/A)"
                            {{ $user->golongan == 'Asisten Ahli (III/A)' ? 'selected' : '' }}>
                            Asisten Ahli (III/A)
                        </option>
                        <option value="Asisten Ahli (III/B)"
                            {{ $user->golongan == 'Asisten Ahli (III/B)' ? 'selected' : '' }}>
                            Asisten Ahli (III/B)
                        </option>
                        <option value="Lektor" {{ $user->golongan == 'Lektor' ? 'selected' : '' }}>
                            Lektor
                        </option>
                        <option value="Lektor Kepala (IV/C)"
                            {{ $user->golongan == 'Lektor Kepala (IV/C)' ? 'selected' : '' }}>
                            Lektor Kepala (IV/C)
                        </option>
                        <option value="dll" {{ $user->golongan == 'dll' ? 'selected' : '' }}>
                            dll
                        </option>
                        <option value="Tidak Ada Golongan"
                            {{ $user->golongan == 'Tidak Ada Golongan' ? 'selected' : '' }}>
                            Tidak Ada Golongan
                        </option>
                    </select>
                </div>
                <div id="prodiError" class="text-danger"></div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputProdi">Program Studi</label>
                    <select class="form-control form-select" id="inputProdi">
                        <option value="Teknik Informatika"
                            {{ $user->program_studi == 'Teknik Informatika' ? 'selected' : '' }}>
                            Teknik Informatika
                        </option>
                        <option value="Sistem Informasi"
                            {{ $user->program_studi == 'Sistem Informasi' ? 'selected' : '' }}>
                            Sistem Informasi
                        </option>
                    </select>
                </div>
            </div>
            <a href="#" id="tombol-update-profil" class="btn btn-primary text-white mb-4" title="Update Profil">
                Ubah Profil
            </a>
        </div>

        {{-- Form Update Password --}}
        <div class="card p-3 mb-3">
            <h2 class="card-title text-body-secondary text-center">
                Ubah Password
            </h2>
            <!-- Toast untuk menampilkan pesan  -->
            <div class="toast border-0" role="alert" aria-live="assertive" id="toastPassword"
                data-bs-autohide="false" aria-atomic="true" style="max-height: 50px;">
                <div class="d-flex">
                    <div class="toast-body" id="toastPasswordBody"></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <div class="card p-3 mb-3">
                <div class="input-group">
                    <span class="input-group-text" id="Password">Password Baru</span>
                    <input name="password" id="inputPasswordBaru" type="password" class="form-control"
                        placeholder="Masukan password baru" aria-label="Password" aria-describedby="Password"
                        autocomplete="new-password" />
                </div>
            </div>
            <a href="#" id="tombol-update-password" class="btn btn-primary text-white mb-4" title="Update Password">
                Update Password
            </a>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('assets/js/dosen/update-profil-dosen.js') }}"></script>
@endsection
