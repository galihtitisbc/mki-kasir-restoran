$(document).ready(function () {
    $.ajax({
        url: "/dashboard/satuan",
        method: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            let option = "";
            response.data.forEach((element) => {
                option += `<option value="${element}">${element}</option>`;
            });
            $(".satuan-bahan").html(option);
        },
        error: function (error) {
            console.log(error);
        },
    });
    $(".satuan-bahan").select2({
        theme: "classic",
    });
    $("#form-tambah-satuan").submit((e) => {
        e.preventDefault();
        let satuan = $("#satuan").val();
        if (satuan === "") {
            return;
        }
        $.ajax({
            url: "/dashboard/store",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                satuan: satuan,
            },
            success: function (response) {
                $("#tambah-satuan").modal("hide");
                document.getElementById("form-tambah-satuan").reset();
            },
            error: function (error) {
                console.log(error.message);
            },
        });
    });
});
