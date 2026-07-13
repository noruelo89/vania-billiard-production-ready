<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Karya | Vania Billiard</title>
    
    <meta name="description" content="Portofolio dan dedikasi Vania Billiard dalam mengkurasi dan menginstalasi meja turnamen premium di seluruh Indonesia.">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] }, colors: { 'luxury-bg': '#0a0a0a', 'luxury-surface': '#141414', 'luxury-copper': '#C86A36', 'luxury-text': '#e5e5e5', } } } }
    </script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
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
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }
        
        .lang-active { font-weight: bold; color: #C86A36 !important; }

        /* Efek Meluncur (Slide Down) Super Mulus untuk Akordion FAQ */
        .faq-content-wrapper {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.4s ease-out;
        }
        .faq-content-wrapper.open {
            grid-template-rows: 1fr;
        }
        .faq-content-inner {
            overflow: hidden;
        }

        /* Animasi Kategori Berganti */
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up-fade {
            animation: slideUpFade 0.4s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-luxury-bg dark:text-luxury-text font-sans antialiased selection:bg-luxury-copper selection:text-white flex flex-col min-h-screen">

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

                    <a href="profil.php" class="relative text-luxury-copper transition-colors py-2 border-b border-luxury-copper" data-tr="nav_jejak">
                        Jejak Karya
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
                <a href="jurnal.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_jurnal">Jurnal Kurator</a>
                <a href="profil.php" class="block text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_jejak">Jejak Karya</a>
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

    <header class="pt-36 pb-16 px-8 md:px-20 max-w-5xl mx-auto text-center" data-aos="fade-up">
        <span class="text-luxury-copper uppercase tracking-[0.3em] text-xs font-bold mb-4 block">Identitas Entitas</span>
        <h2 class="font-serif text-4xl md:text-5xl text-gray-900 dark:text-white mb-8">Bukan Sekadar Manufaktur, <br>Kami Adalah Kurator.</h2>
        <div class="w-16 h-px bg-luxury-copper mx-auto mb-8"></div>
        <p class="font-light text-gray-600 dark:text-gray-400 text-sm md:text-base leading-relaxed mb-6 text-justify md:text-center">
            Banyak pabrik memproduksi ratusan meja setiap bulannya dengan orientasi kuantitas. Di <b>Vania Billiard</b>, filosofi kami bertolak belakang. Berakar di Ambarawa, Jawa Tengah, kami memposisikan diri sebagai kurator spesifik. Tugas kami adalah mengeliminasi meja cacat produksi, menyortir batu <i>slate</i> tanpa retakan, dan mengawal langsung proses pengiriman hingga meja tersebut berdiri presisi di ruangan Anda.
        </p>
        <p class="font-light text-gray-600 dark:text-gray-400 text-sm md:text-base leading-relaxed text-justify md:text-center">
            Sebuah meja billiard kelas turnamen hanya akan bekerja maksimal jika dirakit oleh teknisi yang mengerti <i>leveling</i> 100%. Kami memberikan layanan purna jual dan dedikasi personal yang seringkali diabaikan oleh pabrik raksasa.
        </p>
    </header>

    <main class="flex-grow py-16 bg-gray-100 dark:bg-luxury-surface border-y border-gray-200 dark:border-gray-900">
        <div class="max-w-7xl mx-auto px-8 md:px-12">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-12 gap-4">
                <h3 class="font-serif text-3xl text-gray-900 dark:text-white">Jejak Karya (Instalasi Real)</h3>
                <span class="text-[10px] uppercase tracking-widest text-gray-500 border border-gray-300 dark:border-gray-700 px-3 py-1">Semarang Raya & Sekitarnya</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="relative group overflow-hidden cursor-zoom-in rounded-sm shadow-md" data-aos="fade-up" onclick="openLightbox('assets/images/placeholder.webp')">
                    <div class="w-full aspect-square bg-gray-200 dark:bg-black flex items-center justify-center text-gray-500 italic text-xs group-hover:scale-105 transition-transform duration-700">
                        [Foto Instalasi Abimanyu 9ft di Private Lounge]
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 pointer-events-none">
                        <div>
                            <p class="text-white font-bold text-sm">Abimanyu Gen 5 Pro</p>
                            <p class="text-luxury-copper text-xs uppercase tracking-widest">Semarang, Jawa Tengah</p>
                        </div>
                    </div>
                </div>

                <div class="relative group overflow-hidden cursor-zoom-in rounded-sm shadow-md" data-aos="fade-up" data-aos-delay="100" onclick="openLightbox('assets/images/placeholder.webp')">
                    <div class="w-full aspect-square bg-gray-300 dark:bg-[#111] flex items-center justify-center text-gray-500 italic text-xs group-hover:scale-105 transition-transform duration-700">
                        [Foto Custom 8ft di Ruang Keluarga]
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 pointer-events-none">
                        <div>
                            <p class="text-white font-bold text-sm">Custom 8ft Mahogani</p>
                            <p class="text-luxury-copper text-xs uppercase tracking-widest">Ambarawa</p>
                        </div>
                    </div>
                </div>

                <div class="relative group overflow-hidden cursor-zoom-in rounded-sm shadow-md" data-aos="fade-up" data-aos-delay="200" onclick="openLightbox('assets/images/placeholder.webp')">
                    <div class="w-full aspect-square bg-gray-200 dark:bg-black flex items-center justify-center text-gray-500 italic text-xs group-hover:scale-105 transition-transform duration-700">
                        [Foto Close-up Teknisi Vania Billiard Waterpass]
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 pointer-events-none">
                        <div>
                            <p class="text-white font-bold text-sm">Proses Kalibrasi Presisi</p>
                            <p class="text-luxury-copper text-xs uppercase tracking-widest">Salatiga</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

<section class="py-24 bg-gray-50 dark:bg-luxury-surface border-t border-gray-200 dark:border-gray-900 transition-colors">
        <div class="max-w-6xl mx-auto px-8 md:px-12 flex flex-col md:flex-row gap-12 lg:gap-20">
            
            <div class="w-full md:w-1/3" data-aos="fade-right">
                <span class="text-luxury-copper uppercase tracking-[0.3em] text-[10px] font-bold mb-4 block">Pusat Informasi</span>
                <h3 class="font-serif text-3xl md:text-4xl text-gray-900 dark:text-white mb-8">FAQ</h3>
                
                <div class="flex flex-col space-y-3">
                    <button onclick="switchFaqTab('umum')" id="tab-umum" class="faq-cat-btn flex items-center text-left px-5 py-4 text-xs uppercase tracking-widest font-bold border-l-2 border-luxury-copper text-luxury-copper bg-luxury-copper/5 transition-all duration-300">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pertanyaan Umum
                    </button>
                    <button onclick="switchFaqTab('logistik')" id="tab-logistik" class="faq-cat-btn flex items-center text-left px-5 py-4 text-xs uppercase tracking-widest font-bold border-l-2 border-transparent text-gray-500 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        Logistik & Instalasi
                    </button>
                    <button onclick="switchFaqTab('garansi')" id="tab-garansi" class="faq-cat-btn flex items-center text-left px-5 py-4 text-xs uppercase tracking-widest font-bold border-l-2 border-transparent text-gray-500 hover:text-gray-900 dark:hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Garansi & Servis
                    </button>
                </div>
            </div>

            <div class="w-full md:w-2/3" data-aos="fade-left">
                
                <div id="faq-umum" class="faq-group block animate-[fadeIn_0.4s_ease-out]">
                    <div class="border-b border-gray-200 dark:border-gray-800">
                        <button class="faq-accordion w-full py-6 flex justify-between items-center text-left focus:outline-none group">
                            <span class="font-bold text-sm md:text-base text-gray-800 dark:text-gray-200 group-hover:text-luxury-copper transition-colors pr-4">Apakah mejanya rakitan pabrik atau buatan sendiri?</span>
                            <span class="faq-icon-box w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-luxury-copper group-hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 transform transition-transform duration-500 icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300 ease-in-out opacity-0">
                            <div class="overflow-hidden">
                                <p class="pb-6 text-sm font-light text-gray-600 dark:text-gray-400">
                                    Kami adalah kurator dan distributor resmi. Produk yang kami sediakan adalah fabrikasi mesin berstandar turnamen, bukan meja buatan tangan (DIY). Kami menyeleksi komponen terbaik seperti K-66 Cushion dan Batu Slate.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 dark:border-gray-800">
                        <button class="faq-accordion w-full py-6 flex justify-between items-center text-left focus:outline-none group">
                            <span class="font-bold text-sm md:text-base text-gray-800 dark:text-gray-200 group-hover:text-luxury-copper transition-colors pr-4">Apakah bisa beli mejanya saja tanpa aksesoris?</span>
                            <span class="faq-icon-box w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-luxury-copper group-hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 transform transition-transform duration-500 icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300 ease-in-out opacity-0">
                            <div class="overflow-hidden">
                                <p class="pb-6 text-sm font-light text-gray-600 dark:text-gray-400">
                                    Bisa. Namun, kami sangat merekomendasikan pembelian sistem <i>bundle</i> (Terima Beres) karena harganya jauh lebih efisien dibandingkan Anda membeli stik, laken, dan bola secara terpisah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="faq-logistik" class="faq-group hidden">
                    <div class="border-b border-gray-200 dark:border-gray-800">
                        <button class="faq-accordion w-full py-6 flex justify-between items-center text-left focus:outline-none group">
                            <span class="font-bold text-sm md:text-base text-gray-800 dark:text-gray-200 group-hover:text-luxury-copper transition-colors pr-4">Berapa lama proses pemasangannya?</span>
                            <span class="faq-icon-box w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-luxury-copper group-hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 transform transition-transform duration-500 icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300 ease-in-out opacity-0">
                            <div class="overflow-hidden">
                                <p class="pb-6 text-sm font-light text-gray-600 dark:text-gray-400">
                                    Untuk 1 unit meja, teknisi kami membutuhkan waktu sekitar 3 hingga 5 jam di lokasi. Waktu ini dihabiskan paling banyak pada tahap penyetelan kemiringan (Leveling) batu dan penarikan laken.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 dark:border-gray-800">
                        <button class="faq-accordion w-full py-6 flex justify-between items-center text-left focus:outline-none group">
                            <span class="font-bold text-sm md:text-base text-gray-800 dark:text-gray-200 group-hover:text-luxury-copper transition-colors pr-4">Bagaimana jika saya di luar Pulau Jawa?</span>
                            <span class="faq-icon-box w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-luxury-copper group-hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 transform transition-transform duration-500 icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300 ease-in-out opacity-0">
                            <div class="overflow-hidden">
                                <p class="pb-6 text-sm font-light text-gray-600 dark:text-gray-400">
                                    Kami melayani pengiriman nasional menggunakan Kargo khusus dengan proteksi <i>packing</i> kayu lapis baja (ISPM 15). Anda bisa menggunakan fitur "Kalkulator B2B" kami untuk melihat estimasi kasarnya.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="faq-garansi" class="faq-group hidden">
                    <div class="border-b border-gray-200 dark:border-gray-800">
                        <button class="faq-accordion w-full py-6 flex justify-between items-center text-left focus:outline-none group">
                            <span class="font-bold text-sm md:text-base text-gray-800 dark:text-gray-200 group-hover:text-luxury-copper transition-colors pr-4">Apakah ada garansi untuk meja yang dibeli?</span>
                            <span class="faq-icon-box w-8 h-8 shrink-0 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-luxury-copper group-hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 transform transition-transform duration-500 icon-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300 ease-in-out opacity-0">
                            <div class="overflow-hidden">
                                <p class="pb-6 text-sm font-light text-gray-600 dark:text-gray-400">
                                    Tentu. Untuk pemasangan yang dilakukan oleh teknisi internal Vania Billiard (Area Jateng), kami memberikan garansi <i>Leveling</i>. Jika meja terasa miring dalam 3 bulan pertama (karena pergeseran pondasi rumah), kami akan datang mengkalibrasi ulang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-24 text-center bg-white dark:bg-luxury-bg transition-colors">
        <div data-aos="fade-up">
            <h3 class="font-serif text-3xl text-gray-900 dark:text-white mb-6">Siap Menghadirkan Arena Bermain di Rumah Anda?</h3>
            <a href="index.php#pesan" class="inline-block bg-luxury-copper text-white px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#b05929] hover:shadow-[0_10px_20px_rgba(200,106,54,0.3)] transition-all duration-300">
                Jadwalkan Konsultasi VIP
            </a>
        </div>
    </section>


    <section class="bg-white dark:bg-[#050505] border-t border-gray-200 dark:border-gray-900 transition-colors">
        <div class="w-full h-[400px] relative overflow-hidden group">
            <div class="absolute inset-0 bg-black/10 dark:bg-black/40 z-10 pointer-events-none group-hover:bg-transparent transition-all duration-500"></div>
            
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8252277717466!2d110.3957271!3d-7.2605737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7081000b65bf25%3A0xcb1b6d19a27e7e!2sAmbarawa%2C%20Kabupaten%20Semarang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                class="w-full h-full grayscale-[80%] opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            <div class="absolute bottom-6 left-6 md:bottom-10 md:left-12 z-20 bg-white/95 dark:bg-luxury-surface/95 backdrop-blur-md p-6 border border-gray-200 dark:border-gray-800 shadow-2xl" data-aos="fade-up">
                <h4 class="font-serif text-xl text-gray-900 dark:text-white mb-2">Vania Billiard HQ</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-4 max-w-[250px]">Pusat Kurasi, Logistik, dan Manajemen Instalasi. Berakar di Ambarawa, melayani nasional.</p>
                <a href="https://maps.app.goo.gl/7GiaQEojWXxjXuQ6A" target="_blank" class="text-[10px] uppercase tracking-widest font-bold text-luxury-copper flex items-center hover:translate-x-1 transition-transform">
                    Buka di Google Maps <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
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

    <div id="lightbox" class="fixed inset-0 z-[110] bg-black/95 hidden items-center justify-center opacity-0 transition-opacity duration-300" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-luxury-copper text-3xl font-light focus:outline-none transition-colors">✕</button>
        <img id="lightbox-img" src="" class="max-w-[90%] max-h-[90%] object-contain scale-95 transition-transform duration-300 shadow-2xl">
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>
    <script src="lang.js"></script>
    
    <script>
        // Init AOS
        document.addEventListener('DOMContentLoaded', () => { AOS.init({ once: true, duration: 1000, offset: 50 }); });

        // Init Lenis Smooth Scroll
        if (typeof Lenis !== 'undefined') {
            const lenis = new Lenis({ duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
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
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                masterNav.classList.remove('bg-transparent', 'py-6', 'border-transparent');
                masterNav.classList.add('bg-white/85', 'dark:bg-[#0a0a0a]/85', 'backdrop-blur-md', 'py-4', 'border-gray-200', 'dark:border-gray-800', 'shadow-sm');
            } else {
                masterNav.classList.add('bg-transparent', 'py-6', 'border-transparent');
                masterNav.classList.remove('bg-white/85', 'dark:bg-[#0a0a0a]/85', 'backdrop-blur-md', 'py-4', 'border-gray-200', 'dark:border-gray-800', 'shadow-sm');
            }
        });

        // MOBILE MENU
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if(mobileBtn) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // LIGHTBOX LOGIC
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        
        function openLightbox(src) {
            // Abaikan jika src adalah placeholder text saja
            if(src && !src.includes('placeholder')) {
                lightboxImg.src = src; 
                lightbox.classList.remove('hidden'); 
                lightbox.classList.add('flex');
                setTimeout(() => { 
                    lightbox.classList.remove('opacity-0'); 
                    lightboxImg.classList.remove('scale-95'); 
                    lightboxImg.classList.add('scale-100'); 
                }, 10);
            }
        }
        
        function closeLightbox() {
            lightbox.classList.add('opacity-0'); 
            lightboxImg.classList.remove('scale-100'); 
            lightboxImg.classList.add('scale-95');
            setTimeout(() => { 
                lightbox.classList.add('hidden'); 
                lightbox.classList.remove('flex'); 
                lightboxImg.src = '';
            }, 300);
        }

// LOGIKA TAB KATEGORI FAQ
        function switchFaqTab(kategori) {
            // Sembunyikan semua tab kategori
            document.querySelectorAll('.faq-group').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('animate-[fadeIn_0.4s_ease-out]');
            });
            
            // Reset warna menu kiri
            document.querySelectorAll('.faq-cat-btn').forEach(btn => {
                btn.classList.remove('border-luxury-copper', 'text-luxury-copper', 'bg-luxury-copper/5');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // Tampilkan tab yang dipilih
            const activeGroup = document.getElementById('faq-' + kategori);
            activeGroup.classList.remove('hidden');
            // Trigger ulang animasi
            void activeGroup.offsetWidth; 
            activeGroup.classList.add('animate-[fadeIn_0.4s_ease-out]');
            
            // Warnai menu kiri yang aktif
            const activeBtn = document.getElementById('tab-' + kategori);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-luxury-copper', 'text-luxury-copper', 'bg-luxury-copper/5');
        }

        // LOGIKA AKORDION (TUTUP OTOMATIS & SLIDE MULUS)
        document.querySelectorAll('.faq-accordion').forEach(btn => {
            btn.addEventListener('click', () => {
                const answer = btn.nextElementSibling; // Mengambil div .faq-answer
                const icon = btn.querySelector('.icon-arrow');
                const iconBox = btn.querySelector('.faq-icon-box');
                
                const isOpen = answer.classList.contains('grid-rows-[1fr]');

                // 1. TUTUP SEMUA JAWABAN TERLEBIH DAHULU (Fitur Auto-Close)
                document.querySelectorAll('.faq-answer').forEach(el => {
                    el.classList.remove('grid-rows-[1fr]', 'opacity-100');
                    el.classList.add('grid-rows-[0fr]', 'opacity-0');
                });
                // Reset semua ikon
                document.querySelectorAll('.icon-arrow').forEach(el => el.classList.remove('rotate-180'));
                document.querySelectorAll('.faq-icon-box').forEach(el => {
                    el.classList.remove('bg-luxury-copper', 'text-white');
                    el.classList.add('bg-gray-100', 'dark:bg-gray-800', 'text-gray-500');
                });

                // 2. JIKA SEBELUMNYA TERTUTUP, BUKA YANG DIKLIK SAJA
                if (!isOpen) {
                    answer.classList.remove('grid-rows-[0fr]', 'opacity-0');
                    answer.classList.add('grid-rows-[1fr]', 'opacity-100');
                    
                    icon.classList.add('rotate-180');
                    iconBox.classList.remove('bg-gray-100', 'dark:bg-gray-800', 'text-gray-500');
                    iconBox.classList.add('bg-luxury-copper', 'text-white');
                }
            });
        });

    </script>
</body>
</html>