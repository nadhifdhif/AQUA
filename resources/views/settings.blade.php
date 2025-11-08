@extends('layouts.app')

@section('content')
<div 
    x-data="{ open: false, systemOpen: false, themeOpen: false, notifOpen: false, profileOpen: false }" 
    x-init="setTimeout(() => document.body.classList.add('page-enter-active'), 50)"
    class="text-center relative overflow-hidden transition-opacity duration-500 ease-in-out page-enter" 
    x-cloak
>

    <h1 class="text-3xl font-bold text-blue-700 mb-8 flex justify-center items-center gap-2">
        Settings
    </h1>

    <!-- Layer blur aktif saat modal terbuka -->
    <div x-cloak x-show="open || systemOpen || themeOpen || notifOpen || profileOpen"
         x-transition.opacity
         class="absolute inset-0 bg-white/30 backdrop-blur-sm z-10 rounded-2xl">
    </div>

    <!-- Grid utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center transition-all duration-500 relative z-20"
         :class="(open || systemOpen || themeOpen || notifOpen || profileOpen) ? 'scale-90 blur-sm opacity-40 pointer-events-none' : 'scale-100 blur-0 opacity-100'">

        <!-- Card Template -->
        @php
            $cards = [
                ['title' => 'Profil Pengguna', 'desc' => 'Kelola nama dan informasi akun', 'btn' => 'Edit', 'action' => 'profileOpen = true'],
                ['title' => 'Keamanan', 'desc' => 'Ubah kata sandi akun Anda', 'btn' => 'Update', 'action' => "window.location.href='{{ route('profile.edit') }}'"],
                ['title' => 'Tema Tampilan', 'desc' => 'Sesuaikan mode terang atau gelap', 'btn' => 'Sesuaikan', 'action' => 'themeOpen = true'],
                ['title' => 'Bahasa', 'desc' => 'Atur bahasa antarmuka', 'btn' => 'Pilih', 'action' => 'open = true'],
                ['title' => 'Notifikasi', 'desc' => 'Kelola pemberitahuan sistem', 'btn' => 'Kelola', 'action' => 'notifOpen = true'],
                ['title' => 'Tentang Sistem', 'desc' => 'Lihat versi & pengembang', 'btn' => 'Detail', 'action' => 'systemOpen = true'],
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="relative">
            <div class="bg-white/80 rounded-2xl shadow-md p-5 relative z-10 min-h-[150px] flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                <div class="text-center">
                    <h3 class="text-[17px] font-semibold">{{ $card['title'] }}</h3>
                    <p class="text-gray-600 text-sm mt-1 mb-3 leading-snug">{{ $card['desc'] }}</p>
                </div>
                <div class="flex justify-center">
                    <button @click="{{ $card['action'] }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1.5 rounded-lg transition">
                        {{ $card['btn'] }}
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Card Profil Pengguna -->
    <div x-cloak x-show="profileOpen" x-transition
        class="absolute inset-0 flex items-center justify-center z-50">
        <div class="bg-white/95 rounded-3xl p-8 shadow-2xl w-full max-w-md animate-[float_3s_ease-in-out_infinite] text-center">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Profil Pengguna</h3>
            <p class="text-gray-600 mb-6">Fitur ini masih dalam tahap pengembangan.</p>
            <button @click="profileOpen = false"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>


    <!-- Card Bahasa -->
    <div x-cloak x-show="open" x-transition
         class="absolute inset-0 flex items-center justify-center z-50">
        <div class="bg-white/95 rounded-3xl p-8 shadow-2xl w-full max-w-md animate-[float_3s_ease-in-out_infinite]">
            <h3 class="text-2xl font-semibold mb-6 text-gray-800">Pilih Bahasa</h3>
            <div class="grid grid-cols-3 gap-4 mb-8">
                <template x-for="lang in ['id','gb','sa','fr','es','pt','cn','jp','kr']">
                    <button class="bg-blue-400 hover:bg-blue-500 text-white py-2 rounded-lg transition flex justify-center items-center gap-2">
                        <span :class="'fi fi-' + lang"></span>
                        <span x-text="{
                            id: 'Indonesia', gb: 'English', sa: 'العربية', fr: 'Français',
                            es: 'Español', pt: 'Português', cn: '中文', jp: '日本語', kr: '한국어'
                        }[lang]"></span>
                    </button>
                </template>
            </div>
            <button @click="open = false"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                Kembali
            </button>
        </div>
    </div>

    <!-- Card Tema Tampilan -->
    <div x-cloak x-show="themeOpen" x-transition
         class="absolute inset-0 flex items-center justify-center z-50">
        <div class="bg-white/95 rounded-3xl p-8 shadow-2xl w-full max-w-md animate-[float_3s_ease-in-out_infinite]">
            <h3 class="text-2xl font-semibold mb-6 text-gray-800">Tema Tampilan</h3>
            <div class="flex justify-center gap-6 mb-8">
                <button @click="document.documentElement.classList.remove('dark'); themeOpen = false"
                        class="px-5 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 transition">
                    🌞 Mode Terang
                </button>
                <button @click="document.documentElement.classList.add('dark'); themeOpen = false"
                        class="px-5 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-800 transition">
                    🌙 Mode Gelap
                </button>
            </div>
            <button @click="themeOpen = false"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>

    <!-- Card Notifikasi -->
    <div x-cloak x-show="notifOpen" x-transition
         class="absolute inset-0 flex items-center justify-center z-50">
        <div class="bg-white/95 rounded-3xl p-8 shadow-2xl w-full max-w-md animate-[float_3s_ease-in-out_infinite] text-left">
            <h3 class="text-2xl font-semibold mb-6 text-gray-800 text-center">Pengaturan Notifikasi</h3>

            <div class="space-y-4 mb-8">
                <label class="flex items-center justify-between">
                    <span>Email Notifikasi</span>
                    <input type="checkbox" checked disabled class="toggle toggle-primary">
                </label>
                <label class="flex items-center justify-between">
                    <span>Notifikasi Pop-up</span>
                    <input type="checkbox" disabled class="toggle toggle-primary">
                </label>
                <label class="flex items-center justify-between">
                    <span>Suara Notifikasi</span>
                    <input type="checkbox" disabled class="toggle toggle-primary">
                </label>
            </div>

            <div class="flex justify-center gap-4">
                <button @click="notifOpen = false"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                    Tutup
                </button>
                <button disabled
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg opacity-60 cursor-not-allowed">
                    Simpan (Dummy)
                </button>
            </div>
        </div>
    </div>

    <!-- Card Tentang Sistem -->
    <div x-cloak x-show="systemOpen" x-transition
         class="absolute inset-0 flex items-center justify-center z-50">
        <div class="bg-white/95 rounded-3xl p-10 px-12 shadow-2xl w-full max-w-2xl animate-[float_3s_ease-in-out_infinite]">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Tentang Sistem</h3>
            <p class="text-gray-600 mb-4">AQUA (Automatic Quality Utility for Agriculture)</p>
            <ul class="text-left text-gray-700 list-disc list-inside mb-6 leading-relaxed">
                <li><span class="font-semibold">Versi Sistem:</span> 1.0</li>
                <li><span class="font-semibold">Pengembang:</span> Universitas Pendidikan Indonesia dan SMKN 6 Bandung</li>
            </ul>
            <button @click="systemOpen = false"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
[x-cloak] { display: none !important; }
@keyframes float { 0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)} }
.page-enter{opacity:0;transform:scale(0.97);transition:opacity .6s ease,transform .6s ease;}
.page-enter-active{opacity:1;transform:scale(1);}
.page-leave-active{opacity:0;transform:scale(0.96);filter:blur(3px);transition:all .5s ease;}
</style>
@endsection
