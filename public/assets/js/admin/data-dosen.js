// Inisialisasi DataTable
$("#tabelDosen").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/dosen/datatables",
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "nidn", name: "nidn" },
        { data: "nama", name: "nama" },
        { data: "golongan", name: "golongan" },
        { data: "program_studi", name: "program_studi" },
        { data: "aksi", name: "aksi", orderable: false, searchable: false },
    ],
});

$("#tombol_simpan").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/admin/dosen/tambah_dosen",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            nidn: $("input[name=nidn]").val(),
            nama: $("input[name=nama]").val(),
            golongan: $("#inputGolongan").val(),
            program_studi: $("#inputProdi").val(),
            password: $("input[name=password]").val(),
        },
        success: function (response) {
            $("#modalTambahDosen").modal("hide");

            $(".toast-body").text("Dosen berhasil ditambahkan");
            $(".toast").toast("show");

            clearForm();
            $("#tabelDosen").DataTable().ajax.reload();
        },
        error: function (response) {
            $("#NIDNError").text(response.responseJSON.error.nidn);
            $("#namaError").text(response.responseJSON.error.nama);
            $("#golonganError").text(response.responseJSON.error.golongan);
            $("#prodiError").text(response.responseJSON.error.program_studi);
            $("#passwordError").text(response.responseJSON.error.password);
        },
    });
});

$(document).on("click", "#tombol-hapus", function (e) {
    let id = $(this).data("id");

    if (confirm("Apakah Anda yakin ingin menghapus dosen ini?")) {
        $.ajax({
            url: "/admin/dosen/hapus_dosen/" + id,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $(".toast-body").text("Dosen berhasil dihapus");
                $(".toast").toast("show");
                $("#tabelDosen").DataTable().ajax.reload();
            },
        });
    }
});

function clearForm() {
    $("input[name=nidn]").val("");
    $("input[name=nama]").val("");
    let inputGolongan = document.getElementById("inputGolongan");
    let inputProdi = document.getElementById("inputProdi");
    inputGolongan.selectedIndex = 0;
    inputProdi.selectedIndex = 0;
    $("input[name=password]").val("");

    $("#NIDNError").text("");
    $("#namaError").text("");
    $("#golonganError").text("");
    $("#prodiError").text("");
    $("#passwordError").text("");
}
