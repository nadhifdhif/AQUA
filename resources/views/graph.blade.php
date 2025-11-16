@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[90vh] text-center fade-in-up space-y-8">
    <h1 class="text-3xl font-bold text-blue-700">📊 Grafik Sensor</h1>

    <div x-data="chartSlider()" x-init="initChart()" 
        class="bg-white/90 shadow-xl rounded-2xl p-8 w-full max-w-3xl"> <!-- max-w dikecilin -->

        <h2 class="text-xl font-semibold text-gray-800 mb-4" x-text="title"></h2>

        <!-- Canvas container biar nggak terlalu besar -->
        <div class="w-full mx-auto" style="max-height: 260px;">
            <canvas id="chartCanvas" height="150"></canvas> <!-- height dikecilin -->
        </div>

        <!-- Slider dots -->
        <div class="flex justify-center mt-6 space-x-3">
            <button @click="setSlide(0)"
                :class="slide === 0 ? 'bg-blue-600' : 'bg-gray-400'"
                class="w-3 h-3 rounded-full transition-all"></button>

            <button @click="setSlide(1)"
                :class="slide === 1 ? 'bg-blue-600' : 'bg-gray-400'"
                class="w-3 h-3 rounded-full transition-all"></button>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function chartSlider() {
    return {
        slide: 0,
        chart: null,
        title: "Grafik Suhu (°C)",

        suhu: {
            title: "Grafik Suhu (°C)",
            labels: ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'],
            values: [26,27,28,29,27,30,31],
            color: 'rgba(37,99,235,1)',
            bg: 'rgba(37,99,235,0.2)'
        },

        lembap: {
            title: "Grafik Kelembapan (%)",
            labels: ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'],
            values: [75,78,80,82,79,81,83],
            color: 'rgba(16,185,129,1)',
            bg: 'rgba(16,185,129,0.2)'
        },

        initChart() {
            const ctx = document.getElementById('chartCanvas').getContext('2d');
            this.chart = new Chart(ctx, this.getConfig(this.suhu));
        },

        getConfig(data) {
            return {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.title,
                        data: data.values,
                        borderColor: data.color,
                        backgroundColor: data.bg,
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: data.color
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // penting biar tinggi kecil
                    plugins: { legend: { labels: { color: '#1e293b' } } },
                    scales: {
                        y: { ticks: { color: '#1e293b' } },
                        x: { ticks: { color: '#1e293b' } }
                    }
                }
            };
        },

        setSlide(i) {
            this.slide = i;

            const data = i === 0 ? this.suhu : this.lembap;
            this.title = data.title;

            this.chart.data.labels = data.labels;
            this.chart.data.datasets[0].data = data.values;
            this.chart.data.datasets[0].label = data.title;
            this.chart.data.datasets[0].borderColor = data.color;
            this.chart.data.datasets[0].backgroundColor = data.bg;

            this.chart.update();
        }
    }
}
</script>

<style>
.fade-in-up {
    animation: fadeInUp 0.6s ease-out both;
}
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(15px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
