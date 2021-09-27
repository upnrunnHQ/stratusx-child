{
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
                    min: -5,
                    max: 5,
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
}
