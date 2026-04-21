<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem POC — Emas Cair dari Limbah Organik</title>
    <meta name="description" content="Mengubah limbah organik menjadi Pupuk Organik Cair (POC) premium melalui proses fermentasi ilmiah.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg { background: url('/images/hero-bg.png') center/cover no-repeat; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.12); }
        .fade-up { opacity: 0; transform: translateY(30px); transition: all 0.7s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }
        .counter { font-variant-numeric: tabular-nums; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="#" class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="BioLuxe Logo" class="h-8 w-auto brightness-0 invert" id="nav-logo">
        </a>
        <div class="hidden md:flex items-center gap-8">
            <a href="#proses" class="text-sm font-medium text-white/80 hover:text-white transition">Proses</a>
            <a href="#dampak" class="text-sm font-medium text-white/80 hover:text-white transition">Dampak</a>
            <a href="#produk" class="text-sm font-medium text-white/80 hover:text-white transition">Produk</a>
            <a href="#kontak" class="text-sm font-medium text-white/80 hover:text-white transition">Kontak</a>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-white/80 hover:text-white transition hidden md:inline">Masuk</a>
            <a href="{{ route('register') }}" class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-full transition shadow-lg shadow-green-500/25">Daftar</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero-bg relative min-h-screen flex items-center justify-center">
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-gray-900"></div>
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto pt-20">
        <div class="inline-block px-5 py-2 glass rounded-full mb-8 fade-up">
            <span class="text-xs font-bold text-green-400 uppercase tracking-[0.2em]">Alchemical Refinement</span>
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6 fade-up">
            Emas Cair dari Limbah<br><span class="text-green-400">Organik.</span>
        </h1>
        <p class="text-lg md:text-xl text-white/70 max-w-2xl mx-auto mb-10 fade-up">
            Mengubah limbah organik sehari-hari menjadi Pupuk Organik Cair (POC) premium melalui proses fermentasi ilmiah yang tepat.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center fade-up">
            <a href="#kontak" class="inline-flex items-center gap-2 px-8 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full transition shadow-xl shadow-green-500/30 text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Jual Sampah Anda
            </a>
            <a href="#produk" class="inline-flex items-center gap-2 px-8 py-4 glass text-white font-bold rounded-full hover:bg-white/15 transition text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Beli POC
            </a>
        </div>
    </div>
</section>

<!-- Edukasi & Proses Section -->
<section id="proses" class="py-24 bg-gray-50 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Pengenalan POC -->
        <div class="flex flex-col lg:flex-row gap-16 items-center mb-24">
            <div class="lg:w-1/2 fade-up">
                <span class="text-xs font-bold text-green-600 uppercase tracking-[0.2em] mb-3 block">Mengenal BioLuxe</span>
                <h2 class="text-4xl md:text-5xl font-black mb-6 text-gray-900 leading-tight">Apa itu <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-400">POC?</span></h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    <strong>Pupuk Organik Cair (POC)</strong> adalah nutrisi cair pekat yang diekstrak secara alami melalui proses fermentasi anaerobik dari limbah organik terpilih. Berbeda dengan pupuk kimia, POC BioLuxe tidak hanya memberikan nutrisi langsung pada tanaman, tetapi juga memperbaiki struktur biologi tanah secara berkesinambungan.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition">
                        <div class="bg-green-100 p-2.5 rounded-xl text-green-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Ramah Lingkungan</h4>
                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">100% bahan alami, nol residu kimia pada tanah.</p>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition">
                        <div class="bg-green-100 p-2.5 rounded-xl text-green-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Cepat Diserap</h4>
                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">Nutrisi ionik yang langsung dapat diserap akar.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2 w-full fade-up">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                    <div class="absolute inset-0 bg-green-600 mix-blend-overlay opacity-20 group-hover:opacity-0 transition-opacity duration-500 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1592424001815-568e61e0bb5d?auto=format&fit=crop&q=80&w=800" alt="Edukasi POC Organik" class="object-cover w-full aspect-[4/3] transform group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent z-10"></div>
                    <div class="absolute bottom-8 left-8 right-8 text-white z-20">
                        <p class="font-medium text-lg leading-tight">Menciptakan ekosistem berkelanjutan untuk masa depan agrikultur.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses Pembuatan -->
        <div class="text-center mb-16 fade-up">
            <h2 class="text-3xl md:text-4xl font-black mt-3">Transformasi <span class="text-green-500">Alkimia</span></h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg">Bagaimana kami merubah sisa makanan harian Anda menjadi cairan emas premium untuk tanaman.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative mt-10">
            <!-- Connecting line for desktop -->
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gradient-to-r from-green-100 via-green-400 to-green-100 transform -translate-y-1/2 z-0 opacity-40"></div>
            
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-up z-10 relative group">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg border-4 border-white">1</div>
                <div class="w-20 h-20 bg-green-50 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-center text-gray-900">Koleksi Limbah</h3>
                <p class="text-gray-500 text-sm leading-relaxed text-center">Pemilahan ketat limbah organik rumah tangga. Kami hanya memproses kulit buah, sayuran, dan bahan organik bebas kontaminan plastik atau kimia.</p>
            </div>
            
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-up z-10 relative group" style="transition-delay: 100ms;">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg border-4 border-white">2</div>
                <div class="w-20 h-20 bg-green-50 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-center text-gray-900">Bio-Fermentasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed text-center">Proses dekomposisi anaerobik menggunakan bio-aktivator mikrobial selama 14 hari penuh untuk memecah materi organik menjadi makronutrien.</p>
            </div>
            
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 fade-up z-10 relative group" style="transition-delay: 200ms;">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg border-4 border-white">3</div>
                <div class="w-20 h-20 bg-green-50 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-center text-gray-900">Ekstraksi Premium</h3>
                <p class="text-gray-500 text-sm leading-relaxed text-center">Penyaringan multi-tahap canggih menghasilkan cairan emas padat nutrisi, bebas patogen, dan siap diserap sempurna oleh tanaman.</p>
            </div>
        </div>
    </div>
</section>

<!-- Dampak Section -->
<section id="dampak" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 fade-up">
            <span class="text-xs font-bold text-green-600 uppercase tracking-[0.2em]">Dampak Nyata</span>
            <h2 class="text-4xl md:text-5xl font-black mt-3">Angka yang <span class="text-green-500">Berbicara</span></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 fade-up">
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-black text-green-600 counter" data-target="12450">0</p>
                <p class="text-sm text-gray-500 mt-2 font-medium">Liter POC Diproduksi</p>
            </div>
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-black text-green-600 counter" data-target="8200">0</p>
                <p class="text-sm text-gray-500 mt-2 font-medium">Kg Sampah Terselamatkan</p>
            </div>
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-black text-green-600 counter" data-target="340">0</p>
                <p class="text-sm text-gray-500 mt-2 font-medium">Petani Terbantu</p>
            </div>
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-black text-green-600 counter" data-target="95">0</p>
                <p class="text-sm text-gray-500 mt-2 font-medium">% Tingkat Kepuasan</p>
            </div>
        </div>
    </div>
</section>

<!-- Produk Section -->
<section id="produk" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20 fade-up">
            <span class="text-xs font-bold text-green-600 uppercase tracking-[0.2em] bg-green-50 px-4 py-1.5 rounded-full inline-block mb-4">Katalog</span>
            <h2 class="text-4xl md:text-5xl font-black mb-6 text-gray-900">Formula <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-400">BioLuxe</span></h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">Pilih volume yang sesuai dengan kebutuhan ruang hijau Anda. Setiap tetesnya diformulasikan untuk merangsang pertumbuhan vegetatif dan generatif secara maksimal.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6 lg:gap-8 items-end">
            <!-- Product 1 -->
            <div class="bg-gray-50 rounded-[2rem] p-2 shadow-sm hover:shadow-xl transition-all duration-300 fade-up group">
                <div class="bg-white rounded-[1.5rem] p-8 h-full border border-gray-100 flex flex-col">
                    <div class="w-full h-48 bg-gradient-to-b from-green-50 to-white rounded-2xl flex items-center justify-center mb-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-green-100/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="text-center relative z-10 transform group-hover:scale-110 transition-transform duration-500">
                            <div class="text-6xl font-black text-green-600 drop-shadow-sm">500</div>
                            <div class="text-sm font-bold text-green-500 tracking-widest mt-1">MILILITER</div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Urban Garden</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Sempurna untuk tanaman hias indoor, sukulen, dan balkon kecil. Dilengkapi tutup botol presisi.</p>
                    </div>
                    <ul class="space-y-3 mb-8 flex-grow text-sm text-gray-600">
                        <li class="flex items-center gap-3">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Mencakup ±10 tanaman
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Pemakaian 1-2 bulan
                        </li>
                    </ul>
                    <div class="flex items-end justify-between mt-auto pt-6 border-t border-gray-100">
                        <div>
                            <span class="block text-xs font-medium text-gray-400 mb-1">Harga Retail</span>
                            <p class="text-3xl font-black text-gray-900">Rp 15<span class="text-lg text-gray-500">.000</span></p>
                        </div>
                        <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1.5 rounded-lg font-semibold">Botol</span>
                    </div>
                </div>
            </div>

            <!-- Product 2 (Highlighted) -->
            <div class="bg-gradient-to-b from-green-400 to-green-600 rounded-[2rem] p-1.5 shadow-2xl hover:shadow-green-500/30 transition-all duration-300 fade-up relative md:-translate-y-4 group z-10" style="transition-delay: 100ms;">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs font-bold px-5 py-2 rounded-full shadow-lg flex items-center gap-2 whitespace-nowrap z-20">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    PILIHAN FAVORIT
                </div>
                <div class="bg-white rounded-[1.6rem] p-8 h-full flex flex-col relative overflow-hidden">
                    <div class="w-full h-56 bg-gradient-to-b from-green-50 to-emerald-50 rounded-2xl flex items-center justify-center mb-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-green-200/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="text-center relative z-10 transform group-hover:scale-110 transition-transform duration-500">
                            <div class="text-7xl font-black text-green-600 drop-shadow-md">1</div>
                            <div class="text-sm font-bold text-green-500 tracking-widest mt-1">LITER</div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Home Farming</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Kapasitas ideal untuk pekarangan, kebun sayur mini, dan hidroponik skala kecil tangga. <span class="font-medium text-green-600">Best value.</span></p>
                    </div>
                    <ul class="space-y-3 mb-8 flex-grow text-sm text-gray-600">
                        <li class="flex items-center gap-3 font-medium text-green-700">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Lebih hemat 15%
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Mencakup ±25 tanaman
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Pemakaian 2-3 bulan
                        </li>
                    </ul>
                    <div class="flex items-end justify-between mt-auto pt-6 border-t border-gray-100">
                        <div>
                            <span class="block text-xs font-medium text-green-600 mb-1">Harga Retail</span>
                            <p class="text-4xl font-black text-gray-900">Rp 25<span class="text-xl text-gray-500">.000</span></p>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1.5 rounded-lg font-bold border border-green-200">Botol Plus</span>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-gray-50 rounded-[2rem] p-2 shadow-sm hover:shadow-xl transition-all duration-300 fade-up group" style="transition-delay: 200ms;">
                <div class="bg-white rounded-[1.5rem] p-8 h-full border border-gray-100 flex flex-col">
                    <div class="w-full h-48 bg-gradient-to-b from-green-50 to-white rounded-2xl flex items-center justify-center mb-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-green-100/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="text-center relative z-10 transform group-hover:scale-110 transition-transform duration-500">
                            <div class="text-6xl font-black text-green-600 drop-shadow-sm">5</div>
                            <div class="text-sm font-bold text-green-500 tracking-widest mt-1">LITER</div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Agro Estate</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Dirancang khusus untuk pertanian komersial, perkebunan luas, dan green house. Efisiensi tinggi.</p>
                    </div>
                    <ul class="space-y-3 mb-8 flex-grow text-sm text-gray-600">
                        <li class="flex items-center gap-3">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Mencakup area luas (Hektar)
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="bg-green-100 rounded-full p-1"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                            Cocok untuk sistem irigasi
                        </li>
                    </ul>
                    <div class="flex items-end justify-between mt-auto pt-6 border-t border-gray-100">
                        <div>
                            <span class="block text-xs font-medium text-gray-400 mb-1">Harga Grosir</span>
                            <p class="text-3xl font-black text-gray-900">Rp 100<span class="text-lg text-gray-500">.rb</span></p>
                        </div>
                        <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1.5 rounded-lg font-semibold">Jerigen</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center fade-up bg-green-50 p-6 rounded-2xl inline-block mx-auto max-w-3xl border border-green-100">
            <p class="text-green-800 text-sm font-medium flex items-center justify-center gap-3 flex-wrap">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Semua produk BioLuxe dijamin 100% bebas bahan kimia sintetis dan telah melalui standarisasi laboratorium.
            </p>
        </div>
    </div>
</section>

<!-- CTA / Kontak -->
<section id="kontak" class="py-24 bg-gray-900 text-white">
    <div class="max-w-4xl mx-auto px-6 text-center fade-up">
        <span class="text-xs font-bold text-green-400 uppercase tracking-[0.2em]">Hubungi Kami</span>
        <h2 class="text-4xl md:text-5xl font-black mt-3 mb-6">Siap Mengubah <span class="text-green-400">Sampah</span> Jadi <span class="text-green-400">Emas?</span></h2>
        <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">Hubungi kami untuk menjual sampah organik Anda atau untuk membeli POC premium dalam jumlah besar.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                <svg class="w-8 h-8 text-green-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <p class="text-sm text-gray-400">Telepon</p>
                <p class="font-bold">0812-3456-7890</p>
            </div>
            <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                <svg class="w-8 h-8 text-green-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <p class="text-sm text-gray-400">Email</p>
                <p class="font-bold">info@sistempoc.id</p>
            </div>
            <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                <svg class="w-8 h-8 text-green-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <p class="text-sm text-gray-400">Lokasi</p>
                <p class="font-bold">Bandung, Jawa Barat</p>
            </div>
        </div>
        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full transition shadow-xl shadow-green-500/30 text-lg">
            Gabung Sekarang
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-950 text-white py-10 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="BioLuxe Logo" class="h-7 w-auto brightness-0 invert">
            </div>
            <div class="flex gap-8 text-xs text-gray-500 uppercase tracking-wider font-medium">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
                <a href="#" class="hover:text-white transition">Sustainability Report</a>
            </div>
        </div>
        <div class="text-center mt-8 text-xs text-gray-600">© {{ date('Y') }} Sistem POC Laboratory. Pemurnian Alkimia Limbah.</div>
    </div>
</footer>

<script>
// Navbar scroll effect
const navbar = document.getElementById('navbar');
const navLogo = document.getElementById('nav-logo');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-sm');
        navbar.querySelectorAll('a:not(.bg-green-500)').forEach(a => { a.classList.remove('text-white/80','text-white'); a.classList.add('text-gray-700'); });
        if (navLogo) { navLogo.classList.remove('brightness-0', 'invert'); }
    } else {
        navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-sm');
        navbar.querySelectorAll('a:not(.bg-green-500)').forEach(a => { a.classList.remove('text-gray-700'); a.classList.add('text-white/80'); });
        if (navLogo) { navLogo.classList.add('brightness-0', 'invert'); }
    }
});

// Fade-up on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

// Counter animation
function animateCounter(el, target, suffix = '') {
    let current = 0;
    const step = Math.ceil(target / 60);
    const timer = setInterval(() => {
        current += step;
        if (current >= target) { current = target; clearInterval(timer); }
        el.textContent = current.toLocaleString('id-ID') + suffix;
    }, 25);
}

// Hero counter
setTimeout(() => animateCounter(document.getElementById('hero-counter'), 12450, ' L'), 500);

// Stats counters
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            const target = parseInt(e.target.dataset.target);
            animateCounter(e.target, target);
            statsObserver.unobserve(e.target);
        }
    });
}, { threshold: 0.5 });
document.querySelectorAll('[data-target]').forEach(el => statsObserver.observe(el));
</script>
</body>
</html>
