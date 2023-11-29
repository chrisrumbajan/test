$(document).ready(function() {

    navbar_dynamic('Manajemen User');
    navbar_dynamic('Grup');

    // submit form tambah user
    $("#form-tambah-grup").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL TAMBAH GRUP", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL TAMBAH GRUP", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol edit grup
    $(".btn-edit").on("click", function() {
        $("#edit-id").val($(this).data("id"));
        $("#edit-nama").val($(this).data("nama"));
    });

    // submit form edit grup
    $("#form-edit-grup").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL EDIT DATA GRUP", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL EDIT DATA GRUP", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol hapus grup
    $(".btn-hapus").on("click", function() {
        $("#hapus-id").val($(this).data("id"));
        $("#hapus-nama").text($(this).data("nama"));
    });

    // submit form hapus grup
    $("#form-hapus-grup").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL HAPUS GRUP", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL HAPUS GRUP", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol hapus modul
    $(".btn-hapus-modul").on("click", function() {
        let grup = $(this).data("grup");
        let modul = $(this).data("modul");

        $.post("{{ base_url() }}manajemen_user/hapus_grup_modul", { grup: grup, modul: modul }, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL HAPUS MODUL", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL HAPUS MODUL", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol tambah modul
    $(".btn-tambah-modul").on("click", function() {
        $("#tambah-modul-grup-id").val($(this).data("id"));
        $("#tambah-modul-grup-nama").val($(this).data("nama"));
    });

    // submit form tambah modul
    $("#form-tambah-modul").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL TAMBAH MODUL", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL TAMBAH MODUL", jqXHR.status + " - " + jqXHR.textStatus);
            });
    });

    // klik tombol hapus modul
    $(".btn-hapus-prodi").on("click", function() {
        let grup = $(this).data("grup");
        let prodi = $(this).data("prodi");

        $.post("{{ base_url() }}manajemen_user/hapus_grup_prodi", { grup: grup, prodi: prodi }, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL HAPUS PRODI", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL HAPUS PRODI", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol tambah prodi
    $(".btn-tambah-prodi").on("click", function() {
        console.log($(this).data());
        $("#tambah-prodi-grup-id").val($(this).data("id"));
        $("#tambah-prodi-grup-nama").val($(this).data("nama"));
    });

    // submit form tambah prodi
    $("#form-tambah-prodi").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL TAMBAH PRODI", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL TAMBAH PRODI", jqXHR.status + " - " + jqXHR.textStatus);
            });
    });

});