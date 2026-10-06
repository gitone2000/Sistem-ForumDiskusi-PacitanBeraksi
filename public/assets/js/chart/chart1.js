document.addEventListener('DOMContentLoaded', function () {
    const chartData = window.chartData?.chart1 ?? {
        categories: [],
        data: [],
        year: new Date().getFullYear()
        };

    Highcharts.chart('chart1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Persebaran Mahasiswa Asal Pacitan di Berbagai Kampus',
            align: 'left'
        },
        subtitle: {
            text: 'Data Tahun ' + chartData.year,
            align: 'left'
        },
        xAxis: {
            categories: chartData.categories,
            crosshair: true,
            title: {
                text: 'Nama Kampus'
            },
            labels: {
                style: {
                    fontSize: '11px'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Mahasiswa'
            },
            labels: {
                formatter: function() {
                    return this.value.toLocaleString();
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f} mahasiswa</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return this.y.toLocaleString();
                    }
                }
            }
        },
        series: [{
            name: 'Jumlah Mahasiswa Asal Pacitan',
            data: chartData.data,
            color: {
                linearGradient: {
                    x1: 0,
                    x2: 0,
                    y1: 0,
                    y2: 1
                },
                stops: [
                    // [0, '#FF6B6B'],
                    [1, '#000080']
                ]
            }
        }]
    });
});