$(document).ready(function () {
    let outlet = "";
    $.ajax({
        url: "/dashboard/superadmin/outlet",
        type: "GET",
        success: function (res) {
            let data = Array.from(Object.values(res.sales));
            var areaChartData = {
                labels: [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember",
                ],
                datasets: [
                    {
                        label: "Penjualan",
                        backgroundColor: "rgb(51, 153, 255)",
                        borderColor: "rgb(51, 153, 255)",
                        pointRadius: false,
                        pointColor: "rgb(51, 153, 255)",
                        pointStrokeColor: "#3399ff",
                        pointHighlightFill: "#3399ff",
                        pointHighlightStroke: "rgb(51, 153, 255)",
                        data: data,
                    },
                ],
            };
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChartData = $.extend(true, {}, areaChartData);
            var temp1 = areaChartData.datasets[0];
            barChartData.datasets[0] = temp1;

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
            };

            new Chart(barChartCanvas, {
                type: "bar",
                data: barChartData,
                options: barChartOptions,
            });
        },
    });
});
