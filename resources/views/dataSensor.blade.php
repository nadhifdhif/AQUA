@extends('layouts.app')

@section('content')
<div class="p-6 text-center fade-in-up">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">Sensor Data</h1>

    <div class="bg-white/50 backdrop-blur-lg rounded-2xl shadow-md p-6 fade-in-up" style="animation-delay: 0.1s;">
        <table class="w-full border-collapse rounded-xl overflow-hidden">
            <thead class="bg-blue-600 text-white fade-in-up" style="animation-delay: 0.2s;">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Datetime</th>
                    <th class="py-3 px-4 text-left">Temperature (°C)</th>
                    <th class="py-3 px-4 text-left">Humidity (%)</th>
                    <th class="py-3 px-4 text-left">Carbon Emissions (ppm)</th>
                    <th class="py-3 px-4 text-left">Soil Humidity (%)</th>
                    <th class="py-3 px-4 text-left">Rain Detection</th>
                    <th class="py-3 px-4 text-left">Pump Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($sensorData as $index => $data)
                    <tr class="hover:bg-blue-50 transition fade-in-up" style="animation-delay: {{ $index * 0.1 + 0.3 }}s;">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $data->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-3 px-4">{{ $data->suhu }}°C</td>
                        <td class="py-3 px-4">{{ $data->kelembapan }}%</td>
                        <td class="py-3 px-4">{{ $data->emisi_karbon }} ppm</td>
                        <td class="py-3 px-4">{{ $data->kelembapan_tanah }}%</td>
                        <td class="py-3 px-4">
                            @if ($data->status_hujan === 'Hujan')
                                <span class="text-blue-600 font-semibold">Hujan</span>
                            @else
                                <span class="text-gray-600">No Rain</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if ($data->status_pompa === 'Aktif')
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-red-500 font-semibold">Inactive</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
