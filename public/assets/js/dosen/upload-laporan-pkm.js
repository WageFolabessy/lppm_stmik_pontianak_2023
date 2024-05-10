// Inisialisasi DataTable
$("#tabelLaporanSaya").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/dosen/laproran_pkm/datatables",
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "judul_pkm", name: "judul_pkm" },
        { data: "aksi", name: "aksi", orderable: false, searchable: false },
    ],
});

// Konfigurasi Dropzone
Dropzone.autoDiscover = false;
let dropzone = new Dropzone("#dropzone", {
    url: "/dosen/laporan_pkm/unggah_laporan",
    autoProcessQueue: false,
    dictDefaultMessage: "Seret atau pilih file untuk mengunggah laporan PKM Anda",
    acceptedFiles: ".ppt,.pptx,.pdf,.xls,.xlsx,.csv",
    addRemoveLinks: true,
    paramName: "file_laporan"
});

dropzone.on("addedfile", function(file) {
    console.log("Nama file: " + file.name);
});

dropzone.on("removedfile", function(file) {
    console.log("File dihapus: " + file.name);
});

// Tambahkan event "sending" untuk Dropzone
dropzone.on("sending", function(file, xhr, formData) {
    // Ambil judul PKM dari form
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let judulPKM = document.getElementById("judul_pkm").value;

    formData.append("_token", csrfToken);
    formData.append("judul_pkm", judulPKM);
});

// Tambahkan event "success" untuk Dropzone
dropzone.on("success", function(file, response) {
    // Refresh DataTable setelah unggah berhasil
    $("#tabelLaporanSaya").DataTable().ajax.reload();
    $("#modalUploadLaporanPKM").modal("hide");
    $("#toastLaporanSayaBody").text(response.message);
    $("#toastLaporanSaya").toast("show");

    $("#judul_pkm").val("");
    dropzone.removeAllFiles();
    $("#judulError").text("");
    $("#fileLaporanError").text("");
});

// Tambahkan event "error" untuk Dropzone
dropzone.on("error", function(file, response) {
    // Hapus file dari antrian Dropzone
    this.removeFile(file);
    console.log(response)
    document.getElementById("judulError").innerText = response.error.judul_pkm;
    document.getElementById("fileLaporanError").innerText = response.error.file_laporan;
});

// Proses unggah file saat tombol "Upload" diklik
document.getElementById("tombol_upload").addEventListener("click", function() {
    dropzone.processQueue();
});

// Hapus Laporan PKM
$(document).on("click", "#tombol-hapus", function (e) {
    let id = $(this).data("id");

    if (confirm("Apakah Anda yakin ingin menghapus laporan PKM ini?")) {
        $.ajax({
            url: "/dosen/laporan_pkm/hapus_laporan/" + id,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#tabelLaporanSaya").DataTable().ajax.reload();
            },
        });
    }
});