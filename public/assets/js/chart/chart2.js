// Data untuk chart
document.addEventListener('DOMContentLoaded', function () {
    Highcharts.chart('chart2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Lowongan Kerja per Bidang Industri'
        },
        xAxis: {
            categories: ['Teknologi', 'Keuangan', 'Kesehatan', 'Manufaktur', 'Pendidikan', 'Pariwisata'],
            crosshair: true,
            accessibility: {
                description: 'Bidang Industri'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Lowongan'
            }
        },
        tooltip: {
            valueSuffix: ' lowongan'
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: '2023',
                data: [1200, 950, 800, 700, 600, 500],
                color: '#0073e6'
            },
            {
                name: '2024',
                data: [1350, 1100, 900, 750, 650, 550],
                color: '#ff6600'
            }
        ]
    });
});
