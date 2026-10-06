document.addEventListener('DOMContentLoaded', function () {
    Highcharts.chart('chart8', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Jumlah Mahasiswa Share Konten Berdasarkan Kategori (2024)',
            align: 'left'
        },
        xAxis: {
            categories: ['Pariwisata', 'Lowongan Kerja', 'Berita', 'Event', 'UMKM', 'Kuliner', 'lainnya']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Mahasiswa'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Jumlah Mahasiswa',
            data: [45, 38, 25, 30, 28, 32, 10],
            color: '#2ecc71' // Hijau
        }]
    });
});