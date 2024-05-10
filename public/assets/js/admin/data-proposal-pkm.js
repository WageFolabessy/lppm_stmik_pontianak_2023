// Inisialisasi DataTable
$("#tabelDataProposalPKM").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/daftar_proposal_pkm/datatables",
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "nama", name: "nama" },
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

// Tombol untuk melihat detail proposal
$(document).on("click", "#tombol-detail", function (e) {
    let id = $(this).data("id");

    $.ajax({
        url: "/admin/daftar_proposal_pkm/detail/" + id,
        type: "GET",
        success: function (response) {
            // Set data proposal pkm
            const {
                judul,
                lokasi,
                tanggal,
                jam,
                media,
                jenis_kegiatan,
                peserta_kegiatans,
                user,
                status
            } = response;

            // Menampilkan data dosen
            $("#inputNidn").val(user.nidn);
            $("#inputNamaDosen").val(user.nama);
            $("#inputGolongan").val(user.golongan);
            $("#inputProgramStudi").val(user.program_studi);
            // Menampilkan data proposal pkm
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
                });

                // Tampilkan tabel jika ada baris
                tabel.style.display = tabel.rows.length > 1 ? "table" : "none";
            }

            // Terima Proposal Menambahkan event handler
            let tombolTerimaProposal = document.getElementById('tombol_terima_proposal');
            if (status != "Disetujui") {
                $("#tombol_terima_proposal")
                    .off("click")
                    .on("click", function () {
                        terimaProposal(id);
                    });
                    tombolTerimaProposal.classList.remove('d-none');
            } else {
                tombolTerimaProposal.classList.add('d-none');
            }

            // Tolak Proposal Menambahkan event handler
            let tombolTolakProposal = document.getElementById('tombol_tolak_proposal');
            if (status != "Ditolak") {
                $("#tombol_tolak_proposal")
                    .off("click")
                    .on("click", function () {
                        tolakProposal(id);
                    });
                    tombolTolakProposal.classList.remove('d-none');
            } else {
                tombolTolakProposal.classList.add('d-none');
            }
        },
    });
});

// Tombol untuk menambah komentar
$(document).on("click", "#tombol-komentar", function (e) {
    let id = $(this).data("id");
    // Terima Proposal Menambahkan event handler
    $("#tombol_simpan_komentar")
        .off("click")
        .on("click", function () {
            tambahKomentar(id);
        });
});

function tambahKomentar(id) {
    $.ajax({
        url: "/admin/daftar_proposal_pkm/tambah_komentar/" + id,
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            komentar: $("#inputKomentarPKM").val(),
        },
        success: function (response) {
            $("#modalTambahKomentar").modal("hide");
            $("#tabelDataProposalPKM").DataTable().ajax.reload();
            $(".toast-body").text(response.success);
            $(".toast").toast("show");
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function terimaProposal(id) {
    $.ajax({
        url: "/admin/daftar_proposal_pkm/terima_proposal/" + id,
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response.message);
            $("#modalDetailProposalPKM").modal("hide");
            $("#tabelDataProposalPKM").DataTable().ajax.reload();
        },
    });
}
function tolakProposal(id) {
    $.ajax({
        url: "/admin/daftar_proposal_pkm/tolak_proposal/" + id,
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response.message);
            $("#modalDetailProposalPKM").modal("hide");
            $("#tabelDataProposalPKM").DataTable().ajax.reload();
        },
    });
}

// Hapus Proposal PKM
$(document).on("click", "#tombol-hapus", function (e) {
    let id = $(this).data("id");

    if (confirm("Apakah Anda yakin ingin menghapus proposal PKM ini?")) {
        $.ajax({
            url: "/admin/daftar_proposal_pkm/hapus_proposal/" + id,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#toastHapusBody").text(response.success);
                $("#toastHapus").toast("show");
                $("#tabelDataProposalPKM").DataTable().ajax.reload();
            },
        });
    }
});
