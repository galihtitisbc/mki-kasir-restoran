$(document).ready(function () {
    $(".satuan-bahan").select2({
        theme: "classic",
    });
    $("#form-tambah-satuan").submit((e) => {
        e.preventDefault();
        let outletId = $("#outlet_id_satuan").val();
        let satuan = $("#satuan").val();
        if (outletId === "") {
            return;
        }
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
                outlet_id: outletId,
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
    $('input[name="outlet_id[]"]').on("change", function () {
        let checkedValues = [];
        $('input[name="outlet_id[]"]:checked').each(function () {
            checkedValues.push($(this).val());
        });
        console.log(checkedValues);
        $.ajax({
            url: "/dashboard/satuan",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                outlet_id: checkedValues,
            },
            success: function (response) {
                let option = "";
                response.data.forEach((element) => {
                    option += `<option value="${element.id}">${element.satuan}</option>`;
                });
                $(".satuan-bahan").html(option);
            },
        });
    });
});
