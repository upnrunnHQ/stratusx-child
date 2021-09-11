jQuery(document).ready(function($) {
    // Code that uses jQuery's $ can follow here.
    jQuery.noConflict();

    var appSettings = {
        repeatedTrades: {
            currentPage: 1,
            isLoading: false
        }
    };

    var cashChart = document.getElementById("CashChart");
    new Chart(cashChart, {
        type: "doughnut",
        data: {
            labels: ["Graph 200,000", "CO 100,000", "CI 100,000", "D 100,000"],
            datasets: [
                {
                    label: "Amount",
                    backgroundColor: [
                        "#23e200",
                        "#00c4ff",
                        "#ff0000",
                        "#007fff"
                    ],
                    borderWidth: 0,
                    data: [12000, 14000, 16000, 24000]
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 10,
                    bottom: 30
                }
            },
            title: {
                display: false
            },
            legend: {
                display: true,

                position: "top",
                labels: {
                    fontColor: "#000000",
                    fontSize: 10,
                    boxWidth: 10,
                    padding: 5
                }
            },
            cutoutPercentage: 85
        }
    });

    // =====PercentChart=======
    var percentChart = document.getElementById("percentChart"),
        percentChartData = JSON.parse(percentChart.dataset.chartjs);

    new Chart(percentChart, {
        type: "doughnut",
        data: {
            labels: percentChartData.labels,
            datasets: [
                {
                    backgroundColor: ["#007fff", "#f80358", "#fff0f5"],
                    borderWidth: 0,
                    data: percentChartData.data
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 10,
                    bottom: 30
                }
            },
            title: {
                display: false
            },
            legend: {
                display: false,

                position: "top",
                labels: {
                    fontColor: "#000000",
                    fontSize: 10,
                    boxWidth: 10,
                    padding: 5
                }
            },
            cutoutPercentage: 65
        }
    });

    // ======lastmonthChart=======
    var lastmonthChart = document.getElementById("lastmonthChart"),
        lastmonthChartData = JSON.parse(lastmonthChart.dataset.chartjs);
    new Chart(lastmonthChart, {
        type: "bar",
        data: {
            labels: lastmonthChartData.labels,
            datasets: [
                {
                    backgroundColor: "#ff4e4e",
                    data: lastmonthChartData.datasets
                }
            ]
        },
        options: {
            maintainAspectRatio: true,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 5,
                    bottom: 0
                }
            },
            title: {
                display: false
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                    {
                        time: {
                            unit: "date"
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }
                ],
                yAxes: [
                    {
                        ticks: {
                            padding: 10
                        },
                        gridLines: {
                            color: "#dddddd",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: true,
                            borderDash: false
                            // zeroLineBorderDash: [1],
                        }
                    }
                ]
            },

            tooltips: {
                backgroundColor: "#ffffff",
                bodyFontColor: "#000000",
                bodyFontStyle: "bold",
                titleMarginBottom: 10,
                titleFontColor: "#000000",
                titleFontSize: 13,
                borderColor: "#dddfed",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                intersect: false,
                mode: "index",
                caretPadding: 10
            }
        }
    });

    var performancelineChart = document.getElementById("performancelineChart"),
        performancelineChartData = JSON.parse(
            performancelineChart.dataset.chartjs
        );
    var _performanceLineChart = new Chart(performancelineChart, {
        type: "bar",
        data: {
            labels: performancelineChartData.labels,
            datasets: [
                {
                    backgroundColor: "#23e200",
                    barThickness: 14,
                    data: performancelineChartData.data
                }
            ]
        },
        options: {
            maintainAspectRatio: true,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            title: {
                display: false
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                    {
                        time: {
                            unit: "data"
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }
                ],
                yAxes: [
                    {
                        ticks: {
                            padding: 10
                        },
                        gridLines: {
                            color: "#dddddd",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: true,
                            border: [5],
                            zeroLineBorder: [5]
                        }
                    }
                ]
            },

            tooltips: {
                backgroundColor: "#ffffff",
                bodyFontColor: "#000000",
                bodyFontStyle: "bold",
                titleMarginBottom: 10,
                titleFontColor: "#000000",
                titleFontSize: 16,
                borderColor: "#dddfed",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                intersect: false,
                mode: "index",
                caretPadding: 10
            }
        }
    });

    $(".totle_see_m").on("click", function() {
        $(".tot_perc .monthly_per").css("display", "flex");
    });

    $("#performance-1").on("change", ".g_year_drp", function() {
        var portfolioId = $(this).attr("data-portfolio-id");
        var filterYear = this.value;
        var $loading = $("#performance-1").find(".g_loading");

        if (filterYear) {
            $loading.show();

            var formData = {
                action: "get_graph_performance_by_year",
                portfolio_id: portfolioId,
                filter_year: filterYear
            };

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: woocommerce_params.ajax_url,
                data: formData,
                success: function(response) {
                    $("#performance-1 .tot_perc").html(
                        response.data.performanceWidget
                    );
                    $loading.hide();
                },
                error: function() {
                    $loading.hide();
                }
            });
        }
    });

    $("#performance-2").on("change", ".g_year_drp", function() {
        var portfolioId = $(this).attr("data-portfolio-id");
        var filterYear = this.value;
        var $loading = $("#performance-2").find(".g_loading");

        if (filterYear) {
            $loading.show();

            var formData = {
                action: "get_graph_performance_by_year",
                portfolio_id: portfolioId,
                filter_year: filterYear
            };

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: woocommerce_params.ajax_url,
                data: formData,
                success: function(response) {
                    _performanceLineChart.data.datasets[0].data =
                        response.data.graphPerformance;
                    _performanceLineChart.update();

                    $("#performance-2 .tot_perc").html(
                        response.data.performanceDetail
                    );
                    $("#performance-2 .tot_txt").html(
                        response.data.totalPerformance
                    );
                    $loading.hide();
                },
                error: function() {
                    $loading.hide();
                }
            });
        }
    });

    $(".repeat_see").on("click", "a", function() {
        if (appSettings.repeatedTrades.isLoading) {
            return;
        }

        var button = $(this),
            buttonText = $(this).text();
        button.text("Loading...");

        var formData = {
            action: "get_repeated_trades",
            portfolio_id: "DRY1037474",
            page: appSettings.repeatedTrades.currentPage += 1
        };

        appSettings.repeatedTrades.isLoading = true;

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: woocommerce_params.ajax_url,
            data: formData,
            success: function(response) {
                button.text(buttonText);
                appSettings.repeatedTrades.isLoading = false;

                console.log(response);
            },
            error: function() {
                button.text(buttonText);
                appSettings.repeatedTrades.isLoading = false;
            }
        });
    });
});
