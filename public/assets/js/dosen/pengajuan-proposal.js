"use strict"; // Mengaktifkan mode ketat

// Fungsi untuk menambahkan peserta ke tabel
function tambahPeserta() {
    // Mendapatkan elemen tabel dan jumlah baris
    let tabel = document.getElementById('tabelPeserta');
    let jumlahBaris = tabel.rows.length;

    // Mendapatkan nilai input dari form
    let nim = document.getElementById('inputNim').value;
    let nama = document.getElementById('inputNamaPeserta').value;
    let prodi = document.getElementById('inputProgramStudiPeserta').value;
    let peminatan = document.getElementById('inputPeminatanPeserta').value;

    if (nama !== '' && nim !== '' && prodi !== 'Pilih Program Studi...' && peminatan !== 'Pilih Peminatan...') {
        // Membuat baris baru
        let baris = tabel.insertRow(jumlahBaris);

        // Membuat sel baru dan mengisi dengan nilai input
        let selNim = baris.insertCell(0);
        let selNama = baris.insertCell(1);
        let selProdi = baris.insertCell(2);
        let selPeminatan = baris.insertCell(3);
        let selAksi = baris.insertCell(4);

        selNama.innerHTML = nama;
        selNim.innerHTML = nim;
        selProdi.innerHTML = prodi;
        selPeminatan.innerHTML = peminatan;

        // Membuat tombol hapus untuk setiap baris
        let tombolHapus = document.createElement('button');
        tombolHapus.innerHTML = 'Hapus';
        tombolHapus.className = 'btn btn-danger';
        tombolHapus.onclick = function () {
            hapusPeserta(this); // Memanggil fungsi hapusPeserta dengan parameter tombol
        };
        selAksi.appendChild(tombolHapus); // Menambahkan tombol ke sel aksi
        tampilSembunyiTabel();
        clearInputPeserta();
    }
    else{
        alert('Anda harus melengkapi semua data peserta kegiatan');
    }
}

// Fungsi untuk menghapus peserta dari tabel
function hapusPeserta(tombol) {
    // Mendapatkan indeks baris dari tombol
    let indeks = tombol.parentNode.parentNode.rowIndex;
    // Menghapus baris dari tabel
    document.getElementById('tabelPeserta').deleteRow(indeks);
    tampilSembunyiTabel();
}

// Fungsi untuk mengubah pilihan peminatan sesuai dengan program studi
function ubahPeminatan() {
    // Mendapatkan elemen select prodi dan peminatan
    let prodi = document.getElementById('inputProgramStudiPeserta');
    let peminatan = document.getElementById('inputPeminatanPeserta');

    // Menghapus semua pilihan peminatan yang ada
    peminatan.innerHTML = '';

    // Membuat pilihan default
    let optDefault = document.createElement('option');
    optDefault.selected = true;
    peminatan.appendChild(optDefault);

    // Mengecek nilai prodi yang dipilih
    let prodiValue = prodi.value;

    // Membuat array pilihan peminatan berdasarkan prodi
    let peminatanArray = [];
    if (prodiValue === 'Teknik Informatika') {
        peminatanArray = ['Teknologi Web', 'Sistem Kecerdasan'];
        peminatan.innerHTML = peminatanArray[0];
    } else if (prodiValue === 'Sistem Informasi') {
        peminatanArray = ['Enterprise Information System', 'E-Business Technology'];
        peminatan.innerHTML = peminatanArray[0];
    } else if (prodiValue === 'Pilih Program Studi...') {
        peminatan.innerHTML = '';
        peminatanArray = ['Pilih Peminatan...'];
    }

    // Membuat pilihan peminatan dari array menggunakan perulangan for-of
    for (let optValue of peminatanArray) {
        let opt = document.createElement('option');
        opt.value = optValue;
        opt.innerHTML = optValue;
        peminatan.appendChild(opt);
    }
}

