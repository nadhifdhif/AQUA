@extends('layouts.app')

@section('content')
<div 
    x-data="{ show: false }" 
    x-init="setTimeout(() => show = true, 150)"
    class="py-6 px-8 min-h-[85vh] flex flex-col items-center"
>
    <div 
        class="w-full max-w-6xl bg-white/10 backdrop-blur-lg rounded-[1.5rem] shadow-[0_1px_5px_rgba(0,0,0,0.1)] p-8 border border-white/10 transition-all duration-700 ease-out"
        :class="show ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-3 scale-[0.98]'"
    >
        <h1 class="text-3xl font-semibold text-[#004aad] mb-8 text-center drop-shadow-sm">Device Control</h1>

        <!-- Grid 3 kolom -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $devices = [
                    ['name' => 'Pompa Air', 'status' => 'Aktif'],
                    ['name' => 'Kipas Pendingin', 'status' => 'Nonaktif'],
                    ['name' => 'Lampu Greenhouse', 'status' => 'Aktif'],
                    ['name' => 'Sensor Kelembapan Tanah', 'status' => 'Aktif'],
                    ['name' => 'Sensor Hujan', 'status' => 'Aktif'],
                    ['name' => 'Sensor Emisi Karbon', 'status' => 'Nonaktif'],
                ];
            @endphp

            @foreach($devices as $index => $device)
            <div 
                x-data="{ visible: false }"
                x-init="setTimeout(() => visible = true, {{ $index * 120 + 200 }})"
                class="rounded-2xl p-6 text-center backdrop-blur-md border transform transition-all duration-700 ease-out hover:shadow-lg hover:scale-[1.02]
                       border-white/20 shadow-sm bg-white/70"
                :class="visible ? 'opacity-100 translate-y-0 scale-100' : 'opacity-80 translate-y-3 scale-[0.98]'"
            >
                <h2 class="text-[15px] font-semibold mb-2 text-gray-800 text-ellipsis overflow-hidden whitespace-nowrap tracking-tight">
                    {{ $device['name'] }}
                </h2>
                <p class="text-gray-600 mb-4">
                    Status: 
                    @if($device['status'] === 'Aktif')
                        <span class="font-semibold text-green-600">Aktif</span>
                    @else
                        <span class="font-semibold text-red-600">Nonaktif</span>
                    @endif
                </p>

                <!-- SEMUA tombol biru solid -->
                <button 
                    class="px-5 py-2.5 rounded-xl font-semibold text-white shadow-md
                           bg-[#2563eb] hover:bg-[#1d4ed8] active:scale-95
                           focus:ring-2 focus:ring-blue-300 focus:outline-none transition duration-300">
                    {{ $device['status'] === 'Aktif' ? 'Matikan' : 'Nyalakan' }}
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
