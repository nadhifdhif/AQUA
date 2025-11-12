@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[90vh] text-center fade-in-up space-y-8">
    <h1 class="text-3xl font-bold text-blue-700">📊 Grafik Sensor</h1>

    <!-- Card Grafik -->
    <div class="bg-white/90 shadow-xl rounded-2xl p-8 w-full max-w-5xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            
            <!-- Grafik Suhu -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Suhu (°C)</h2>
                <canvas id="temperatureChart" height="200"></canvas>
            </div>

            <!-- Grafik Kelembapan -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Kelembapan (%)</h2>
                <canvas id="humidityChart" height="200"></canvas>
            </div>

        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    // Grafik Suhu
    new Chart(document.getElementById('temperatureChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Suhu (°C)',
                data: [26, 27, 28, 29, 27, 30, 31],
                borderColor: 'rgba(37,99,235,1)',
                backgroundColor: 'rgba(37,99,235,0.2)',
                borderWidth: 2,
                tension: 0.3,
                pointBackgroundColor: 'rgba(37,99,235,1)'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true, labels: { color: '#1e293b' } } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#1e293b' } },
                x: { ticks: { color: '#1e293b' } }
            }
        }
    });

    // Grafik Kelembapan
    new Chart(document.getElementById('humidityChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Kelembapan (%)',
                data: [75, 78, 80, 82, 79, 81, 83],
                borderColor: 'rgba(16,185,129,1)',
                backgroundColor: 'rgba(16,185,129,0.2)',
                borderWidth: 2,
                tension: 0.3,
                pointBackgroundColor: 'rgba(16,185,129,1)'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true, labels: { color: '#1e293b' } } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#1e293b' } },
                x: { ticks: { color: '#1e293b' } }
            }
        }
    });
});
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
