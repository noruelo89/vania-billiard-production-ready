<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B & Ekspor | Vania Billiard</title>
    
    <meta name="description" content="Pengadaan meja billiard skala besar untuk arena, lounge, dan ekspor. Hubungi Vania Billiard untuk quotation kargo khusus dan instalasi masif.">
    <meta name="referrer" content="no-referrer">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] }, colors: { 'luxury-bg': '#0a0a0a', 'luxury-surface': '#141414', 'luxury-copper': '#C86A36', 'luxury-text': '#e5e5e5', } } }
      }
    </script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <style>
        /* Animasi Transisi Pindah Halaman */
        body { opacity: 0; transition: opacity 0.6s ease-in-out, background-color 0.5s ease, color 0.5s ease; }
        body.page-loaded { opacity: 1; }

        .hover-card-effect:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(200,106,54,0.12); border-color: #C86A36; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }
        
        /* Kustomisasi Slider (Range Input) */
        input[type=range] { -webkit-appearance: none; background: transparent; }
        input[type=range]::-webkit-slider-thumb { -webkit-appearance: none; height: 20px; width: 20px; border-radius: 50%; background: #C86A36; cursor: pointer; margin-top: -8px; box-shadow: 0 0 10px rgba(200,106,54,0.5); }
        input[type=range]::-webkit-slider-runnable-track { width: 100%; height: 4px; cursor: pointer; background: #333; border-radius: 2px; }
        
        .lang-active { font-weight: bold; color: #C86A36 !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-luxury-bg dark:text-luxury-text font-sans antialiased overflow-x-hidden transition-colors duration-500 selection:bg-luxury-copper selection:text-white flex flex-col min-h-screen">

    <nav id="master-nav" class="fixed top-0 left-0 w-full z-[100] transition-all duration-500 bg-transparent py-6 border-b border-transparent">
        <div class="px-6 md:px-12 flex justify-between items-center relative">
            
            <a href="index.php" class="relative z-50 group flex items-center gap-3 md:gap-4">
                <img src="assets/images/logo_vb.png" 
                    alt="Logo" 
                    class="h-8 md:h-10 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
                
                <div class="flex flex-col">
                    <span class="text-sm md:text-lg font-serif font-bold tracking-[0.2em] uppercase text-gray-900 dark:text-white transition-colors duration-300 group-hover:text-luxury-copper">
                        Vania
                    </span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.3em] text-gray-500 dark:text-gray-400 -mt-1">
                        Billiard
                    </span>
                </div>
            </a>
            
            <div class="flex items-center space-x-4 md:space-x-8">
                <div class="hidden md:flex space-x-6 lg:space-x-8 text-xs uppercase tracking-widest font-semibold items-center">
                    
                    <a href="katalog.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_koleksi">
                        Koleksi
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                    </a>
                    
                    <a href="simulator.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_infrastruktur">
                        Simulator 2D
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                    </a>
                    
                    <a href="jurnal.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_jurnal">
                        Jurnal Kurator
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                    </a>

                    <a href="profil.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_jejak">
                        Jejak Karya
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                    </a>
                    
                    <a href="b2b.php" class="relative text-luxury-copper transition-colors py-2 border-b border-luxury-copper" data-tr="nav_b2b">
                        B2B & Ekspor
                    </a>
                    
                    <div class="flex items-center space-x-2 border-l border-gray-300 dark:border-gray-700 pl-4 lg:pl-6">
                        <button id="btn-id" onclick="setLanguage('id')" class="text-gray-900 dark:text-white hover:text-luxury-copper lang-active transition-all hover:scale-110">ID</button>
                        <span class="text-gray-400">/</span>
                        <button id="btn-en" onclick="setLanguage('en')" class="text-gray-400 hover:text-luxury-copper transition-all hover:scale-110">EN</button>
                    </div>

                    <a href="index.php#pesan" class="overflow-hidden relative group bg-luxury-copper text-white px-5 lg:px-6 py-2.5 transition-all duration-300 z-20" data-tr="nav_cta">
                        <span class="relative z-10">Konsultasi VIP</span>
                        <div class="absolute inset-0 h-full w-0 bg-[#a34b22] transition-all duration-300 ease-out group-hover:w-full z-0"></div>
                    </a>
                </div>

                <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-800 transition-all duration-300 relative z-50 hover:rotate-45">
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-800 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-gray-800 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                </button>
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-900 dark:text-white focus:outline-none relative z-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-[#0a0a0a]/95 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800 absolute w-full left-0 top-full shadow-2xl z-40 transform origin-top transition-all duration-300">
            <div class="flex flex-col px-8 py-8 space-y-6 text-xs uppercase tracking-widest font-semibold">
                <a href="katalog.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_koleksi">Koleksi</a>
                <a href="simulator.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_infrastruktur">Simulator 2D</a>
                <a href="jurnal.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_jurnal">Jurnal Kurator</a>
                <a href="profil.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_jejak">Jejak Karya</a>
                <a href="b2b.php" class="block text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_b2b">B2B & Ekspor</a>
                <div class="flex space-x-4 border-t border-gray-200 dark:border-gray-800 pt-6 mt-2">
                    <button onclick="setLanguage('id')" class="text-gray-900 dark:text-white hover:text-luxury-copper">ID</button>
                    <span class="text-gray-400">/</span>
                    <button onclick="setLanguage('en')" class="text-gray-400 hover:text-luxury-copper">EN</button>
                </div>
                <a href="index.php#pesan" class="block bg-luxury-copper text-white text-center py-4 mt-4 shadow-lg" data-tr="nav_cta">Konsultasi VIP</a>
            </div>
        </div>
    </nav>

    <section class="pt-32 md:pt-40 pb-16 px-8 md:px-20 bg-gray-100 dark:bg-[#050505] transition-colors relative overflow-hidden border-b border-gray-200 dark:border-gray-900">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-luxury-copper/5 blur-[100px] pointer-events-none hidden md:block"></div>

        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-16 items-center relative z-10">
            <div class="w-full md:w-1/2" data-aos="fade-right">
                <div class="flex items-center text-luxury-copper mb-6">
                    <div class="w-12 h-px bg-luxury-copper mr-4"></div>
                    <span class="text-xs uppercase tracking-[0.2em] font-bold">Vania Billiard B2B</span>
                </div>
                <h1 class="font-serif text-4xl md:text-6xl text-gray-900 dark:text-white leading-[1.1] mb-6">
                    Skalabilitas.<br>
                    <span class="italic text-gray-500 dark:text-gray-400">Presisi.</span> Profitabilitas.
                </h1>
                <p class="font-light text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-10">
                    Bermitra dengan kami untuk pengadaan arena berskala masif. Kami mengatur pengadaan material, kargo FCL (Full Container Load), dan standarisasi tingkat kemiringan meja untuk setiap unit bisnis Anda.
                </p>
                <div class="flex gap-4">
                    <a href="#kalkulator" class="bg-luxury-copper text-white px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#b05929] transition-all shadow-[0_5px_20px_rgba(200,106,54,0.3)]">Hitung ROI Arena</a>
                </div>
            </div>
            
            <div class="w-full md:w-1/2" data-aos="fade-left">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white dark:bg-luxury-surface p-8 border border-gray-200 dark:border-gray-800 rounded-sm">
                        <svg class="w-8 h-8 text-luxury-copper mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <h4 class="text-gray-900 dark:text-white font-bold text-sm mb-2">Skala Ekspor Crate</h4>
                        <p class="text-xs text-gray-500">Standar packing kayu ISPM 15 khusus pengiriman antar pulau dan negara.</p>
                    </div>
                    <div class="bg-white dark:bg-luxury-surface p-8 border border-gray-200 dark:border-gray-800 rounded-sm mt-8">
                        <svg class="w-8 h-8 text-luxury-copper mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h4 class="text-gray-900 dark:text-white font-bold text-sm mb-2">Volume Margin</h4>
                        <p class="text-xs text-gray-500">Struktur harga khusus untuk pengadaan komersial di atas 4 unit meja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kalkulator" class="py-24 flex-grow bg-white dark:bg-luxury-bg transition-colors">
        <div class="max-w-6xl mx-auto px-8 md:px-20">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-luxury-copper uppercase tracking-[0.2em] text-xs font-bold mb-4 block">Proyeksi Finansial</span>
                <h3 class="font-serif text-3xl md:text-4xl text-gray-900 dark:text-white mb-6">Kalkulator Potensi Laba Arena</h3>
                <p class="font-light text-gray-600 dark:text-gray-400 text-sm max-w-2xl mx-auto">
                    Simulasikan proyeksi pengembalian investasi (ROI) Anda. Atur parameter di bawah ini sesuai dengan tarif dan prediksi keramaian di kota Anda.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <div class="w-full lg:w-1/2 space-y-10 bg-gray-50 dark:bg-[#111] p-8 md:p-10 border border-gray-200 dark:border-gray-800" data-aos="fade-right">
                    
                    <div>
                        <div class="flex justify-between mb-4">
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-300">Jumlah Meja (Unit)</label>
                            <span id="val-unit" class="text-luxury-copper font-bold text-xl font-serif">10</span>
                        </div>
                        <input type="range" id="b2b-unit" min="2" max="40" value="10" class="w-full" oninput="updateROI()">
                    </div>

                    <div>
                        <div class="flex justify-between mb-4">
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-300">Tarif Sewa per Jam</label>
                            <span id="val-price" class="text-luxury-copper font-bold text-xl font-serif">Rp 40.000</span>
                        </div>
                        <input type="range" id="b2b-price" min="20000" max="150000" step="5000" value="40000" class="w-full" oninput="updateROI()">
                    </div>

                    <div>
                        <div class="flex justify-between mb-4">
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-800 dark:text-gray-300">Estimasi Tersewa per Hari</label>
                            <span id="val-hours" class="text-luxury-copper font-bold text-xl font-serif">8 Jam</span>
                        </div>
                        <input type="range" id="b2b-hours" min="2" max="24" value="8" class="w-full" oninput="updateROI()">
                    </div>
                </div>

                <div class="w-full lg:w-1/2 flex flex-col justify-center bg-luxury-copper p-8 md:p-12 text-white shadow-2xl hover-card-effect transition-all duration-500" data-aos="fade-left">
                    <p class="text-[10px] uppercase tracking-widest font-bold mb-8 opacity-80">Proyeksi Pendapatan Kotor</p>
                    
                    <div class="mb-8">
                        <p class="text-xs font-light mb-2">Potensi Pemasukan Bulanan</p>
                        <h4 id="res-monthly" class="font-serif text-4xl md:text-5xl font-bold">Rp 96.000.000</h4>
                    </div>

                    <div class="border-t border-white/20 pt-8 mb-8">
                        <p class="text-xs font-light mb-2">Estimasi Break Even Point (Balik Modal)*</p>
                        <div class="flex items-end">
                            <h4 id="res-bep" class="font-serif text-3xl font-bold mr-2">1.9</h4>
                            <span class="text-sm font-light mb-1">Bulan</span>
                        </div>
                    </div>

                    <p class="text-[9px] opacity-70 italic font-light">
                        *Asumsi harga modal meja adalah Rp 18.000.000/unit. Kalkulasi ini adalah proyeksi kotor (Gross) sebelum dikurangi biaya operasional gedung, listrik, dan gaji karyawan. Hubungi kami untuk quotation harga B2B khusus.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-8 md:px-20 bg-gray-100 dark:bg-[#050505] transition-colors border-t border-gray-200 dark:border-gray-900">
        <div class="max-w-4xl mx-auto text-center mb-16" data-aos="fade-up">
            <h3 class="font-serif text-3xl text-gray-900 dark:text-white mb-4">Request Quotation Pengadaan</h3>
            <p class="font-light text-gray-600 dark:text-gray-400 text-sm">Tim kurator B2B kami akan menyusun proposal penawaran resmi, membedah spesifikasi komponen, dan merancang timeline logistik ekspor/domestik untuk proyek Anda.</p>
        </div>

        <div class="max-w-3xl mx-auto bg-white dark:bg-luxury-surface p-8 md:p-12 border border-gray-200 dark:border-gray-800 shadow-xl" data-aos="fade-up" data-aos-delay="100">
            <form action="submit_lead.php" method="POST" class="space-y-8">
                <input type="hidden" name="segmen" value="b2b_spesifik">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2">Nama Entitas / Perusahaan</label>
                        <input type="text" name="perusahaan" required class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2">Nama Penghubung (PIC)</label>
                        <input type="text" name="nama" required class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2">Nomor WhatsApp Valid</label>
                        <input type="tel" name="nomor_wa" required class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2">Lokasi Arena (Kota/Negara)</label>
                        <input type="text" name="kota" required class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 mb-2">Spesifikasi Kebutuhan & Target Pembukaan Arena</label>
                    <textarea name="pesan_tambahan" rows="3" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper text-sm" placeholder="Contoh: Butuh 15 Unit Meja 9ft. Rencana opening arena bulan Agustus 2026."></textarea>
                </div>

                <button type="submit" class="w-full bg-luxury-copper text-white font-bold uppercase tracking-widest text-sm py-4 hover:bg-[#b05929] transition-colors mt-4">
                    Kirim Permintaan Proposal
                </button>
            </form>
        </div>
    </section>

<footer class="bg-[#050505] pt-20 pb-10 border-t border-gray-900 transition-colors">
        <div class="max-w-7xl mx-auto px-8 md:px-12 grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            
            <div class="md:col-span-1">
                <a href="index.php" class="inline-block mb-6 group">
                    <img src="assets/images/logo_vb.png" 
                         alt="Vania Billiard" 
                         class="h-10 w-auto object-contain opacity-90 group-hover:opacity-100 transition-opacity duration-300 brightness-0 invert">
                </a>
                <p class="font-light text-gray-400 text-xs leading-relaxed" data-tr="footer_desc">
                    Bukan sekadar manufaktur massal. Kami adalah kurator meja billiard turnamen yang memastikan setiap batu slate dan rangka kayu terkalibrasi presisi sebelum mencapai ruang eksklusif Anda.
                </p>
            </div>

            <div>
                <h4 class="text-white text-[10px] font-bold uppercase tracking-widest mb-6" data-tr="footer_nav_1">Eksplorasi</h4>
                <ul class="space-y-4 text-xs font-light text-gray-400">
                    <li><a href="katalog.php" class="hover:text-luxury-copper transition">Koleksi Meja</a></li>
                    <li><a href="simulator.php" class="hover:text-luxury-copper transition">Simulator Ruangan</a></li>
                    <li><a href="profil.php" class="hover:text-luxury-copper transition">Jejak Karya (Galeri)</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white text-[10px] font-bold uppercase tracking-widest mb-6" data-tr="footer_nav_2">Operasional & Logistik</h4>
                <ul class="space-y-4 text-xs font-light text-gray-400">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 mr-3 text-luxury-copper shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Pusat Logistik: Ambarawa<br>Jangkauan Teknisi: Semarang Raya</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>kurator@vaniabilliard.com</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Senin - Sabtu (09:00 - 17:00 WIB)</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white text-[10px] font-bold uppercase tracking-widest mb-6" data-tr="footer_nav_3">Sosial Media</h4>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-luxury-copper hover:border-luxury-copper transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.88z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-luxury-copper hover:border-luxury-copper transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-900 pt-8 mt-8 flex justify-center items-center text-[10px] uppercase tracking-[0.2em] text-gray-600">
            <p>&copy; 2026 Vania Billiard. Kurasi Spesifik. Presisi Absolut.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>
    <script src="lang.js"></script>
    <script>
        // Init Plugins
        document.addEventListener('DOMContentLoaded', () => { AOS.init({ once: true, duration: 1000 }); });
        
        if (typeof Lenis !== 'undefined') {
            const lenis = new Lenis({ duration: 1.2 });
            function raf(time) { lenis.raf(time); requestAnimationFrame(raf); } requestAnimationFrame(raf);
        }

        // ANIMASI FADE-IN HALAMAN
        window.addEventListener('load', function() {
            document.body.classList.add('page-loaded'); 
        });

        // THEME TOGGLE & SMOOTH TRANSITION ENGINE
        const themeBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Sinkronisasi Ikon Saat Pertama Dimuat
        if (document.documentElement.classList.contains('dark')) {
            if(lightIcon) lightIcon.classList.remove('hidden');
        } else {
            if(darkIcon) darkIcon.classList.remove('hidden');
        }

        if(themeBtn){
            themeBtn.addEventListener('click', function() {
                // Putar ikon dengan animasi halus
                themeBtn.classList.add('rotate-180');
                setTimeout(() => themeBtn.classList.remove('rotate-180'), 300);

                darkIcon.classList.toggle('hidden'); 
                lightIcon.classList.toggle('hidden');
                
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark'); 
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark'); 
                    localStorage.setItem('color-theme', 'dark');
                }
            });
        }

        // ROI CALCULATOR LOGIC
        function updateROI() {
            const unit = parseInt(document.getElementById('b2b-unit').value);
            const price = parseInt(document.getElementById('b2b-price').value);
            const hours = parseInt(document.getElementById('b2b-hours').value);
            
            // Update Teks Label
            document.getElementById('val-unit').innerText = unit;
            document.getElementById('val-price').innerText = "Rp " + price.toLocaleString('id-ID');
            document.getElementById('val-hours').innerText = hours + " Jam";

            // Kalkulasi Logika
            const dailyRevenue = unit * price * hours;
            const monthlyRevenue = dailyRevenue * 30;
            
            // Tampilkan Pemasukan Bulanan
            document.getElementById('res-monthly').innerText = "Rp " + monthlyRevenue.toLocaleString('id-ID');

            // Kalkulasi BEP (Asumsi Modal Meja Abimanyu Pro sekitar Rp 18.000.000/unit)
            const assumedTableCost = 18000000;
            const totalInvestment = unit * assumedTableCost;
            
            let bep = totalInvestment / monthlyRevenue;
            document.getElementById('res-bep').innerText = bep.toFixed(1);
        }
        // Initialize values on load
        updateROI();

        // DYNAMIC NAVBAR SCROLL EFFECT
        const masterNav = document.getElementById('master-nav');
        if(masterNav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    masterNav.classList.remove('bg-transparent', 'py-6', 'border-transparent');
                    masterNav.classList.add('bg-white/85', 'dark:bg-[#0a0a0a]/85', 'backdrop-blur-md', 'py-4', 'border-gray-200', 'dark:border-gray-800', 'shadow-sm');
                } else {
                    masterNav.classList.add('bg-transparent', 'py-6', 'border-transparent');
                    masterNav.classList.remove('bg-white/85', 'dark:bg-[#0a0a0a]/85', 'backdrop-blur-md', 'py-4', 'border-gray-200', 'dark:border-gray-800', 'shadow-sm');
                }
            });
        }

        // MOBILE MENU LOGIC
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if(mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>