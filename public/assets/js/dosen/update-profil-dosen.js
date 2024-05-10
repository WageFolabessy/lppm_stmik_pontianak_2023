$("#tombol-update-profil").click(function (e) {
    e.preventDefault();

    $.ajax({
        url: "/dosen/profil/updateProfil",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            nidn: $("input[name=nidn]").val(),
            nama: $("input[name=nama]").val(),
            golongan: $("#inputGolongan").val(),
            program_studi: $("#inputProdi").val(),
        },
        success: function (response) {
            $("#toastProfilBody").text("Profil berhasil diupdate");
            $("#toastProfil").toast("show");
            
            $("#NIDNError").text("");
            $("#namaError").text("");
            $("#golonganError").text("");
            $("#prodiError").text("");
        },
        error: function (response) {
            console.log(response);
            $("#NIDNError").text(response.responseJSON.error.nidn);
            $("#namaError").text(response.responseJSON.error.nama);
            $("#golonganError").text(response.responseJSON.error.golongan);
            $("#prodiError").text(response.responseJSON.error.program_studi);
        },
    });
});

$("#tombol-update-password").click(function (e) {
    e.preventDefault();

    $.ajax({
        url: "/dosen/profil/updatePassword",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            password: $("#inputPasswordBaru").val(),
        },
        success: function (response) {
            $("#inputPasswordBaru").val("");
            $("#toastPassword").addClass("text-bg-success"); // Tambahkan gaya sukses
            $("#toastPasswordBody").text("Password berhasil diupdate");
            $("#toastPassword").toast("show");
        },
        error: function (response) {
            $("#toastPassword").addClass("text-bg-danger"); // Tambahkan gaya error
            $("#toastPasswordBody").text(response.responseJSON.error.password);
            $("#toastPassword").toast("show");
        },
    });
});
