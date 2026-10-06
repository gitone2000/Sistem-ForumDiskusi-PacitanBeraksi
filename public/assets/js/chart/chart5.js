document.addEventListener('DOMContentLoaded', function () {
    const chartData = window.chartData?.chart5 ?? {
        categories: [],
        dalam: [],
        luar: [],
        total: []
        };
        
    Highcharts.chart('chart5', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Jumlah Mahasiswa Per Tahun Masuk'
        },
        subtitle: {
            text: 'Tren Mahasiswa Dalam & Luar Kota'
        },
        xAxis: {
            categories: chartData.categories,
            accessibility: {
                description: 'Tahun Masuk'
            }
        },
        yAxis: {
            title: {
                text: 'Jumlah Mahasiswa'
            },
            labels: {
                format: '{value}'
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 5,
                    lineColor: '#333',
                    lineWidth: 1
                }
            }
        },
        colors: ['#1abc9c', '#e74c3c', '#3498db'], // Hijau, Merah, Biru
        series: [
            {
                name: 'Dalam Kota Pacitan',
                marker: {
                    symbol: 'circle'
                },
                data: chartData.dalam, // Tidak turun lurus, ada sedikit naik
                color: '#1abc9c'
            },
            {
                name: 'Luar Kota Pacitan',
                marker: {
                    symbol: 'diamond'
                },
                data: chartData.luar, // Naik-turun alami
                color: '#e74c3c'
            },
            {
                name: 'Total Mahasiswa',
                marker: {
                    symbol: 'square'
                },
                data: chartData.total, // Naik dengan sedikit variasi
                color: '#3498db'
            }
        ]
    });
});
