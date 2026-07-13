<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Kurator | Vania Billiard</title>
    
    <meta name="description" content="Wawasan, panduan teknis, dan catatan kurasi dari ahli meja billiard turnamen. Pelajari anatomi, perawatan, dan investasi meja billiard.">
    <meta name="referrer" content="no-referrer">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] }, colors: { 'luxury-bg': '#0a0a0a', 'luxury-surface': '#141414', 'luxury-copper': '#C86A36', } } }
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
        .editorial-img { transition: transform 1.5s ease; }
        .group:hover .editorial-img { transform: scale(1.05); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }
        .lang-active { font-weight: bold; color: #C86A36 !important; }
        
        /* Typography Clamp for Article Reading */
        .article-excerpt {
            display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-luxury-bg dark:text-gray-100 font-sans antialiased overflow-x-hidden transition-colors duration-500 selection:bg-luxury-copper selection:text-white flex flex-col min-h-screen">

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
                    
                    <a href="jurnal.php" class="relative text-luxury-copper transition-colors py-2 border-b border-luxury-copper" data-tr="nav_jurnal">
                        Jurnal Kurator
                    </a>

                    <a href="profil.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_jejak">
                        Jejak Karya
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                    </a>
                    
                    <a href="b2b.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_b2b">
                        B2B & Ekspor
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
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
                <a href="jurnal.php" class="block text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_jurnal">Jurnal Kurator</a>
                <a href="profil.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_jejak">Jejak Karya</a>
                <a href="b2b.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_b2b">B2B & Ekspor</a>
                <div class="flex space-x-4 border-t border-gray-200 dark:border-gray-800 pt-6 mt-2">
                    <button onclick="setLanguage('id')" class="text-gray-900 dark:text-white hover:text-luxury-copper">ID</button>
                    <span class="text-gray-400">/</span>
                    <button onclick="setLanguage('en')" class="text-gray-400 hover:text-luxury-copper">EN</button>
                </div>
                <a href="index.php#pesan" class="block bg-luxury-copper text-white text-center py-4 mt-4 shadow-lg" data-tr="nav_cta">Konsultasi VIP</a>
            </div>
        </div>
    </nav>

    <header class="pt-36 pb-16 px-8 md:px-20 bg-gray-100 dark:bg-[#050505] transition-colors border-b border-gray-200 dark:border-gray-900 text-center">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <span class="text-luxury-copper uppercase tracking-[0.3em] text-[10px] font-bold mb-4 block" data-tr="header_sub">Knowledge Base & Catatan Kurasi</span>
            <h1 class="font-serif text-4xl md:text-6xl text-gray-900 dark:text-white mb-6" data-tr="header_title">Jurnal Kurator.</h1>
            <div class="w-12 h-px bg-luxury-copper mx-auto mb-6"></div>
            <p class="font-light text-gray-600 dark:text-gray-400 text-sm leading-relaxed" data-tr="header_desc">
                Eksplorasi teknis, panduan perawatan, dan wawasan mendalam di balik mahakarya arena billiard. Ditulis langsung oleh spesialis kalibrasi Vania Billiard.
            </p>
        </div>
    </header>

    <main class="flex-grow py-16 md:py-24 bg-white dark:bg-luxury-bg transition-colors">
        <div class="max-w-7xl mx-auto px-8 md:px-12">
            
            <article class="flex flex-col lg:flex-row gap-10 mb-20 group cursor-pointer" data-aos="fade-up">
                <div class="w-full lg:w-2/3 aspect-video md:aspect-[21/9] bg-gray-200 dark:bg-luxury-surface overflow-hidden relative border border-gray-200 dark:border-gray-800 shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10 pointer-events-none"></div>
                    <div class="w-full h-full bg-gradient-to-br from-teal-900 to-gray-900 editorial-img flex items-center justify-center">
                        <span class="text-white/20 font-serif italic">Batu Slate Makro</span>
                    </div>
                    <span class="absolute bottom-6 left-6 z-20 bg-luxury-copper text-white text-[9px] uppercase tracking-widest font-bold px-3 py-1">Featured</span>
                </div>
                
                <div class="w-full lg:w-1/3 flex flex-col justify-center">
                    <div class="flex items-center space-x-3 text-[10px] uppercase tracking-widest text-gray-500 mb-4">
                        <span data-tr="cat_teknis">Panduan Teknis</span>
                        <span>&bull;</span>
                        <span>12 Mei 2026</span>
                    </div>
                    <h2 class="font-serif text-3xl md:text-4xl text-gray-900 dark:text-white mb-4 group-hover:text-luxury-copper transition-colors" data-tr="art_1_title">
                        Mengapa Leveling Meja 100% Presisi Menentukan Karir Bermain Anda
                    </h2>
                    <p class="font-light text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8 article-excerpt" data-tr="art_1_exc">
                        Banyak yang mengira bahwa pantulan bantalan karet adalah kunci utama meja billiard. Faktanya, kemiringan 0.1 derajat pada batu slate dapat merusak memori otot (muscle memory) pemain jangka panjang. Pelajari bagaimana teknisi kami menggunakan waterpass digital kalibrasi...
                    </p>
                    <span class="text-xs uppercase tracking-widest font-bold text-luxury-copper flex items-center group-hover:translate-x-2 transition-transform" data-tr="read_more">
                        Baca Selengkapnya <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </div>
            </article>

            <div class="w-full h-px bg-gray-200 dark:bg-gray-800 mb-16"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                
                <article class="group cursor-pointer flex flex-col hover-card-effect p-4 -m-4 rounded-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-full aspect-[4/3] bg-gray-200 dark:bg-luxury-surface mb-6 overflow-hidden border border-gray-200 dark:border-gray-800">
                        <div class="w-full h-full bg-gradient-to-br from-gray-800 to-black editorial-img flex items-center justify-center">
                            <span class="text-white/20 font-serif italic text-xs">Perawatan Kain</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 text-[9px] uppercase tracking-widest text-gray-500 mb-3">
                        <span class="text-luxury-copper font-bold" data-tr="cat_perawatan">Perawatan</span>
                        <span>&bull;</span>
                        <span>08 Mei 2026</span>
                    </div>
                    <h3 class="font-serif text-xl text-gray-900 dark:text-white mb-3 group-hover:text-luxury-copper transition-colors leading-snug" data-tr="art_2_title">
                        Rahasia Merawat Laken Worsted Agar Laju Bola Tetap Konsisten
                    </h3>
                    <p class="font-light text-gray-600 dark:text-gray-400 text-xs leading-relaxed article-excerpt mb-4" data-tr="art_2_exc">
                        Menyikat meja billiard tidak boleh dilakukan sembarangan. Arah sikatan yang salah dapat merusak serat tanpa bulu pada kain laken turnamen. Temukan metode pembersihan sisa kapur yang benar.
                    </p>
                </article>

                <article class="group cursor-pointer flex flex-col hover-card-effect p-4 -m-4 rounded-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-full aspect-[4/3] bg-gray-200 dark:bg-luxury-surface mb-6 overflow-hidden border border-gray-200 dark:border-gray-800">
                        <div class="w-full h-full bg-gradient-to-br from-amber-900 to-black editorial-img flex items-center justify-center">
                            <span class="text-white/20 font-serif italic text-xs">Material Rangka</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 text-[9px] uppercase tracking-widest text-gray-500 mb-3">
                        <span class="text-luxury-copper font-bold" data-tr="cat_wawasan">Wawasan</span>
                        <span>&bull;</span>
                        <span>24 Apr 2026</span>
                    </div>
                    <h3 class="font-serif text-xl text-gray-900 dark:text-white mb-3 group-hover:text-luxury-copper transition-colors leading-snug" data-tr="art_3_title">
                        MDF vs Batu Slate: Perangkap Investasi Meja Billiard Murah
                    </h3>
                    <p class="font-light text-gray-600 dark:text-gray-400 text-xs leading-relaxed article-excerpt mb-4" data-tr="art_3_exc">
                        Banyak pemula tergoda dengan harga meja billiard murah dari bahan kayu MDF. Padahal, kelembaban ruangan di Indonesia menjamin meja tersebut akan melengkung dalam waktu kurang dari 6 bulan.
                    </p>
                </article>

                <article class="group cursor-pointer flex flex-col hover-card-effect p-4 -m-4 rounded-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-full aspect-[4/3] bg-gray-200 dark:bg-luxury-surface mb-6 overflow-hidden border border-gray-200 dark:border-gray-800">
                        <div class="w-full h-full bg-gradient-to-br from-blue-900 to-black editorial-img flex items-center justify-center">
                            <span class="text-white/20 font-serif italic text-xs">Panduan Bisnis B2B</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 text-[9px] uppercase tracking-widest text-gray-500 mb-3">
                        <span class="text-luxury-copper font-bold" data-tr="cat_bisnis">Panduan Bisnis</span>
                        <span>&bull;</span>
                        <span>10 Apr 2026</span>
                    </div>
                    <h3 class="font-serif text-xl text-gray-900 dark:text-white mb-3 group-hover:text-luxury-copper transition-colors leading-snug" data-tr="art_4_title">
                        Kalkulasi ROI Arena Billiard: Standar Ekspor dan Dimensi Ideal
                    </h3>
                    <p class="font-light text-gray-600 dark:text-gray-400 text-xs leading-relaxed article-excerpt mb-4" data-tr="art_4_exc">
                        Membangun arena billiard komersial membutuhkan perhitungan tata ruang yang spesifik. Pelajari bagaimana mengatur jarak aman antar meja untuk memaksimalkan kapasitas pengunjung tanpa mengorbankan kenyamanan ayunan stik.
                    </p>
                </article>

            </div>
            
            <div class="mt-20 flex justify-center items-center space-x-4">
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 dark:border-gray-700 text-gray-400 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button class="w-10 h-10 flex items-center justify-center border border-luxury-copper bg-luxury-copper text-white font-bold text-xs">1</button>
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-luxury-copper hover:text-luxury-copper transition-colors text-xs">2</button>
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-luxury-copper hover:text-luxury-copper transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

        </div>
    </main>

    <section class="py-24 bg-gray-100 dark:bg-[#050505] transition-colors border-t border-gray-200 dark:border-gray-900">
        <div class="max-w-3xl mx-auto px-8 text-center" data-aos="fade-up">
            <svg class="w-8 h-8 text-luxury-copper mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <h3 class="font-serif text-3xl text-gray-900 dark:text-white mb-4" data-tr="news_title">Dapatkan Wawasan Eksklusif</h3>
            <p class="font-light text-gray-600 dark:text-gray-400 text-sm mb-8" data-tr="news_desc">Bergabung dengan daftar klien prioritas kami untuk menerima notifikasi produk baru, panduan teknis, dan tawaran pengadaan B2B langsung ke kotak masuk Anda.</p>
            
            <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto">
                <input type="email" placeholder="Alamat Email Anda" required class="w-full bg-white dark:bg-luxury-surface border border-gray-300 dark:border-gray-800 py-3 px-4 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm">
                <button type="submit" class="bg-luxury-copper text-white px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-[#b05929] transition-all whitespace-nowrap" data-tr="news_btn">Berlangganan</button>
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
            function raf(time) { lenis.raf(time); requestAnimationFrame(raf); } 
            requestAnimationFrame(raf);
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