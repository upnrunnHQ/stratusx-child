(function($) {
    "use strict";

    var chartJS = {};

    var performanceChartContainer = document.getElementById("CashChart"),
        performanceChartData = JSON.parse(
            performanceChartContainer.dataset.chartjs
        );

    var performanceChart = new Chart(performanceChartContainer, {
        type: "bar",
        data: {
            labels: performanceChartData.labels,
            datasets: performanceChartData.datasets
        },
        options: {
            legend: {
                position: "bottom",
                labels: {
                    boxWidth: 10
                }
            }
        }
    });

    $("#performance-1").on("change", ".g_year_drp", function() {
        var portfolioId = $(this).attr("data-portfolio-id");
        var filterYear = this.value;
        var $loading = $("#performance-1").find(".g_loading");

        if (filterYear) {
            $loading.show();

            if (typeof chartJS[filterYear] !== "undefined") {
                $("#performance-1 .tot_perc").html(
                    chartJS[filterYear].data.performanceWidget
                );
                performanceChart.data.labels =
                    chartJS[filterYear].data.chartJS.labels;
                performanceChart.data.datasets =
                    chartJS[filterYear].data.chartJS.datasets;
                performanceChart.update();

                $loading.hide();
            } else {
                var formData = {
                    action: "get_cash_performance_by_year",
                    portfolio_id: portfolioId,
                    filter_year: filterYear
                };

                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: woocommerce_params.ajax_url,
                    data: formData,
                    success: function(response) {
                        chartJS[filterYear] = response;

                        $("#performance-1 .tot_perc").html(
                            response.data.performanceWidget
                        );
                        $loading.hide();

                        performanceChart.data.labels =
                            response.data.chartJS.labels;
                        performanceChart.data.datasets =
                            response.data.chartJS.datasets;
                        performanceChart.update();
                    },
                    error: function() {
                        $loading.hide();
                    }
                });
            }
        }
    });
})(jQuery);
