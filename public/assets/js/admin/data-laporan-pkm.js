// Inisialisasi DataTable
$("#tabelDataLaporanPKM").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/daftar_laporan_pkm/datatables",
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "nama", name: "nama" },
        { data: "judul_pkm", name: "judul_pkm" },
        { data: "aksi", name: "aksi", orderable: false, searchable: false },
    ],
});