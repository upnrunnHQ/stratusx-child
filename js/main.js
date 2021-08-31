jQuery(document).ready(function() {
  jQuery(".h_profile .icon_noti").click(function () {
    jQuery(this).parent().toggleClass("active");
  });
});

// --- Chart --- //
// Risk Indicator Chart -----//
var indicatorChart = document.getElementById("indicatorChart").getContext("2d");
var commEarnChart = new Chart(indicatorChart, {
  type: "bar",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        backgroundColor: "#ff0000",
        barThickness: 10,
        // label: "Earning",
        data: [-1, -1.2, -2, -3, -3, -2, -2, -2, -2, -2, 0, 0],
      },
      {
        backgroundColor: "#23e200",
        barThickness: 10,
        // label: "Earning",
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2],
      },
    ],
  },
  options: {
    maintainAspectRatio: true,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0,
      },
    },
    title: {
      display: false,
    },
    legend: {
      display: false,
    },
    scales: {
      xAxes: [
        {
          time: {
            unit: "date",
          },
          gridLines: {
            display: false,
            drawBorder: false,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            padding: 10,
          },
          gridLines: {
            color: "#dddddd",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: true,
            border: [5],
            zeroLineBorder: [5],
          },
        },
      ],
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
      caretPadding: 10,
    },
  },
});

// ------ Performance Chart -----//
var performanceChart = document
  .getElementById("performanceChart")
  .getContext("2d");
var performanChart = new Chart(performanceChart, {
  type: "bar",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        backgroundColor: "#ff0000",
        barThickness: 10,
        // label: "Earning",
        data: [-1, -1.2, -2, -3, -3, -2, -2, -2, -2, -2, 0, 0],
      },
      {
        backgroundColor: "#23e200",
        barThickness: 10,
        // label: "Earning",
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1],
      },
    ],
  },
  options: {
    maintainAspectRatio: true,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0,
      },
    },
    title: {
      display: false,
    },
    legend: {
      display: false,
    },
    scales: {
      xAxes: [
        {
          time: {
            unit: "data",
          },
          gridLines: {
            display: false,
            drawBorder: false,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            padding: 10,
          },
          gridLines: {
            color: "#dddddd",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: true,
            border: [5],
            zeroLineBorder: [5],
          },
        },
      ],
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
      caretPadding: 10,
    },
  },
});

// -----Yearly chart -----//
var yearlyChart = document.getElementById("yearlyChart").getContext("2d");
var yearlyChart1 = new Chart(yearlyChart, {
  type: "bar",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      // "Aug",
      // "Sep",
      // "Oct",
      // "Nov",
      // "Dec",
    ],
    datasets: [
      {
        backgroundColor: "#ff0000",
        barThickness: 4,
        // label: "Earning",
        data: [10, 15, 5, 10, 12, 14, 16],
      },
      {
        backgroundColor: "#23e200",
        barThickness: 4,
        // label: "Earning",
        data: [0, 17, 4, 12, 7, 16, 12],
      },
      {
        backgroundColor: "#007fff",
        barThickness: 4,
        // label: "Earning",
        data: [0, 5, 0, 0, 0, 0, 0],
      },
    ],
  },
  options: {
    maintainAspectRatio: true,
    layout: {
      padding: {
        left: 0,
        right: 0,
        top: 5,
        bottom: 0,
      },
    },
    title: {
      display: false,
    },
    legend: {
      display: true,
    },
    scales: {
      xAxes: [
        {
          time: {
            unit: "date",
          },
          gridLines: {
            display: false,
            drawBorder: false,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            padding: 10,
            // callback: function (value, index, values) {
            //   return number_format(value) + "K";
            // },
          },
          gridLines: {
            color: "#dddddd",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: true,
            // borderDash: [5],
            // zeroLineBorderDash: [5],
          },
        },
      ],
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
      caretPadding: 10,
      //   callbacks: {
      //     label: function (tooltipItem, chart) {
      //       var datasetLabel =
      //         chart.datasets[tooltipItem.datasetIndex].label || "";
      //       return datasetLabel + " $ " + number_format(tooltipItem.yLabel);
      //     },
      //   },
    },
  },
});

//===========

// --Translate---//

function googleTranslateElementInit() {
  new google.translate.TranslateElement(
    { pageLanguage: "en" },
    "google_translate_element_id"
  );
}
