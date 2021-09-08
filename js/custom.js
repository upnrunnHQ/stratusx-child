jQuery(document).ready(function($) {
    // Code that uses jQuery's $ can follow here.
    jQuery.noConflict();

    var CashChart = document.getElementById("CashChart").getContext("2d");
    new Chart(CashChart, {
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

    $("#g_performance_drp").on("change", function() {
        var portfolioId = $(this).attr("data-portfolio-id");
        var filterYear = this.value;
        var $loading = $(".g_loading");

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
                    console.log(response);
                    _performanceLineChart.data.datasets[0].data =
                        response.data.graphPerformance;
                    _performanceLineChart.update();

                    $(".tot_perc").html(response.data.performanceDetail);
                    $(".tot_txt").html(response.data.totalPerformance);
                    $loading.hide();
                },
                error: function() {
                    $loading.hide();
                }
            });
        }
    });
});
