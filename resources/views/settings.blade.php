@extends('layouts.app')

@section('content')
<div 
    x-data="{ open: false, systemOpen: false, themeOpen: false, notifOpen: false }" 
    x-init="setTimeout(() => document.body.classList.add('page-enter-active'), 50)"
    class="text-center relative overflow-hidden transition-opacity duration-500 ease-in-out page-enter" 
    x-cloak
>

    <h1 class="text-3xl font-bold text-blue-700 mb-10 flex justify-center items-center gap-2">
        Settings
    </h1>

    <!-- Layer blur aktif saat modal terbuka -->
    <div x-cloak x-show="open || systemOpen || themeOpen || notifOpen"
         x-transition.opacity
         class="absolute inset-0 bg-white/30 backdrop-blur-sm z-10 rounded-2xl">
    </div>

    <!-- Grid utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center transition-all duration-500 relative z-20"
         :class="(open || systemOpen || themeOpen || notifOpen) ? 'scale-90 blur-sm opacity-40 pointer-events-none' : 'scale-100 blur-0 opacity-100'">

    <!-- Profil Pengguna -->
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A9.003 9.003 0 0112 15c2.486 0 4.735.996 6.364 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Profil Pengguna</h3>
        <p class="text-gray-600 text-sm mt-1 mb-4">Kelola nama dan informasi akun</p>
        <a 
            href="{{ route('profile.edit') }}"
            @click.prevent="
                document.body.classList.add('page-leave-active');
                setTimeout(() => window.location.href='{{ route('profile.edit') }}', 450);
            "
            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl active:scale-95 transition-all duration-200">
            Edit
        </a>
    </div>


        <!-- Keamanan -->
        <div class="bg-white/80 rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold">Keamanan</h3>
            <p class="text-gray-600 text-sm mb-4">Ubah kata sandi akun Anda</p>
            <a 
                href="{{ route('profile.edit') }}"
                @click.prevent="
                    document.body.classList.add('page-leave-active');
                    setTimeout(() => window.location.href='{{ route('profile.edit') }}', 450);
                "
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition"
            >
                Update
            </a>
        </div>

        <!-- Tema Tampilan -->
        <div class="relative">
            <div x-show="!themeOpen"
                 x-transition
                 class="bg-white/80 rounded-2xl shadow-lg p-6 relative z-10">
                <h3 class="text-lg font-semibold">Tema Tampilan</h3>
                <p class="text-gray-600 text-sm mb-4">Sesuaikan mode terang atau gelap</p>
                <button @click="themeOpen = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Sesuaikan
                </button>
            </div>
        </div>

        <!-- Bahasa -->
        <div class="relative">
            <div x-show="!open"
                 x-transition
                 class="bg-white/80 rounded-2xl shadow-lg p-6 relative z-10">
                <h3 class="text-lg font-semibold">Bahasa</h3>
                <p class="text-gray-600 text-sm mb-4">Atur bahasa antarmuka</p>
                <button @click="open = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Pilih
                </button>
            </div>
        </div>

        <!-- Notifikasi -->
        <div class="relative">
            <div x-show="!notifOpen"
                 x-transition
                 class="bg-white/80 rounded-2xl shadow-lg p-6 relative z-10">
                <h3 class="text-lg font-semibold">Notifikasi</h3>
                <p class="text-gray-600 text-sm mb-4">Kelola pemberitahuan sistem</p>
                <button @click="notifOpen = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Kelola
                </button>
            </div>
        </div>

        <!-- Tentang Sistem -->
        <div class="relative">
            <div x-show="!systemOpen"
                 x-transition
                 class="bg-white/80 rounded-2xl shadow-lg p-6 relative z-10">
                <h3 class="text-lg font-semibold">Tentang Sistem</h3>
                <p class="text-gray-600 text-sm mb-4">Lihat versi & pengembang</p>
                <button @click="systemOpen = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Detail
                </button>
            </div>
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
