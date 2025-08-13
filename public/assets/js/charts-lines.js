document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("lineChart").getContext("2d");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: lineLabels,
            datasets: lineDatasets,
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Jumlah Sampel per Bulan per Device",
                },
                legend: {
                    position: "top",
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "Bulan",
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Jumlah Sampel",
                    },
                },
            },
        },
    });
});
