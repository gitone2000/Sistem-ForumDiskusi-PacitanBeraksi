document.addEventListener('DOMContentLoaded', function () {
    // Data awal
    const initialData = [
        ['Rekomendasi Wisata Malang', 150],
        ['Tips Hemat Liburan', 120],
        ['Info Magang IT', 100],
        ['Lowongan Startup', 90],
        ['Review Tempat Wisata', 80]
    ];

    // Mapping warna untuk setiap kategori
    const categoryColors = {
        'Rekomendasi Wisata Malang': '#FF0000',
        'Tips Hemat Liburan': '#FF4500',
        'Info Magang IT': '#0000FF',
        'Lowongan Startup': '#FFD700',
        'Review Tempat Wisata': '#00FF00',
        'Event Campus Hiring': '#00FFFF',
        'Tips Interview Kerja': '#FF00FF',
        'Kuliner Malang': '#FF1493',
        'Tips Belajar Efektif': '#4B0082',
        'Info Beasiswa': '#32CD32'
    };

    // Fungsi untuk menghasilkan data progresif
    function generateProgressiveData(previousData) {
        const topics = [
            'Rekomendasi Wisata Malang',
            'Tips Hemat Liburan',
            'Info Magang IT',
            'Lowongan Startup',
            'Review Tempat Wisata',
            'Event Campus Hiring',
            'Tips Interview Kerja',
            'Kuliner Malang',
            'Tips Belajar Efektif',
            'Info Beasiswa'
        ];
        
        // Mengacak urutan topik
        const shuffledTopics = topics.sort(() => Math.random() - 0.5);
        
        // Mengambil 5 topik teratas
        const selectedTopics = shuffledTopics.slice(0, 5);
        
        // Membuat data dengan nilai yang lebih tinggi dari sebelumnya
        return selectedTopics.map(topic => {
            const previousValue = previousData.find(item => item[0] === topic)?.[1] || 50;
            const increase = Math.floor(Math.random() * 30) + 10; // Peningkatan 10-40
            return [topic, previousValue + increase];
        });
    }

    // Konfigurasi chart
    const chart = Highcharts.chart('chart7', {
        chart: {
            type: 'bar',
            animation: {
                duration: 2000,
                easing: 'easeInOutQuad'
            },
            events: {
                load: function() {
                    const chart = this;
                    let currentData = initialData;
                    
                    // Update chart setiap 3 detik
                    setInterval(function() {
                        const newData = generateProgressiveData(currentData);
                        
                        // Sort data descending
                        newData.sort((a, b) => b[1] - a[1]);
                        
                        // Update dengan animasi yang lebih smooth dan warna tetap
                        chart.series[0].setData(newData.map(item => ({
                            name: item[0],
                            y: item[1],
                            color: categoryColors[item[0]]
                        })), false, {
                            duration: 2000,
                            easing: 'easeInOutQuad'
                        });
                        
                        // Update categories dengan delay
                        setTimeout(() => {
                            chart.xAxis[0].setCategories(newData.map(item => item[0]));
                        }, 1000);
                        
                        currentData = newData;
                    }, 3000);
                }
            }
        },
        title: {
            text: 'Topik Diskusi Terpopuler 2024',
            align: 'left'
        },
        xAxis: {
            categories: initialData.map(item => item[0]),
            title: {
                text: 'Topik Diskusi'
            },
            labels: {
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Jumlah Komentar'
            },
            min: 0,
            labels: {
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold'
                }
            }
        },
        plotOptions: {
            series: {
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuad'
                },
                dataLabels: {
                    enabled: true,
                    format: '{y} komentar',
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold',
                        textOutline: '1px contrast'
                    }
                },
                states: {
                    hover: {
                        brightness: 0.1
                    }
                }
            }
        },
        tooltip: {
            animation: true,
            style: {
                fontSize: '12px'
            }
        },
        series: [{
            name: 'Jumlah Komentar',
            data: initialData.map(item => ({
                name: item[0],
                y: item[1],
                color: categoryColors[item[0]]
            })),
            colorByPoint: false,
            borderWidth: 2,
            borderColor: '#FFFFFF',
            shadow: true
        }]
    });
});
