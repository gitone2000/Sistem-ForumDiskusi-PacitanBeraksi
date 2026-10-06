document.addEventListener('DOMContentLoaded', function () {
    Highcharts.chart('chart6', {
        chart: {
            type: 'line' // Bisa diganti dengan 'column' atau 'bar' jika ingin tampilan lain
        },
        title: {
            text: 'Jumlah Diskusi yang Dibuat Per Bulan (2024)'
        },
        xAxis: {
            title: { text: 'Bulan' },
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            title: { text: 'Jumlah Diskusi' },
            allowDecimals: false
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: '{point.y} Diskusi'
        },
        series: [{
            name: 'Diskusi',
            data: [15, 25, 30, 22, 35, 40, 50, 45, 38, 42, 48, 55], // Data dummy, bisa diganti dengan data asli
            color: '#FF5733'
        }]
    });
});