function ambilDataTabel() {
    // Mendapatkan elemen tabel
    let tabel = document.getElementById('tabelPeserta');

    // Membuat array untuk menyimpan data
    let dataTabel = [];

    // Melakukan iterasi untuk setiap baris di tabel
    for (let i = 1; i < tabel.rows.length; i++) {
        // Mendapatkan baris saat ini
        let baris = tabel.rows[i];

        // Membuat objek untuk menyimpan data baris
        let dataBaris = {
            nim: baris.cells[0].innerText,
            nama: baris.cells[1].innerText,
            prodi: baris.cells[2].innerText,
            peminatan: baris.cells[3].innerText
        };

        // Menambahkan data baris ke array data tabel
        dataTabel.push(dataBaris);
    }

    // Mengembalikan data tabel
    return dataTabel;
}

function tampilSembunyiTabel() {
    let tabel = document.getElementById('tabelPeserta');
    let jumlahBaris = tabel.rows.length - 1;
    if (jumlahBaris >= 1) {
        tabel.style.display = 'table';
    } else {
        tabel.style.display = 'none';
    }
}

function clearInputPeserta() {
    // Mengosongkan field input
    document.getElementById('inputNim').value = '';
    document.getElementById('inputNamaPeserta').value = '';
    document.getElementById('inputProgramStudiPeserta').value = 'Pilih Program Studi...';
    document.getElementById('inputPeminatanPeserta').value = 'Pilih Peminatan...';
    ubahPeminatan()
}

function clearForm() {
    // Mengosongkan field input
    let jenis_kegiatan = document.getElementById('inputJenisKegiatan');
    jenis_kegiatan.selectedIndex = 0;
    $("#inputJudul").val("");
    $("#inputLokasi").val("");
    $("#inputTanggal").val("");
    $("#inputJam").val("");
    $("#inputMedia").val("");
    $("input[name=inputJudul]").val("");
    $("input[name=inputLokasi]").val("");
    $("input[name=inputTanggal]").val("");
    $("input[name=inputJam]").val("");
    $("input[name=inputMedia]").val("");
    $("input[name=inputNim]").val("");
    $("input[name=inputNamaPeserta]").val("");
    ubahPeminatan();
}

function clearTable() {
    let tabel = document.getElementById('tabelPeserta');

    // Remove all rows except the header
    while (tabel.rows.length > 1) {
        tabel.deleteRow(1);
    }
}

function clearError()
{
    $("#judulError").text("");
    $("#lokasiError").text("");
    $("#tanggalError").text("");
    $("#jamError").text("");
    $("#mediaError").text("");
    $("#jenis_kegiatanError").text("");
}

// Menambahkan event listener untuk select prodi
document
    .getElementById('inputProgramStudiPeserta')
    .addEventListener('change', ubahPeminatan);

// Menambahkan event listener untuk tombol "Tambah Peserta"
document
    .getElementById('addPeserta')
    .addEventListener('click', tambahPeserta);

// Proses Menyimpan Proposal
$('#tombol-ajukan-proposal').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: '/dosen/pengajuan_proposal/tambah_proposal',
        type: 'POST',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'judul': $('#inputJudul').val(),
            'lokasi': $('#inputLokasi').val(),
            'tanggal': $('#inputTanggal').val(),
            'jam': $('#inputJam').val(),
            'media': $('#inputMedia').val(),
            'jenis_kegiatan': $('#inputJenisKegiatan').val(),
            'peserta': ambilDataTabel() // Use the function to get participant data
        },
        success: function(response) {
            alert(response.message);
            clearForm();
            clearTable();
            tampilSembunyiTabel();
            clearError();
        },
        error: function(response){
            console.log(response)
            clearError();
            $("#jenis_kegiatanError").text(response.responseJSON.error.jenis_kegiatan);
            $("#judulError").text(response.responseJSON.error.judul);
            $("#lokasiError").text(response.responseJSON.error.lokasi);
            $("#tanggalError").text(response.responseJSON.error.tanggal);
            $("#jamError").text(response.responseJSON.error.jam);
            $("#mediaError").text(response.responseJSON.error.media);
        }
    });
});


