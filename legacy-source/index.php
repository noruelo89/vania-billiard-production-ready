<?php
// File: index.php
require 'db.php';

// Mengambil data produk dan kategori menggunakan SQL JOIN
$sql = "SELECT p.*, c.nama_kategori, c.tipe_pengiriman 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        ORDER BY p.id DESC LIMIT 6";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vania Billiard | Kurator Meja Premium</title>
    <link rel="icon" type="image/png" href="assets/images/logo_vb.png">
    
    <meta name="description" content="Distributor dan kurator meja billiard turnamen premium. Melayani pengiriman dan instalasi presisi area Semarang, Ambarawa, dan sekitarnya.">
    <meta name="referrer" content="no-referrer">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] },
            colors: {
              'luxury-bg': '#0a0a0a',
              'luxury-surface': '#141414',
              'luxury-copper': '#C86A36',
              'luxury-text': '#e5e5e5',
            }
          }
        }
      }
    </script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
    
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        /* Animasi Transisi Pindah Halaman & Load */
        body { opacity: 0; transition: opacity 0.6s ease-in-out, background-color 0.5s ease, color 0.5s ease; }
        body.page-loaded { opacity: 1; }

        .cursor::after { content: ''; display: inline-block; width: 2px; height: 1em; background-color: #C86A36; animation: blink 1s step-end infinite; vertical-align: middle; margin-left: 4px; }
        @keyframes blink { 50% { opacity: 0; } }
        #preloader { transition: transform 0.8s ease-in-out, opacity 0.8s ease; }
        .slide-up-fade { transform: translateY(-100%); opacity: 0; }
        .editorial-img { transition: transform 1.5s ease; cursor: zoom-in; }
        .editorial-img-container:hover .editorial-img { transform: scale(1.05); }
        .hover-card-effect:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(200,106,54,0.12); border-color: #C86A36; }
        .color-dot { transition: transform 0.2s; cursor: pointer; }
        .color-dot:hover, .color-dot.active { transform: scale(1.3); border: 2px solid white; box-shadow: 0 0 10px rgba(255,255,255,0.5); }
        .step-active .step-icon { background-color: #C86A36; border-color: #C86A36; color: white;}
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }

        /* Efek Infinite Marquee (Slider Otomatis) */
        @keyframes scroll-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-ticker {
            display: flex;
            width: max-content;
            animation: scroll-left 25s linear infinite;
        }
        .animate-ticker:hover {
            animation-play-state: paused; /* Berhenti saat di-hover mouse */
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-luxury-bg dark:text-luxury-text font-sans antialiased overflow-x-hidden transition-colors duration-500 selection:bg-luxury-copper selection:text-white">

    <div id="preloader" class="fixed inset-0 z-50 bg-white dark:bg-luxury-bg flex flex-col items-center justify-center">
        <img src="assets/images/logo_vb.png" alt="Logo" class="w-20 md:w-24 mb-6 animate-pulse">
        <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500">Fine Billiard Curators</p>
    </div>

    <div id="geo-banner" class="bg-luxury-copper text-white text-[10px] md:text-xs text-center py-2 px-4 font-bold tracking-widest uppercase hidden transition-all duration-500 z-50 relative">
        <span id="geo-text">Mendeteksi lokasi Anda...</span>
    </div>

    <nav id="master-nav" class="fixed top-0 left-0 w-full z-[100] transition-all duration-700 -translate-y-full opacity-0 bg-transparent py-6 border-b border-transparent">
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
                    
                    <a href="b2b.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_b2b">
                        B2B & Ekspor
                        <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span>
                    </a>
                    
                    <div class="flex items-center space-x-2 border-l border-gray-300 dark:border-gray-700 pl-4 lg:pl-6">
                        <button id="btn-id" onclick="setLanguage('id')" class="text-gray-900 dark:text-white hover:text-luxury-copper lang-active transition-all hover:scale-110">ID</button>
                        <span class="text-gray-400">/</span>
                        <button id="btn-en" onclick="setLanguage('en')" class="text-gray-400 hover:text-luxury-copper transition-all hover:scale-110">EN</button>
                    </div>

                    <a href="#pesan" class="overflow-hidden relative group bg-luxury-copper text-white px-5 lg:px-6 py-2.5 transition-all duration-300 z-20" data-tr="nav_cta">
                        <span class="relative z-10">Konsultasi VIP</span>
                        <div class="absolute inset-0 h-full w-0 bg-[#a34b22] transition-all duration-300 ease-out group-hover:w-full z-0"></div>
                    </a>
                </div>

                <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-800 transition-all duration-300 relative z-50">
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
                <a href="b2b.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2" data-tr="nav_b2b">B2B & Ekspor</a>
                <div class="flex space-x-4 border-t border-gray-200 dark:border-gray-800 pt-6 mt-2">
                    <button onclick="setLanguage('id')" class="text-gray-900 dark:text-white hover:text-luxury-copper">ID</button>
                    <span class="text-gray-400">/</span>
                    <button onclick="setLanguage('en')" class="text-gray-400 hover:text-luxury-copper">EN</button>
                </div>
                <a href="#pesan" class="block bg-luxury-copper text-white text-center py-4 mt-4 shadow-lg" data-tr="nav_cta">Konsultasi VIP</a>
            </div>
        </div>
    </nav>

    <section class="min-h-screen w-full flex flex-col md:flex-row pt-24">
        
        <div class="w-full md:w-1/2 h-full min-h-[60vh] md:min-h-screen flex flex-col justify-center px-8 md:px-20 pb-16 md:pb-0 relative z-10">
            <div class="w-12 h-px bg-luxury-copper mb-8 mt-8 md:mt-0"></div>
            
            <h2 class="font-serif text-4xl md:text-6xl font-bold leading-[1.1] mb-6 text-gray-900 dark:text-white">
                <span data-tr="hero_title_1">Seni Presisi</span> <br>
                <span class="italic font-light text-gray-500 dark:text-gray-400" data-tr="hero_title_2">Dalam</span> <br>
                <span class="block h-[1.5em] mt-1 md:mt-2">
                    <span id="typewriter" class="text-luxury-copper"></span>
                </span>
            </h2>
            
            <p class="font-light text-gray-600 dark:text-gray-400 text-sm md:text-base leading-relaxed max-w-md mb-10" data-tr="hero_desc">
                Menghadirkan furnitur hiburan bertaraf turnamen. Kami mengkurasi, mengirim, dan merakit presisi absolut untuk ruang eksklusif Anda.
            </p>
            
            <div class="flex flex-col gap-8">
                <a href="katalog.php" class="text-xs uppercase tracking-[0.2em] font-semibold flex items-center group w-max text-gray-900 dark:text-white">
                    <span data-tr="hero_cta_1">Eksplorasi Kurasi</span> 
                    <span class="ml-4 w-8 h-px bg-gray-900 dark:bg-white group-hover:w-16 group-hover:bg-luxury-copper transition-all duration-300"></span>
                </a>
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <button onclick="openQuiz()" class="text-[10px] md:text-xs uppercase tracking-[0.2em] font-semibold text-luxury-copper border border-luxury-copper px-6 py-3 hover:bg-luxury-copper hover:text-white hover:shadow-[0_0_15px_rgba(200,106,54,0.5)] transition-all duration-300">
                        Temukan Meja Ideal 🎯
                    </button>
                    <button onclick="openVideo()" class="flex items-center text-xs uppercase tracking-widest font-bold text-gray-900 dark:text-white hover:text-luxury-copper transition-colors group">
                        <span class="w-10 h-10 rounded-full border border-gray-300 dark:border-gray-700 flex items-center justify-center mr-3 group-hover:border-luxury-copper group-hover:bg-luxury-copper/10 transition-all">
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span data-tr="hero_cta_2">Proses Leveling</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 h-[40vh] md:h-screen relative editorial-img-container bg-gray-200 dark:bg-[#111]">
            <div class="absolute inset-0 bg-[url('assets/images/hero-bg.webp')] bg-cover bg-center bg-fixed opacity-80"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a]/80 via-transparent to-transparent z-0"></div>
            
            <div class="absolute top-[60%] left-[40%] group z-20 hidden md:block">
                <div class="w-4 h-4 bg-luxury-copper rounded-full animate-ping absolute opacity-75"></div>
                <div class="w-4 h-4 bg-luxury-copper border-2 border-white rounded-full relative cursor-pointer shadow-[0_0_10px_#C86A36]"></div>
                <div class="absolute hidden group-hover:block bottom-8 -left-16 w-56 bg-white dark:bg-luxury-surface p-4 border border-gray-200 dark:border-gray-700 shadow-2xl pointer-events-none transition-all">
                    <p class="text-xs font-bold text-gray-900 dark:text-white mb-1 uppercase tracking-widest">Worsted Cloth</p>
                    <p class="text-[10px] text-gray-600 dark:text-gray-400" data-tr="hotspot_1">Anyaman tanpa bulu, memaksimalkan laju bola tanpa friksi berlebih.</p>
                </div>
            </div>

            <div class="absolute top-[25%] right-[20%] group z-20 hidden md:block">
                <div class="w-4 h-4 bg-luxury-copper rounded-full animate-ping absolute opacity-75"></div>
                <div class="w-4 h-4 bg-luxury-copper border-2 border-white rounded-full relative cursor-pointer shadow-[0_0_10px_#C86A36]"></div>
                <div class="absolute hidden group-hover:block bottom-8 -right-10 w-56 bg-white dark:bg-luxury-surface p-4 border border-gray-200 dark:border-gray-700 shadow-2xl pointer-events-none transition-all">
                    <p class="text-xs font-bold text-gray-900 dark:text-white mb-1 uppercase tracking-widest">Leather Pocket</p>
                    <p class="text-[10px] text-gray-600 dark:text-gray-400">Jahitan kulit asli dengan redaman suara untuk kenyamanan bermain optimal.</p>
                </div>
            </div>
        </div>
    </section>

<div class="bg-[#050505] border-b border-gray-900 py-6 overflow-hidden relative z-10 flex items-center">
        <div class="absolute left-0 top-0 bottom-0 w-16 md:w-32 bg-gradient-to-r from-[#050505] to-transparent z-20 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-16 md:w-32 bg-gradient-to-l from-[#050505] to-transparent z-20 pointer-events-none"></div>

        <div class="absolute left-6 md:left-12 z-30 hidden md:block bg-[#050505] pr-6">
            <p class="text-[10px] uppercase tracking-[0.3em] text-luxury-copper font-bold whitespace-nowrap" data-tr="trust_title">Dipercaya Oleh :</p>
        </div>

        <div class="animate-ticker space-x-16 md:space-x-24 items-center opacity-40 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-500 px-12 md:pl-64 cursor-default">
            
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">VIP Lounge Semarang</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Executive Club Ambarawa</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Grand Arena</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Private Villa Bali</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Onyx Billiard</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>

            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">VIP Lounge Semarang</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Executive Club Ambarawa</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Grand Arena</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Private Villa Bali</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            <span class="text-sm md:text-base font-serif font-bold text-white tracking-widest uppercase whitespace-nowrap">Onyx Billiard</span>
            <span class="w-1.5 h-1.5 rounded-full bg-luxury-copper shrink-0"></span>
            
        </div>
    </div>

    <section class="py-24 md:py-32 bg-[#0a0a0a] border-b border-gray-900 relative overflow-hidden">
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-gray-800/30 rounded-full opacity-20 flex items-center justify-center pointer-events-none hidden lg:flex">
            <div class="w-[400px] h-[400px] border border-gray-800/40 rounded-full flex items-center justify-center animate-[spin_15s_linear_infinite]">
                <div class="w-2 h-2 bg-luxury-copper rounded-full absolute -top-1 shadow-[0_0_15px_#C86A36]"></div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-8 md:px-16 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-16 lg:gap-24">
                
                <div class="w-full lg:w-5/12 grid grid-cols-2 gap-x-8 gap-y-12">
                    <div data-aos="fade-up">
                        <div class="text-4xl md:text-5xl font-serif text-luxury-copper mb-3 flex items-center">
                            <span class="count-up font-bold" data-target="150">0</span><span class="text-3xl ml-1">+</span>
                        </div>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold" data-tr="stat_1">Unit Terinstalasi</p>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <div class="text-4xl md:text-5xl font-serif text-white mb-3 flex items-center">
                            <span class="count-up font-bold" data-target="15">0</span><span class="text-3xl ml-1">+</span>
                        </div>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold" data-tr="stat_2">Kota Jangkauan</p>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <div class="text-4xl md:text-5xl font-serif text-white mb-3 flex items-center">
                            <span class="count-up font-bold" data-target="100">0</span><span class="text-3xl ml-1">%</span>
                        </div>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold" data-tr="stat_3">Presisi Leveling</p>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="300">
                        <div class="text-4xl md:text-5xl font-serif text-luxury-copper mb-3 flex items-center">
                            <span class="count-up font-bold" data-target="24">0</span><span class="text-3xl ml-1">/7</span>
                        </div>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 font-bold" data-tr="stat_4">Dukungan Klien</p>
                    </div>
                </div>

                <div class="w-full lg:w-7/12" data-aos="fade-left">
                    <div class="mb-10">
                        <div class="flex items-center text-luxury-copper mb-4">
                            <div class="w-2 h-2 bg-luxury-copper rounded-full animate-ping mr-3"></div>
                            <span class="text-[10px] uppercase tracking-[0.2em] font-bold" data-tr="dist_title">Jejak Distribusi Logistik</span>
                        </div>
                        <h3 class="font-serif text-3xl md:text-4xl text-white mb-6 leading-tight" data-tr="dist_subtitle">Menguasai Teritori.<br>Menjaga Kualitas.</h3>
                        
                        <div class="flex flex-wrap gap-x-6 gap-y-3 text-xs font-light text-gray-400">
                            <span class="flex items-center"><svg class="w-3 h-3 text-luxury-copper mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Semarang Raya</span>
                            <span class="flex items-center text-luxury-copper font-bold"><svg class="w-3 h-3 text-luxury-copper mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Ambarawa (HQ)</span>
                            <span class="flex items-center"><svg class="w-3 h-3 text-luxury-copper mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Salatiga</span>
                            <span class="flex items-center"><svg class="w-3 h-3 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Ekspor Nasional via Kargo</span>
                        </div>
                    </div>

                    <div class="bg-[#111]/80 backdrop-blur-md border border-gray-800 p-6 shadow-2xl relative">
                        <div class="flex justify-between items-end border-b border-gray-800 pb-4 mb-4">
                            <div>
                                <p class="text-[9px] uppercase tracking-[0.2em] text-gray-500 mb-1">Aktivitas Kurator</p>
                                <p class="text-white text-sm font-serif">Live Installation Status</p>
                            </div>
                            <span class="text-green-500 text-[10px] uppercase tracking-widest font-bold flex items-center bg-green-500/10 px-2 py-1 rounded">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse mr-2"></div> Live
                            </span>
                        </div>

                        <div id="live-activities" class="space-y-4 min-h-[100px] flex flex-col justify-center">
                             <div class="w-full h-2 bg-gray-800 animate-pulse rounded"></div>
                             <div class="w-3/4 h-2 bg-gray-800 animate-pulse rounded"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="edukasi" class="py-24 bg-white dark:bg-[#111] transition-colors border-b border-gray-200 dark:border-gray-900">
        <div class="max-w-6xl mx-auto px-8 md:px-20">
            <div class="text-center mb-16">
                <span class="text-luxury-copper uppercase tracking-[0.2em] text-xs font-bold mb-4 block" data-tr="anatomi_sub">Anatomi Presisi</span>
                <h3 class="font-serif text-3xl md:text-5xl text-gray-900 dark:text-white leading-tight" data-tr="anatomi_title">Mengenal Komponen Turnamen</h3>
                <p class="font-light text-gray-600 dark:text-gray-400 text-sm mt-6 max-w-2xl mx-auto" data-tr="anatomi_desc">
                    Kemewahan sejati terletak pada detail yang tidak terlihat dari luar.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="p-8 border border-gray-200 dark:border-gray-800 hover-card-effect bg-gray-50 dark:bg-luxury-surface group transition-all duration-500" data-aos="fade-up" data-aos-delay="0">
                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-600 group-hover:text-luxury-copper transition-colors mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    <h4 class="font-bold text-gray-900 dark:text-white uppercase tracking-widest text-[11px] mb-3">Black Slate</h4>
                    <p class="text-sm font-light text-gray-600 dark:text-gray-400">Kepadatan batu alam presisi memastikan meja tidak akan melengkung seumur hidup.</p>
                </div>
                <div class="p-8 border border-gray-200 dark:border-gray-800 hover-card-effect bg-gray-50 dark:bg-luxury-surface group transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-600 group-hover:text-luxury-copper transition-colors mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    <h4 class="font-bold text-gray-900 dark:text-white uppercase tracking-widest text-[11px] mb-3">K-66 Cushion</h4>
                    <p class="text-sm font-light text-gray-600 dark:text-gray-400">Karet pantulan standar profesional. Sangat konsisten dan tidak meredam tenaga pukulan.</p>
                </div>
                <div class="p-8 border border-gray-200 dark:border-gray-800 hover-card-effect bg-gray-50 dark:bg-luxury-surface group transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-600 group-hover:text-luxury-copper transition-colors mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6.25A3.25 3.25 0 0112.25 3h.5A3.25 3.25 0 0116 6.25v12.5a3.25 3.25 0 01-3.25 3.25h-.5A3.25 3.25 0 019 18.75zM9 19H4.75A1.75 1.75 0 013 17.25V6.75A1.75 1.75 0 014.75 5H9"></path></svg>
                    <h4 class="font-bold text-gray-900 dark:text-white uppercase tracking-widest text-[11px] mb-3">Worsted Cloth</h4>
                    <p class="text-sm font-light text-gray-600 dark:text-gray-400">Laken anyaman rapat kelas dunia. Mengurangi friksi sehingga bola melaju lebih cepat dan mulus.</p>
                </div>
                <div class="p-8 border border-gray-200 dark:border-gray-800 hover-card-effect bg-gray-50 dark:bg-luxury-surface group transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-600 group-hover:text-luxury-copper transition-colors mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    <h4 class="font-bold text-gray-900 dark:text-white uppercase tracking-widest text-[11px] mb-3">Solid Frame</h4>
                    <p class="text-sm font-light text-gray-600 dark:text-gray-400">Rangka kayu keras menahan beban ratusan kilogram batu tanpa menggeser kalibrasi presisi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 bg-[#050505] relative overflow-hidden border-b border-gray-900">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-2/3 h-full bg-luxury-copper/5 blur-[120px] pointer-events-none"></div>
        <div class="max-w-4xl mx-auto px-8 text-center relative z-10" data-aos="fade-up">
            <svg class="w-10 h-10 text-luxury-copper mx-auto mb-8 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <h3 class="font-serif text-3xl md:text-5xl text-white leading-tight mb-8" data-tr="about_quote">
                "Kami tidak memproduksi meja secara massal.<br>Kami menyeleksi, menguji, dan mengkurasi presisi absolut untuk ruang eksklusif Anda."
            </h3>
            <div class="flex items-center justify-center space-x-4">
                <div class="w-12 h-px bg-gray-800"></div>
                <p class="text-gray-400 font-bold text-[10px] tracking-[0.3em] uppercase">Vania Billiard — Ambarawa</p>
                <div class="w-12 h-px bg-gray-800"></div>
            </div>
        </div>
    </section>

    <section id="koleksi" class="py-24 bg-white dark:bg-luxury-bg transition-colors border-b border-gray-200 dark:border-gray-900">
        <div class="max-w-7xl mx-auto px-8 md:px-20">
            <div class="text-center mb-20">
                <p class="text-luxury-copper uppercase tracking-[0.3em] text-xs font-bold mb-4">The Collection</p>
                <h3 class="font-serif text-4xl text-gray-900 dark:text-white">Karya Terpilih</h3>
            </div>
            
            <div class="space-y-32">
                <?php foreach ($products as $index => $product): ?>
                    <div class="flex flex-col <?= $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' ?> items-center gap-10 md:gap-16 group">
                        
                        <div class="w-full md:w-1/2">
                            <a href="detail.php?id=<?= $product['id'] ?>" class="block w-full aspect-[4/3] bg-gray-100 dark:bg-luxury-surface relative cursor-pointer editorial-img-container overflow-hidden shadow-lg hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(200,106,54,0.15)] transition-all duration-700 ease-out" data-aos="fade-up">
                                <?php if (!empty($product['image_url'])): ?>
                                    <img id="img-<?= $product['id'] ?>" src="assets/images/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['nama_produk']) ?>" loading="lazy" class="w-full h-full object-cover editorial-img opacity-90 hover:opacity-100 transition-all duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="font-serif italic text-gray-400 text-sm">[Gambar: <?= htmlspecialchars($product['nama_produk']) ?>]</span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            
                            <?php if (strpos(strtolower($product['nama_kategori']), 'meja') !== false): ?>
                            <div class="flex items-center justify-center gap-3 mt-6" data-aos="fade-up">
                                <span class="text-[10px] uppercase tracking-widest text-gray-500 mr-2">Varian Laken:</span>
                                <button onclick="changeColor('img-<?= $product['id'] ?>', 0)" class="w-5 h-5 rounded-full bg-[#1E3A8A] border-2 border-transparent color-dot active" title="Tournament Blue"></button>
                                <button onclick="changeColor('img-<?= $product['id'] ?>', 90)" class="w-5 h-5 rounded-full bg-[#065F46] border-2 border-transparent color-dot" title="Classic Green"></button>
                                <button onclick="changeColor('img-<?= $product['id'] ?>', -30)" class="w-5 h-5 rounded-full bg-[#991B1B] border-2 border-transparent color-dot" title="Burgundy Red"></button>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="w-full md:w-1/2 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-[10px] uppercase tracking-[0.2em] text-gray-500 border border-gray-300 dark:border-gray-700 px-2 py-1"><?= htmlspecialchars($product['nama_kategori']) ?></span>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-copper border border-luxury-copper px-2 py-1"><?= str_replace('_', ' ', htmlspecialchars($product['tipe_pengiriman'])) ?></span>
                            </div>
                            
                            <a href="detail.php?id=<?= $product['id'] ?>">
                                <h4 class="font-serif text-3xl text-gray-900 dark:text-white mb-6 group-hover:text-luxury-copper transition-colors"><?= htmlspecialchars($product['nama_produk']) ?></h4>
                            </a>
                            
                            <p class="font-light text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8 max-w-md">
                                <?= htmlspecialchars(mb_strimwidth($product['deskripsi'], 0, 120, '...')) ?>
                            </p>
                            <p class="text-luxury-copper font-serif italic text-xl mb-6">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                            
                            <div class="flex flex-wrap gap-4 relative z-20">
                                <a href="detail.php?id=<?= $product['id'] ?>" class="inline-flex items-center text-xs uppercase tracking-widest font-bold text-white border border-luxury-copper bg-luxury-copper px-6 py-3 hover:bg-[#b05929] hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                                    Lihat Detail & Specs
                                </a>
                                <a href="#pesan" class="inline-flex items-center text-xs uppercase tracking-widest font-bold text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 px-6 py-3 hover:border-luxury-copper hover:text-luxury-copper transition-all duration-300">
                                    Konsultasi WA
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-20 text-center">
                <a href="katalog.php" class="inline-flex items-center text-xs uppercase tracking-[0.2em] font-bold text-gray-900 dark:text-white border-b border-luxury-copper pb-1 hover:text-luxury-copper transition-colors">
                    Lihat Seluruh Koleksi <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <section id="pesan" class="py-32 px-8 md:px-20 bg-gray-50 dark:bg-luxury-surface transition-colors">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row gap-16">
            <div class="md:w-5/12" data-aos="fade-right">
                <h3 class="font-serif text-4xl text-gray-900 dark:text-white mb-6" data-tr="form_title">Undangan Diskusi.</h3>
                <p class="font-light text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-10" data-tr="form_desc">
                    Sampaikan kebutuhan Anda. Berikan detail lokasi agar tim kurator kami dapat menghitung presisi total biaya unit beserta ongkos armada khusus.
                </p>
            </div>
            
            <div class="md:w-7/12" data-aos="fade-left">
                <form action="submit_lead.php" method="POST" class="space-y-6 bg-white dark:bg-luxury-bg p-8 border border-gray-200 dark:border-gray-800 shadow-2xl">
                    <div style="display:none;"><input type="text" name="honeypot_trap" tabindex="-1" autocomplete="off"></div>

                    <div class="flex gap-4 border-b border-gray-200 dark:border-gray-800 pb-6 mb-6">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="segmen" value="personal" class="hidden peer" checked onchange="toggleB2BFields()">
                            <span class="px-6 py-2 text-[10px] sm:text-xs uppercase tracking-widest font-bold border border-gray-300 dark:border-gray-700 text-gray-500 peer-checked:bg-luxury-copper peer-checked:text-white peer-checked:border-luxury-copper transition-all">Residensial</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="segmen" value="b2b" class="hidden peer" onchange="toggleB2BFields()">
                            <span class="px-6 py-2 text-[10px] sm:text-xs uppercase tracking-widest font-bold border border-gray-300 dark:border-gray-700 text-gray-500 peer-checked:bg-luxury-copper peer-checked:text-white peer-checked:border-luxury-copper transition-all">Arena / B2B Export</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="nama" required class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm" placeholder="Nama Lengkap / Kontak Person">
                        <input type="tel" name="nomor_wa" required class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm" placeholder="Nomor WhatsApp">
                    </div>

                    <div id="b2b-fields" class="hidden space-y-6 pt-4 border-t border-gray-200 dark:border-gray-800 animate-[fadeIn_0.5s]">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="text" name="perusahaan" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm" placeholder="Nama Perusahaan / Arena">
                            <input type="number" name="estimasi_unit" min="1" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm" placeholder="Estimasi Kebutuhan (Unit)">
                        </div>
                        <input type="text" name="negara_tujuan" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm" placeholder="Negara / Kota Tujuan Ekspor">
                    </div>

                    <div id="personal-fields" class="space-y-6">
                        <input type="text" name="kota" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition text-sm" placeholder="Kota Pemasangan (Cth: Ambarawa)">
                        <select name="minat_produk" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-3 text-gray-600 dark:text-gray-400 focus:outline-none focus:border-luxury-copper transition text-sm appearance-none">
                            <option value="Konsultasi">Membutuhkan Konsultasi Logistik & Ruangan</option>
                            <?php foreach ($products as $product): ?>
                                <option value="<?= htmlspecialchars($product['nama_produk']) ?>" class="bg-white dark:bg-luxury-surface text-gray-900 dark:text-white">Tertarik pada: <?= htmlspecialchars($product['nama_produk']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-luxury-copper text-white font-bold uppercase tracking-widest text-sm py-5 hover:bg-[#b05929] hover:shadow-[0_10px_20px_rgba(200,106,54,0.3)] transition-all duration-500 mt-6" data-tr="form_btn">
                        Kirim Data ke Kurator
                    </button>
                </form>
            </div>
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

    <div id="quiz-modal" class="fixed inset-0 z-50 bg-black/95 hidden items-center justify-center opacity-0 transition-opacity duration-300">
        <div class="bg-white dark:bg-luxury-surface w-[90%] max-w-lg p-10 border border-luxury-copper relative shadow-[0_0_40px_rgba(200,106,54,0.2)]">
            <button onclick="closeQuiz()" class="absolute top-4 right-4 text-gray-500 hover:text-luxury-copper text-xl transition-colors">✕</button>
            <h3 class="font-serif text-2xl text-gray-900 dark:text-white mb-6 text-center">Bantu Kami Mengkurasi</h3>
            
            <div id="q1" class="quiz-step block animate-[fadeIn_0.5s_ease-out]">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">1. Apa fokus utama permainan Anda?</p>
                <div class="space-y-3">
                    <button onclick="nextQuiz('q1', 'q2', 'Pro')" class="w-full text-left p-4 border border-gray-300 dark:border-gray-700 hover:border-luxury-copper hover:bg-luxury-copper/5 text-sm text-gray-800 dark:text-gray-200 transition-all">Akurasi & Standar Turnamen (Pro)</button>
                    <button onclick="nextQuiz('q1', 'q2', 'Casual')" class="w-full text-left p-4 border border-gray-300 dark:border-gray-700 hover:border-luxury-copper hover:bg-luxury-copper/5 text-sm text-gray-800 dark:text-gray-200 transition-all">Hiburan Santai / Keluarga</button>
                </div>
            </div>

            <div id="q2" class="quiz-step hidden animate-[fadeIn_0.5s_ease-out]">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">2. Berapa perkiraan luas ruang kosong Anda?</p>
                <div class="space-y-3">
                    <button onclick="showQuizResult('Besar')" class="w-full text-left p-4 border border-gray-300 dark:border-gray-700 hover:border-luxury-copper hover:bg-luxury-copper/5 text-sm text-gray-800 dark:text-gray-200 transition-all">Lebih dari 4.5 x 5.8 Meter</button>
                    <button onclick="showQuizResult('Kecil')" class="w-full text-left p-4 border border-gray-300 dark:border-gray-700 hover:border-luxury-copper hover:bg-luxury-copper/5 text-sm text-gray-800 dark:text-gray-200 transition-all">Terbatas (Sekitar 4 x 5 Meter)</button>
                </div>
            </div>

            <div id="quiz-result" class="quiz-step hidden text-center animate-[fadeIn_0.5s_ease-out]">
                <p class="text-xs uppercase tracking-widest text-luxury-copper mb-2">Rekomendasi Kurator</p>
                <h4 id="result-title" class="font-serif text-3xl text-gray-900 dark:text-white mb-4"></h4>
                <p id="result-desc" class="text-sm text-gray-600 dark:text-gray-400 mb-8"></p>
                <button onclick="closeQuiz()" class="bg-luxury-copper text-white px-8 py-3 text-sm font-bold uppercase tracking-widest hover:bg-[#b05929] hover:shadow-[0_0_15px_rgba(200,106,54,0.6)] transition-all">Selesai</button>
            </div>
        </div>
    </div>

    <div id="video-modal" class="fixed inset-0 z-50 bg-black/95 hidden items-center justify-center opacity-0 transition-opacity duration-300">
        <div class="relative w-[90%] max-w-4xl bg-black border border-gray-800 p-2 shadow-2xl">
            <button onclick="closeVideo()" class="absolute -top-10 right-0 text-white hover:text-luxury-copper text-xl">✕</button>
            <div class="aspect-video w-full bg-gray-900 flex items-center justify-center text-gray-500 text-sm italic font-serif">
                [Placeholder: Embed Video YouTube Proses Leveling Teknisi Vania Billiard Di Sini]
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    
    <script src="lang.js"></script>
    
    <script>
        // Init Plugins
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ once: true, duration: 1000, offset: 50 });

            var swiper = new Swiper(".mySwiper", {
                spaceBetween: 30, centeredSlides: true,
                autoplay: { delay: 3500, disableOnInteraction: false, },
                pagination: { el: ".swiper-pagination", clickable: true, },
            });

            // Animasi Counter Angka
            const counters = document.querySelectorAll('.count-up');
            const observerOptions = { threshold: 0.5 };
            
            const countObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = +entry.target.getAttribute('data-target');
                        let count = 0;
                        const speed = target / 50;
                        const updateCount = () => {
                            count += speed;
                            if (count < target) {
                                entry.target.innerText = Math.ceil(count);
                                requestAnimationFrame(updateCount);
                            } else {
                                entry.target.innerText = target;
                            }
                        };
                        updateCount();
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => { countObserver.observe(counter); });
        });

        // THEME TOGGLE & SMOOTH TRANSITION ENGINE
        const themeBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

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

        // KOREOGRAFI LOADING, NAVBAR, DAN FADE-IN HALAMAN
        window.addEventListener('load', function() {
            document.body.classList.add('page-loaded'); // Menyalakan halaman perlahan
            
            setTimeout(() => { 
                const pre = document.getElementById('preloader'); 
                const nav = document.getElementById('master-nav');
                
                if(pre){ 
                    pre.classList.add('slide-up-fade'); 
                    setTimeout(() => { 
                        pre.style.display = 'none'; 
                        if(nav) {
                            nav.classList.remove('-translate-y-full', 'opacity-0');
                        }
                    }, 800); 
                } 
            }, 500); 
        });

        // EFEK MELAYANG NAVBAR (GLASSMORPHISM)
        const masterNav = document.getElementById('master-nav');
        if (masterNav) {
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

        // EFEK PARALLAX HERO
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroImg = document.querySelector('.editorial-img');
            if(heroImg && scrolled < window.innerHeight) {
                heroImg.style.transform = `translateY(${scrolled * 0.4}px) scale(1.05)`;
            }
        });

        // LENIS SMOOTH SCROLL
        const lenis = new Lenis({ duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
        function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
        requestAnimationFrame(raf);

        // FITUR-FITUR LAIN (GEOLOKASI, FAQ, B2B TOGGLE)
        fetch('https://ipapi.co/json/').then(res => res.json()).then(data => {
            const geoBanner = document.getElementById('geo-banner');
            const geoText = document.getElementById('geo-text');
            if (data.city && geoBanner) {
                geoBanner.classList.remove('hidden');
                const localCities = ['Semarang', 'Ambarawa', 'Salatiga', 'Ungaran'];
                if (localCities.includes(data.city)) {
                    geoText.innerHTML = `🌟 LAYANAN INSTALASI VIP TERSEDIA LANGSUNG UNTUK AREA ${data.city}`;
                } else {
                    geoText.innerHTML = `🚚 PENGIRIMAN KARGO KHUSUS TERSEDIA UNTUK AREA ${data.city}`;
                }
            }
        }).catch(err => console.log('Geolocation diblokir'));

        document.querySelectorAll('.faq-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const content = btn.nextElementSibling;
                const icon = btn.querySelector('svg');
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        function toggleB2BFields() {
            const isB2B = document.querySelector('input[name="segmen"]:checked').value === 'b2b';
            const b2bFields = document.getElementById('b2b-fields');
            const personalFields = document.getElementById('personal-fields');
            
            if(isB2B) {
                b2bFields.classList.remove('hidden'); personalFields.classList.add('hidden');
            } else {
                b2bFields.classList.add('hidden'); personalFields.classList.remove('hidden');
            }
        }

        function changeColor(imgId, hueValue) {
            const img = document.getElementById(imgId);
            if(img) {
                img.style.filter = `hue-rotate(${hueValue}deg)`;
                event.target.parentElement.querySelectorAll('.color-dot').forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');
            }
        }

        // TYPEWRITER EFFECT
        const words = ["Setiap Sudut", "Akurasi Permainan", "Ruang Personal"];
        let i = 0, timer;
        function typingEffect() {
            const el = document.getElementById('typewriter'); if(!el) return;
            let word = words[i].split("");
            var loopTyping = function() {
                if (word.length > 0) { el.innerHTML += word.shift(); } else { setTimeout(deletingEffect, 2000); return false; };
                timer = setTimeout(loopTyping, 100);
            }; loopTyping();
        }
        function deletingEffect() {
            const el = document.getElementById('typewriter'); if(!el) return;
            let word = words[i].split("");
            var loopDeleting = function() {
                if (word.length > 0) { word.pop(); el.innerHTML = word.join(""); } else { if (words.length > (i + 1)) { i++; } else { i = 0; }; setTimeout(typingEffect, 500); return false; };
                timer = setTimeout(loopDeleting, 50);
            }; loopDeleting();
        }
        setTimeout(typingEffect, 1500); 

        // LOGIKA MODAL (QUIZ, VIDEO)
        let userPreference = '';
        const quizModal = document.getElementById('quiz-modal');
        function openQuiz() { quizModal.classList.remove('hidden'); quizModal.classList.add('flex'); setTimeout(() => { quizModal.classList.remove('opacity-0'); }, 10); document.getElementById('q1').classList.remove('hidden'); document.getElementById('q2').classList.add('hidden'); document.getElementById('quiz-result').classList.add('hidden'); }
        function closeQuiz() { quizModal.classList.add('opacity-0'); setTimeout(() => { quizModal.classList.add('hidden'); quizModal.classList.remove('flex'); }, 300); }
        function nextQuiz(cId, nId, pref) { userPreference = pref; document.getElementById(cId).classList.add('hidden'); document.getElementById(nId).classList.remove('hidden'); }
        function showQuizResult(space) {
            document.getElementById('q2').classList.add('hidden'); document.getElementById('quiz-result').classList.remove('hidden');
            const title = document.getElementById('result-title'); const desc = document.getElementById('result-desc');
            if (userPreference === 'Pro' && space === 'Besar') { title.innerText = "Abimanyu Gen 5 Pro (9ft)"; desc.innerText = "Fokus turnamen. Meja 9ft dengan alas slate hitam ini akan memberikan kepuasan maksimal tanpa kompromi."; } 
            else if (space === 'Kecil') { title.innerText = "Meja Custom 7ft / 8ft"; desc.innerText = "Untuk menjaga kenyamanan ayunan stick di ruang terbatas, meja 8ft adalah pilihan logis."; } 
            else { title.innerText = "Koleksi Standar 8ft"; desc.innerText = "Sempurna untuk hiburan keluarga dengan keseimbangan ukuran arena bermain dan adaptasi ruang."; }
        }

        const vidModal = document.getElementById('video-modal');
        function openVideo() { vidModal.classList.remove('hidden'); vidModal.classList.add('flex'); setTimeout(() => vidModal.classList.remove('opacity-0'), 10); }
        function closeVideo() { vidModal.classList.add('opacity-0'); setTimeout(() => { vidModal.classList.add('hidden'); vidModal.classList.remove('flex'); }, 300); }
        
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if(mobileBtn) { mobileBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); }); }

        // ---------------------------------------------------------
        // DYNAMIC SOCIAL PROOF (Generator Aktivitas Live per 6 Jam)
        // ---------------------------------------------------------
        function generateLiveActivity() {
            const container = document.getElementById('live-activities');
            if (!container) return;

            // Database Mini untuk dirandom
            const products = [
                'Abimanyu Gen-5 Pro', 'Custom 8ft Mahogani', 'Meja 7ft Rekreasi', 
                'Inspeksi Batu Slate', 'Pemasangan Laken Worsted', 'Kalibrasi Leveling', 
                'Paket Aksesoris Pro', 'Bongkar Pasang (Relokasi)'
            ];
            const cities = [
                'Semarang', 'Ambarawa', 'Salatiga', 'Demak', 'Ungaran', 
                'Kendal', 'Jakarta (Kargo)', 'Surabaya (Kargo)', 'Bali (Kargo)', 'Medan (Kargo)'
            ];
            const statuses = [
                { text: 'Selesai', textDark: 'text-gray-500', textLight: 'text-gray-400', bgDark: 'border-gray-800', bgLight: 'border-gray-300' },
                { text: 'Proses Instalasi', textDark: 'text-green-500', textLight: 'text-green-600', bgDark: 'bg-green-500/10 border-green-500/30', bgLight: 'bg-green-50 border-green-200' },
                { text: 'Persiapan Kargo', textDark: 'text-luxury-copper', textLight: 'text-[#C86A36]', bgDark: 'bg-luxury-copper/10 border-luxury-copper/30', bgLight: 'bg-[#C86A36]/10 border-[#C86A36]/30' },
                { text: 'Tahap Kalibrasi', textDark: 'text-blue-400', textLight: 'text-blue-600', bgDark: 'bg-blue-500/10 border-blue-500/30', bgLight: 'bg-blue-50 border-blue-200' }
            ];

            // Algoritma Seed Waktu (21600000 milidetik = 6 Jam)
            // Angka seed ini akan berubah secara serentak di seluruh dunia setiap 6 jam
            const seed = Math.floor(Date.now() / 21600000); 

            // Fungsi Pseudo-Random (agar hasilnya acak tapi konsisten selama 6 jam tersebut)
            function random(seedVal) {
                let x = Math.sin(seedVal) * 10000;
                return x - Math.floor(x);
            }

            container.innerHTML = ''; // Bersihkan loading state

            // Generate 3 Aktivitas
            for (let i = 0; i < 3; i++) {
                let s = seed + i; // Ubah seed untuk setiap baris
                
                // Pilih indeks secara acak namun terikat dengan waktu (seed)
                let prodIdx = Math.floor(random(s) * products.length);
                let cityIdx = Math.floor(random(s + 1) * cities.length);
                let statIdx = Math.floor(random(s + 2) * statuses.length);

                let prod = products[prodIdx];
                let city = cities[cityIdx];
                let stat = statuses[statIdx];

                // Efek visual: Jika sedang diproses, warnanya menyala (bold)
                let isProcess = stat.text !== 'Selesai';
                let prodTitleClass = isProcess ? 'text-white dark:text-white font-bold' : 'text-gray-700 dark:text-gray-300 font-light';
                let pulseEffect = isProcess ? 'animate-pulse' : '';

                // Render HTML
                let html = `
                    <div class="flex justify-between items-center group animate-[fadeIn_0.5s_ease-out]">
                        <p class="text-xs ${prodTitleClass}">
                            <span class="text-luxury-copper font-bold mr-2 ${pulseEffect}">0${i+1}</span> ${prod}
                        </p>
                        <span class="text-[9px] uppercase tracking-widest ${stat.textDark} ${stat.bgDark} border px-2 py-0.5 rounded shadow-sm text-right max-w-[120px] truncate" title="${stat.text} (${city})">
                            ${stat.text} <br><span class="opacity-70">${city}</span>
                        </span>
                    </div>
                `;
                container.innerHTML += html;
            }
        }

        // Jalankan saat halaman dimuat
        window.addEventListener('load', () => {
            generateLiveActivity();
        });
    </script>
</body>
</html>