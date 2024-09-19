$(document).ready(function () {
    let slug = "";
    $("#form-container").on("input", ".form-control", function () {
        var value = $(this).val();
        if (value === "") {
            $(this).addClass("is-invalid");
            $(this).siblings(".error-message").show();
        } else {
            $(this).removeClass("is-invalid");
            $(this).siblings(".error-message").hide();
        }
    });
    //tambah data
    $(".tambah-form-opsi").click(function () {
        let formGroup = $(".form-detail-opsi").first().clone();
        formGroup.find("input").val("");
        formGroup.find(".error-message").hide();
        formGroup.find(".form-control").removeClass("is-invalid");
        formGroup.find(".opsi").attr("name", "opsi[]");
        formGroup.find(".harga").attr("name", "harga[]");
        $("#form-container").append(formGroup);
    });
    $("#simpan-opsi").click(function () {
        let data = [];
        let valid = true;
        let grupOpsi = $("#opsi_name").val().trim();
        let outletId = $("[name='outlet_id']").val();

        $(".form-detail-opsi").each(function () {
            let namaOpsi = $(this).find(".opsi").val().trim();
            let harga = $(this).find(".harga").val().trim();
            if (namaOpsi === "") {
                $(this).find(".opsi").addClass("is-invalid");
                $(this).find(".opsi").siblings(".error-message").show();
                valid = false;
                return;
            } else {
                $(this).find(".opsi").removeClass("is-invalid");
                $(this).find(".opsi").siblings(".error-message").hide();
            }
            if (harga === "") {
                $(this).find(".harga").addClass("is-invalid");
                $(this).find(".harga").siblings(".error-message").show();
                valid = false;
                return;
            } else {
                $(this).find(".harga").removeClass("is-invalid");
                $(this).find(".harga").siblings(".error-message").hide();
            }
            if (namaOpsi !== "" && harga !== "") {
                data.push({
                    opsi: namaOpsi,
                    harga: harga,
                });
            }
        });
        data.push({ grupOpsi: grupOpsi, outletId: outletId });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/dashboard/opsi",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(data),
            success: function (response) {
                console.log(response);

                if (response.code == 201 || response.code == 200) {
                    $("#tambah-modal").modal("hide");
                    Swal.fire({
                        title: "Berhasil Tambah Opsi",
                        text: `${response.message}`,
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload(true);
                    }, 1000);
                } else if (response.code == 400) {
                    Swal.fire({
                        title: "Gagal Tambah Opsi",
                        text: `Pastikan Semua Input Sudah Terisi`,
                        icon: "error",
                    });
                } else {
                    Swal.fire({
                        title: "Gagal Tambah Opsi",
                        text: `Pastikan Semua Input Sudah Terisi`,
                        icon: "error",
                    });
                }
            },
        });
    });
    // end tambah data
    //update
    $(".edit-btn").on("click", function () {
        slug = $(this).attr("data-id");
        $("#update-modal").modal("show");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/dashboard/opsi/" + slug,
            method: "GET",
            contentType: "application/json",
            success: function (response) {
                $(".opsi_name_update").val(response.data.opsi_name);
                $(".select-opsi-update option").each(function () {
                    if ($(this).val() == response.data.outlet_id) {
                        $(this).attr("selected", true);
                    }
                });
                let htmlData = "";
                response.data.detail_opsi.forEach((element) => {
                    htmlData += `
                         <div class="row d-flex justify-content-center my-3">
                                    <div class="col-4">
                                        <label for="opsi">Nama Opsi : </label>
                                        <input type="text" class="form-control opsi-update" name="opsi[]" value="${element.opsi}" >
                                    </div>
                                    <div class="col-4">
                                        <label for="opsi">Harga : </label>
                                        <input type="number" class="form-control harga-update" name="harga[]" value="${element.harga}">
                                    </div>
                                    <div class="col-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-danger btn-delete-element"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                    `;
                });
                $(".form-detail-opsi-update").html(htmlData);
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });
    $("#update-modal").on("hidden.bs.modal", function () {
        $(".form-detail-opsi-update").each(function () {
            $(this).find("input").val("");
            $(this).find(".error-message").hide();
            $(this).find(".form-control").removeClass("is-invalid");
        });
    });
    $(document).on("click", ".btn-delete-element", function () {
        $(this).closest(".row").remove();
    });
    $(".tambah-form-opsi-update").click(function () {
        let formGroup = $(".form-detail-opsi-update").first().clone();
        formGroup.find("input").val("");
        formGroup.find(".error-message").hide();
        formGroup.find(".form-control").removeClass("is-invalid");
        formGroup.find(".opsi-update").attr("name", "opsi[]");
        formGroup.find(".harga-update").attr("name", "harga[]");
        $("#form-container-update").append(formGroup);
    });
    $("#simpan-opsi-update").click(function () {
        let data = [];
        let valid = true;
        let grupOpsi = $(".opsi_name_update").val();
        let outletId = $("[name='outlet_id_update']").val();
        $(".form-detail-opsi").each(function () {
            let namaOpsi = $(this).find(".opsi-update").val();
            let harga = $(this).find(".harga-update").val();
            if (namaOpsi === "") {
                $(this).find(".opsi-update").addClass("is-invalid");
                $(this).find(".opsi-update").siblings(".error-message").show();
                valid = false;
                return;
            } else {
                $(this).find(".opsi-update").removeClass("is-invalid");
                $(this).find(".opsi-update").siblings(".error-message").hide();
            }
            if (harga === "") {
                $(this).find(".harga-update").addClass("is-invalid");
                $(this).find(".harga-update").siblings(".error-message").show();
                valid = false;
                return;
            } else {
                $(this).find(".harga-update").removeClass("is-invalid");
                $(this).find(".harga-update").siblings(".error-message").hide();
            }
            if (namaOpsi !== "" && harga !== "") {
                data.push({
                    opsi: namaOpsi,
                    harga: harga,
                });
            }
        });
        data.push({ grupOpsi: grupOpsi, outletId: outletId });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/dashboard/opsi/update/" + slug,
            method: "PUT",
            contentType: "application/json",
            data: JSON.stringify(data),
            success: function (response) {
                console.log(response);
                $("#update-modal").modal("hide");
                Swal.fire({
                    title: "Berhasil Update Opsi",
                    text: `${response.message}`,
                    icon: "success",
                });
                setTimeout(() => {
                    location.reload(true);
                }, 1000);
            },
            error: function (xhr, status, error) {
                $("#update-modal").modal("hide");
                getOpsi();
                Swal.fire({
                    title: "Gagal Tambah Opsi",
                    text: `${error.messsage}`,
                    icon: "error",
                });
            },
        });
    });
    //delete
    $(".form-delete").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Apakah Anda yakin ?",
            text: "Anda Tidak Bisa Mengembalikan Data ini",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                setTimeout(() => {
                    $(this)[0].submit();
                }, 1500);
            }
        });
    });
});
