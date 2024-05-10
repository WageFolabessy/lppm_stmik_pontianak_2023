// Inisialisasi DataTable
$("#tabelProposalSaya").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/dosen/proposal_saya/datatables",
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "judul", name: "judul" },
        { data: "lokasi", name: "lokasi" },
        { data: "tanggal", name: "tanggal" },
        { data: "jam", name: "jam" },
        { data: "media", name: "media" },
        { data: "jenis_kegiatan", name: "jenis_kegiatan" },
        { data: "peserta_kegiatan", name: "peserta_kegiatan" },
        { data: "status", name: "status" },
        { data: "komentar", name: "komentar" },
        { data: "aksi", name: "aksi", orderable: false, searchable: false },
    ],
});

// Edit Proposal PKM Saya
$(document).on("click", "#tombol-edit", function (e) {
    let id = $(this).data("id");

    $.ajax({
        url: "/dosen/proposal_saya/edit_proposal_pkm/" + id,
        type: "GET",
        success: function (response) {
            // Set data proposal
            const {
                judul,
                lokasi,
                tanggal,
                jam,
                media,
                jenis_kegiatan,
                peserta_kegiatans,
            } = response;

            $("#inputJudul").val(judul);
            $("#inputLokasi").val(lokasi);
            $("#inputTanggal").val(tanggal);
            $("#inputJam").val(jam);
            $("#inputMedia").val(media);
            $("#inputJenisKegiatan").val(jenis_kegiatan);

            // Set data peserta kegiatan
            if (peserta_kegiatans !== null) {
                let tabel = document.getElementById("tabelPeserta");

                // Hapus baris tabel yang ada
                for (let i = tabel.rows.length - 1; i >= 1; i--) {
                    tabel.deleteRow(i);
                }

                // Tambahkan baris baru
                peserta_kegiatans.forEach((peserta) => {
                    let baris = tabel.insertRow();
                    [
                        "nim",
                        "nama_peserta",
                        "program_studi",
                        "peminatan",
                    ].forEach((item, index) => {
                        baris.insertCell(index).innerHTML = peserta[item];
                    });

                    // Membuat tombol hapus untuk setiap baris
                    let tombolHapus = document.createElement("button");
                    tombolHapus.innerHTML = "Hapus";
                    tombolHapus.className = "btn btn-danger";
                    tombolHapus.onclick = function () {
                        hapusPeserta(this); // Memanggil fungsi hapusPeserta dengan parameter tombol
                    };
                    baris.insertCell(4).appendChild(tombolHapus); // Menambahkan tombol ke sel aksi
                });

                // Tampilkan tabel jika ada baris
                tabel.style.display = tabel.rows.length > 1 ? "table" : "none";
            }

            // Menambahkan event handler
            $("#tombol_simpan")
                .off("click")
                .on("click", function () {
                    updateProposalSaya(id);
                });
        },
    });
});

function updateProposalSaya(id) {
    let data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        judul: $("#inputJudul").val(),
        lokasi: $("#inputLokasi").val(),
        tanggal: $("#inputTanggal").val(),
        jam: $("#inputJam").val(),
        media: $("#inputMedia").val(),
        jenis_kegiatan: $("#inputJenisKegiatan").val(),
        peserta: ambilDataTabel(),
    };

    $.ajax({
        url: "/dosen/proposal_saya/update_proposal_pkm/" + id,
        type: "POST",
        data: data,
        success: function (response) {
            $("#modalEditProposalPKM").modal("hide");
            $("#tabelProposalSaya").DataTable().ajax.reload();
            $("#toastProposalSayaBody").text(response.message);
            $("#toastProposalSaya").toast("show");
        },
        error: function (error) {
            console.log(error);
            clearError();
            $("#judulError").text(error.responseJSON.error.judul);
            $("#lokasiError").text(error.responseJSON.error.lokasi);
            $("#tanggalError").text(error.responseJSON.error.tanggal);
            $("#jamError").text(error.responseJSON.error.jam);
            $("#mediaError").text(error.responseJSON.error.media);
            $("#jenis_kegiatanError").text(error.responseJSON.error.jenis_kegiatan);
        },
    });
}

// Hapus Proposal PKM Saya
$(document).on("click", "#tombol-hapus", function (e) {
    let id = $(this).data("id");

    if (confirm("Apakah Anda yakin ingin menghapus proposal PKM ini?")) {
        $.ajax({
            url: "/dosen/proposal_saya/hapus_proposal/" + id,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $(".toast-body").text(response.success);
                $(".toast").toast("show");
                $("#tabelProposalSaya").DataTable().ajax.reload();
            },
        });
    }
});

