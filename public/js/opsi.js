getOpsi();
function getOpsi() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/dashboard/opsi",
        method: "GET",
        contentType: "application/json",
        success: function (res) {
            let htmlData = "";
            res.data.forEach((e, index) => {
                htmlData += `
                                <div class="custom-control custom-checkbox d-flex justify-content-between my-2">
                                    <input class="custom-control-input" name="opsi_id[]" value="${e.id}" type="checkbox" id="customCheckbox${index}">
                                    <label for="customCheckbox${index}" class="custom-control-label">${e.opsi_name}</label>
                                    <button type="button" class="btn btn-primary detail-opsi" id="${e.slug}" data-toggle="modal"
                                    data-target="#modal-detail-opsi-${e.slug}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </div>
                            `;
            });
            $(".daftar-opsi").html(htmlData);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
$(".daftar-opsi").on("click", ".detail-opsi", function () {
    let htmlData = "";
    let id = $(this).attr("id");
    $("#modal-detail-opsi").modal("show");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/dashboard/opsi/" + id,
        method: "GET",
        contentType: "application/json",
        success: function (res) {
            res.data.detail_opsi.forEach((e) => {
                console.log(e.harga);
                htmlData += `
                  <div class="row d-flex justify-content-center my-3">
                                <div class="col-4">
                                    <label for="opsi">Nama Opsi : </label>
                                    <input type="text" class="form-control" value="${e.opsi}" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="opsi">Harga : </label>
                                    <input type="number" class="form-control" value="${e.harga}" disabled>
                                </div>
                            </div>
                        </div>
   `;
            });
            $(".container-detail-opsi").html(htmlData);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
});

$(document).ready(function () {
    $(".tambah-select").select2({
        theme: "classic",
    });
    $(".select-opsi").select2({
        minimumResultsForSearch: -1,
        placeholder: "Pilih Outlet",
        theme: "classic",
    });
    $("#form-container").on("input", ".form-control", function () {
        var value = $(this).val().trim();
        if (value === "") {
            $(this).addClass("is-invalid");
            $(this).siblings(".error-message").show();
        } else {
            $(this).removeClass("is-invalid");
            $(this).siblings(".error-message").hide();
        }
    });
    $(".tambah-form-opsi").click(function () {
        let formGroup = $(".form-detail-opsi").first().clone();
        formGroup.find("input").val("");
        formGroup.find(".error-message").hide();
        formGroup.find(".form-control").removeClass("is-invalid");
        formGroup.find(".opsi").attr("name", "opsi[]");
        formGroup.find(".harga").attr("name", "harga[]");
        $("#form-container").append(formGroup);
    });
    // kirim data
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
                $("#tambah-modal").modal("hide");
                if (response.code == 201) {
                    getOpsi();
                    Swal.fire({
                        title: "Berhasil",
                        text: `Berhasil Tambah Opsi`,
                        icon: "success",
                    });
                } else {
                    console.log(response.errors);
                    Swal.fire({
                        title: "Gagal Tambah Opsi",
                        text: `${status}`,
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                $("#tambah-modal").modal("hide");
                Swal.fire({
                    title: "Gagal",
                    text: `${error.messsage}`,
                    icon: "error",
                });
                getOpsi();
            },
        });
    });
    $("#tambah-modal").on("hidden.bs.modal", function () {
        $(this).find("input").val(""); // Mengosongkan semua input
        $(this).find("textarea").val(""); // Mengosongkan semua textarea
        $(this).find("select").prop("selectedIndex", 0); // Mereset semua select ke pilihan pertama
    });
});
