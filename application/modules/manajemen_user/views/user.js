$(document).ready(function() {

    navbar_dynamic('Manajemen User');
    navbar_dynamic('User');

    // submit form tambah user
    $("#form-tambah-user").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL TAMBAH USER", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL TAMBAH USER", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol edit user
    $(".btn-edit").on("click", function() {
        $("#edit-id").val($(this).data("id"));
        $("#edit-username").val($(this).data("username"));
        $("#edit-deskripsi").val($(this).data("deskripsi"));
        $("#edit-grup")
            .val($(this).data("grup"))
            .trigger("change");
    });

    // submit form edit user
    $("#form-edit-user").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL EDIT DATA USER", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL EDIT DATA USER", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

    // klik tombol hapus user
    $(".btn-hapus").on("click", function() {
        $("#hapus-id").val($(this).data("id"));
        $("#hapus-username").text($(this).data("username"));
    });

    // submit form hapus user
    $("#form-hapus-user").on("submit", function(e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let form_data = $(this).serialize();

        $.post(url, form_data, "", "json")
            .done(function(result) {
                if (result.status == true) {
                    location.reload();
                } else {
                    toast_fail("GAGAL HAPUS USER", result.message);
                }
            })
            .fail(function(jqXHR, textStatus) {
                toast_fail("GAGAL HAPUS USER", jqXHR.status + " - " + jqXHR.statusText);
            });
    });

});