// Fungsi untuk menambahkan peserta ke tabel
function tambahPeserta() {
    // Mendapatkan elemen tabel dan jumlah baris
    let tabel = document.getElementById("tabelPeserta");
    let jumlahBaris = tabel.rows.length;

    // Mendapatkan nilai input dari form
    let nim = document.getElementById("inputNim").value;
    let nama = document.getElementById("inputNamaPeserta").value;
    let prodi = document.getElementById("inputProgramStudiPeserta").value;
    let peminatan = document.getElementById("inputPeminatanPeserta").value;

    if (
        nim !== "" &&
        nama !== "" &&
        prodi !== "Pilih Program Studi..." &&
        peminatan !== "Pilih Peminatan..."
    ) {
        // Membuat baris baru
        let baris = tabel.insertRow(jumlahBaris);

        // Membuat sel baru dan mengisi dengan nilai input
        let selNim = baris.insertCell(0);
        let selNama = baris.insertCell(1);
        let selProdi = baris.insertCell(2);
        let selPeminatan = baris.insertCell(3);
        let selAksi = baris.insertCell(4);

        selNim.innerHTML = nim;
        selNama.innerHTML = nama;
        selProdi.innerHTML = prodi;
        selPeminatan.innerHTML = peminatan;

        // Membuat tombol hapus untuk setiap baris
        let tombolHapus = document.createElement("button");
        tombolHapus.innerHTML = "Hapus";
        tombolHapus.className = "btn btn-danger";
        tombolHapus.onclick = function () {
            hapusPeserta(this); // Memanggil fungsi hapusPeserta dengan parameter tombol
        };
        selAksi.appendChild(tombolHapus); // Menambahkan tombol ke sel aksi
        tampilSembunyiTabel();
        clearInputPeserta();

        let data = ambilDataTabel();
        console.log(data);
    } else {
        alert("Anda harus melengkapi semua data peserta kegiatan");
    }
}

// Fungsi untuk menghapus peserta dari tabel
function hapusPeserta(tombol) {
    // Mendapatkan indeks baris dari tombol
    let indeks = tombol.parentNode.parentNode.rowIndex;
    // Menghapus baris dari tabel
    document.getElementById("tabelPeserta").deleteRow(indeks);
    tampilSembunyiTabel();
    let data = ambilDataTabel();
    console.log(data);
}

// Fungsi untuk mengubah pilihan peminatan sesuai dengan program studi
function ubahPeminatan() {
    // Mendapatkan elemen select prodi dan peminatan
    let prodi = document.getElementById("inputProgramStudiPeserta");
    let peminatan = document.getElementById("inputPeminatanPeserta");

    // Menghapus semua pilihan peminatan yang ada
    peminatan.innerHTML = "";

    // Membuat pilihan default
    let optDefault = document.createElement("option");
    optDefault.selected = true;
    peminatan.appendChild(optDefault);

    // Mengecek nilai prodi yang dipilih
    let prodiValue = prodi.value;

    // Membuat array pilihan peminatan berdasarkan prodi
    let peminatanArray = [];
    if (prodiValue === "Teknik Informatika") {
        peminatanArray = ["Teknologi Web", "Sistem Kecerdasan"];
        peminatan.innerHTML = peminatanArray[0];
    } else if (prodiValue === "Sistem Informasi") {
        peminatanArray = [
            "Enterprise Information System",
            "E-Business Technology",
        ];
        peminatan.innerHTML = peminatanArray[0];
    } else if (prodiValue === "Pilih Program Studi...") {
        peminatan.innerHTML = "";
        peminatanArray = ["Pilih Peminatan..."];
    }

    // Membuat pilihan peminatan dari array menggunakan perulangan for-of
    for (let optValue of peminatanArray) {
        let opt = document.createElement("option");
        opt.value = optValue;
        opt.innerHTML = optValue;
        peminatan.appendChild(opt);
    }
}

// Fungsi untuk mengambil peserta kegiatan dari tabel
function ambilDataTabel() {
    // Mendapatkan elemen tabel
    let tabel = document.getElementById("tabelPeserta");

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
            peminatan: baris.cells[3].innerText,
        };

        // Menambahkan data baris ke array data tabel
        dataTabel.push(dataBaris);
    }

    // Mengembalikan data tabel
    return dataTabel;
}

// Fungsi untuk tampil atau sembunyikan tabel
function tampilSembunyiTabel() {
    let tabel = document.getElementById("tabelPeserta");
    let jumlahBaris = tabel.rows.length - 1;
    if (jumlahBaris >= 1) {
        tabel.style.display = "table";
    } else {
        tabel.style.display = "none";
    }
}

// Fungsi untuk menghapus input peserta kegiatan
function clearInputPeserta() {
    // Mengosongkan field input
    document.getElementById("inputNim").value = "";
    document.getElementById("inputNamaPeserta").value = "";
    document.getElementById("inputProgramStudiPeserta").value =
        "Pilih Program Studi...";
    document.getElementById("inputPeminatanPeserta").value =
        "Pilih Peminatan...";
    ubahPeminatan();
}

// Fungsi untuk menghapus input form
function clearForm() {
    // Mengosongkan field input
    let jenis_kegiatan = document.getElementById("inputJenisKegiatan");
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

// Fungsi untuk menghapus tabel peserta
function clearTable() {
    let tabel = document.getElementById("tabelPeserta");

    // Remove all rows except the header
    while (tabel.rows.length > 1) {
        tabel.deleteRow(1);
    }
}

// Fungsi untuk menghapus error
function clearError() {
    $("#judulError").text("");
    $("#lokasiError").text("");
    $("#tanggalError").text("");
    $("#jamError").text("");
    $("#mediaError").text("");
    $("#jenis_kegiatanError").text("");
}

// Menambahkan event listener untuk select prodi
document
    .getElementById("inputProgramStudiPeserta")
    .addEventListener("change", ubahPeminatan);

// Menambahkan event listener untuk tombol "Tambah Peserta"
document.getElementById("addPeserta").addEventListener("click", tambahPeserta);
