<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sistem Poliklinik') }}</title>

        <!-- Fonts Bunny -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col justify-between p-6 lg:p-10">
        {{-- Navbar --}}
        <header class="w-full max-w-5xl mx-auto flex items-center justify-between pb-6 border-b border-slate-200">
            <div class="flex items-center gap-2">
                <span class="p-2 rounded-xl bg-blue-900 text-white font-bold text-lg leading-none">
                    +
                </span>
                <span class="font-bold text-xl text-slate-900 tracking-tight">Poliklinik App</span>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-5 py-2 text-sm font-semibold text-white bg-blue-900 hover:bg-blue-800 rounded-lg shadow-sm transition"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2 text-sm font-semibold text-slate-800 hover:text-blue-900 hover:bg-slate-200/60 rounded-lg transition"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-5 py-2 text-sm font-semibold text-white bg-blue-900 hover:bg-blue-800 rounded-lg shadow-sm transition"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- Hero Content --}}
        <main class="w-full max-w-5xl mx-auto my-auto py-12 flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="max-w-xl space-y-6">
                <div class="inline-block px-3 py-1 bg-blue-50 border border-blue-200 text-blue-800 rounded-full text-xs font-semibold tracking-wide">
                    Sistem Manajemen Pelayanan Pasien
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight">
                    Layanan Temu Dokter & Pemeriksaan Terintegrasi
                </h1>
                <p class="text-slate-600 text-base leading-relaxed">
                    Aplikasi pelayanan poliklinik untuk pendaftaran antrean periksa, pencatatan rekam medis dokter, serta pengelolaan data obat secara efisien.
                </p>
                <div class="flex items-center gap-4 pt-2">
                    <a
                        href="{{ route('login') }}"
                        class="px-6 py-3 text-sm font-bold text-white bg-blue-900 hover:bg-blue-800 rounded-xl shadow-md transition"
                    >
                        Mulai Masuk
                    </a>
                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="px-6 py-3 text-sm font-bold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 rounded-xl transition"
                        >
                            Daftar Pasien Baru
                        </a>
                    @endif
                </div>
            </div>

            {{-- Feature Card Box --}}
            <div class="w-full lg:w-96 bg-white border border-slate-200 shadow-xl rounded-2xl p-6 space-y-4">
                <div class="font-bold text-slate-900 text-base pb-2 border-b border-slate-100">
                    Akses Berdasarkan Peran
                </div>
                <div class="space-y-3">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="font-semibold text-sm text-slate-900">Admin</div>
                        <div class="text-xs text-slate-500">Mengelola data poli, data dokter, dan data obat.</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="font-semibold text-sm text-slate-900">Dokter</div>
                        <div class="text-xs text-slate-500">Mengatur jadwal periksa dan input catatan resep obat.</div>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="font-semibold text-sm text-slate-900">Pasien</div>
                        <div class="text-xs text-slate-500">Pendaftaran nomor antrean dan histori pemeriksaan.</div>
                    </div>
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="w-full max-w-5xl mx-auto pt-6 text-center text-xs text-slate-500 border-t border-slate-200">
            &copy; {{ date('Y') }} Poliklinik App. Dikembangkan dengan Laravel & Tailwind CSS.
        </footer>
    </body>
</html>