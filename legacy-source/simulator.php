<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Planner Pro | Vania Billiard</title>
    
    <meta name="description" content="Simulasi interaktif ukuran ruangan meja billiard. Atur layout, tambahkan sofa, dan pastikan area ayunan stik bebas hambatan.">
    <meta name="referrer" content="no-referrer">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] }, colors: { 'luxury-bg': '#0a0a0a', 'luxury-surface': '#141414', 'luxury-copper': '#C86A36', } } }
      }
    </script>
    
    <style>
        .bg-grid-pattern {
            background-size: 25px 25px; /* 50px = 1m, 25px = 0.5m */
            background-image: linear-gradient(to right, rgba(128, 128, 128, 0.08) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(128, 128, 128, 0.08) 1px, transparent 1px);
        }
        
        .draggable { cursor: grab; touch-action: none; position: absolute; user-select: none; transition: box-shadow 0.2s, border-color 0.2s; }
        .draggable:active { cursor: grabbing; z-index: 50 !important; }
        
        .ruler-val { position: absolute; font-size: 9px; font-weight: bold; color: #C86A36; background: rgba(255,255,255,0.9); padding: 1px 4px; border-radius: 2px; pointer-events: none; z-index: 60;}
        .dark .ruler-val { background: rgba(0,0,0,0.8); color: #C86A36; }
        
        .ruler-line { position: absolute; background: #C86A36; opacity: 0.5; pointer-events: none; z-index: 59;}
        .r-top { width: 1px; left: 50%; top: 0; transform: translateX(-50%); }
        .r-bottom { width: 1px; left: 50%; bottom: 0; transform: translateX(-50%); }
        .r-left { height: 1px; top: 50%; left: 0; transform: translateY(-50%); }
        .r-right { height: 1px; top: 50%; right: 0; transform: translateY(-50%); }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }
        
        @keyframes pulse-red { 0% { background-color: rgba(239, 68, 68, 0.1); } 50% { background-color: rgba(239, 68, 68, 0.3); } 100% { background-color: rgba(239, 68, 68, 0.1); } }
        .aura-danger { border-color: #ef4444 !important; animation: pulse-red 1.5s infinite; }
        
        @keyframes pulse-orange { 0% { background-color: rgba(249, 115, 22, 0.1); } 50% { background-color: rgba(249, 115, 22, 0.3); } 100% { background-color: rgba(249, 115, 22, 0.1); } }
        .aura-warning { border-color: #f97316 !important; animation: pulse-orange 1.5s infinite; }
        
        .lang-active { font-weight: bold; color: #C86A36 !important; }
        
        .btn-delete { display: none; }
        .draggable:hover .btn-delete { display: flex; }
    </style>

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
    </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-luxury-bg dark:text-gray-100 font-sans antialiased overflow-x-hidden transition-colors duration-500 selection:bg-luxury-copper selection:text-white flex flex-col h-screen">

    <nav id="master-nav" class="fixed top-0 left-0 w-full z-[100] bg-white/95 dark:bg-[#0a0a0a]/95 backdrop-blur-md py-4 border-b border-gray-200 dark:border-gray-800 transition-colors duration-500">
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
                        <span class="absolute bottom-0 left-1/2 w-full h-[1px] bg-luxury-copper transition-all duration-300"></span>
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

    <main class="flex-grow flex flex-col lg:flex-row overflow-hidden mt-[70px]">        
        <aside class="w-full lg:w-[350px] shrink-0 bg-white dark:bg-[#050505] p-6 flex flex-col border-r border-gray-200 dark:border-gray-900 z-10 shadow-xl overflow-y-auto">
            <span class="text-luxury-copper uppercase tracking-[0.2em] text-[10px] font-bold mb-2">Interactive Tool</span>
            <h2 class="font-serif text-2xl text-gray-900 dark:text-white mb-4" data-tr="sidebar_title">Arsitektur Ruang</h2>
            
            <div class="space-y-5 flex-grow">
                <div class="bg-gray-50 dark:bg-luxury-surface p-4 border border-gray-200 dark:border-gray-800 rounded">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-luxury-copper mb-3" data-tr="step_1">1. Dimensi Denah Utama</p>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-1" data-tr="label_length">Panjang (M)</label>
                            <input type="number" id="input-length" value="6" step="0.5" min="3" max="50" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper">
                        </div>
                        <div>
                            <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-1" data-tr="label_width">Lebar (M)</label>
                            <input type="number" id="input-width" value="5" step="0.5" min="3" max="50" class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 py-2 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper">
                        </div>
                    </div>
                    <button onclick="resizeRoom()" class="w-full border border-luxury-copper text-luxury-copper hover:bg-luxury-copper hover:text-white text-[10px] font-bold uppercase tracking-widest py-2 mt-4 transition-all" data-tr="btn_apply">Terapkan Dimensi</button>
                </div>

                <div class="bg-gray-50 dark:bg-luxury-surface p-4 border border-gray-200 dark:border-gray-800 rounded">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-luxury-copper mb-3" data-tr="step_2">2. Tambah Elemen</p>
                    <div class="space-y-3">
                        <select id="obj-selector" class="w-full bg-white dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 py-2 px-3 text-xs text-gray-900 dark:text-white focus:outline-none" onchange="toggleWallInputs()">
                            <option value="table_9">Meja Turnamen 9FT (2.8x1.5m)</option>
                            <option value="table_8">Meja Residensial 8FT (2.4x1.3m)</option>
                            <option value="table_7">Meja Rekreasi 7FT (2.1x1.2m)</option>
                            <option disabled>──────────</option>
                            <option value="sofa_3">Sofa Penonton (2.2x0.8m)</option>
                            <option value="cabinet">Lemari Rak Stick (1.0x0.4m)</option>
                            <option value="pillar">Pilar Beton (0.5x0.5m)</option>
                            <option value="wall_block">Tembok Sekat Custom</option>
                        </select>
                        
                        <div id="custom-wall-inputs" class="hidden grid grid-cols-2 gap-2 bg-gray-200 dark:bg-gray-800 p-2 rounded">
                            <div><label class="text-[8px] uppercase text-gray-500">P. Tembok (M)</label><input type="number" id="wall-len" value="2" step="0.5" class="w-full text-xs p-1 bg-white dark:bg-[#111] dark:text-white"></div>
                            <div><label class="text-[8px] uppercase text-gray-500">L. Tembok (M)</label><input type="number" id="wall-wid" value="1" step="0.5" class="w-full text-xs p-1 bg-white dark:bg-[#111] dark:text-white"></div>
                        </div>

                        <button onclick="spawnObject()" class="w-full bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white text-[10px] font-bold uppercase tracking-widest py-2 hover:bg-luxury-copper hover:text-white transition-all" data-tr="btn_drop">+ Drop ke Kanvas</button>
                    </div>
                </div>

                <button onclick="smartAutoLayout()" class="w-full bg-luxury-copper text-white font-bold uppercase tracking-widest text-[11px] py-4 hover:bg-[#b05929] hover:shadow-[0_5px_15px_rgba(200,106,54,0.4)] transition-all flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    <span data-tr="btn_magic">Sihir Rekomendasi Layout</span>
                </button>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-bold uppercase tracking-widest text-[10px] text-gray-800 dark:text-gray-300">Live Inventory:</p>
                        <span id="inv-count" class="text-xs font-bold text-luxury-copper">0 Unit</span>
                    </div>
                    
                    <div class="mt-4 mb-4 p-4 bg-luxury-copper text-white rounded shadow-md">
                        <p class="text-[9px] uppercase tracking-widest mb-1 opacity-80" data-tr="est_cost">Estimasi Nilai Aset</p>
                        <p id="live-price" class="text-xl font-serif font-bold">Rp 0</p>
                        <p class="text-[8px] mt-1 opacity-60" data-tr="est_note">*Tidak termasuk kargo / custom item.</p>
                    </div>

                    <div class="text-[9px] text-gray-500 space-y-1.5 leading-relaxed">
                        <p class="flex items-center text-gray-700 dark:text-gray-400"><span class="w-2 h-2 rounded bg-green-500 mr-2 shrink-0"></span> <span data-tr="leg_1">Jarak stik aman (> 1.5 meter).</span></p>
                        <p class="flex items-center text-gray-700 dark:text-gray-400"><span class="w-2 h-2 rounded bg-orange-500 mr-2 shrink-0"></span> <span data-tr="leg_2">Toleransi (Menyenggol sofa/rak).</span></p>
                        <p class="flex items-center text-gray-700 dark:text-gray-400"><span class="w-2 h-2 rounded bg-red-500 mr-2 shrink-0 animate-pulse"></span> <b class="text-red-500 mr-1" data-tr="leg_warn">FATAL:</b> <span data-tr="leg_3">Mentok tembok / meja lain!</span></p>
                    </div>
                </div>
            </div>
        </aside>

        <section class="flex-grow bg-gray-200 dark:bg-[#111] bg-grid-pattern relative overflow-auto flex items-center justify-center p-8 cursor-crosshair" id="canvas-container">
            
            <div id="virtual-room" class="bg-white dark:bg-luxury-surface border-2 border-gray-400 dark:border-gray-700 shadow-[0_0_50px_rgba(0,0,0,0.5)] relative transition-all duration-500 flex items-center justify-center origin-center shrink-0">
                <div class="absolute top-2 left-2 text-[10px] uppercase tracking-widest font-bold text-gray-400 z-0">Denah 2D</div>
                <button onclick="clearRoom()" class="absolute top-2 right-2 text-[9px] uppercase tracking-widest font-bold text-red-500 hover:bg-red-500 hover:text-white px-2 py-1 rounded transition-colors z-50" data-tr="btn_reset">Reset Ruang</button>
            </div>

        </section>
    </main>

    <script src="lang.js"></script>
    <script>

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
                // Animasi putar tombol
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

        // Animasi Smooth Page Load
        window.addEventListener('load', () => {
            document.body.classList.add('page-loaded');
        });

        // -----------------------------------------------------------------
        // 2D PHYSICS & PLANNER ENGINE V5.0 (Raycasting & Cost Estimator)
        // -----------------------------------------------------------------
        const PIXELS_PER_METER = 50; 
        const CUE_CLEARANCE = 1.5; 
        const CUE_PX = CUE_CLEARANCE * PIXELS_PER_METER;

        // Database Objek & Harga
        const OBJ_DB = {
            'table_9': { type: 'table', w: 2.8, h: 1.5, label: '9FT', bg: 'bg-teal-800 dark:bg-teal-900 border-luxury-copper', price: 18000000 },
            'table_8': { type: 'table', w: 2.4, h: 1.3, label: '8FT', bg: 'bg-teal-800 dark:bg-teal-900 border-luxury-copper', price: 15000000 },
            'table_7': { type: 'table', w: 2.1, h: 1.2, label: '7FT', bg: 'bg-teal-800 dark:bg-teal-900 border-luxury-copper', price: 12000000 },
            'sofa_3':  { type: 'furniture', soft: true, w: 2.2, h: 0.8, label: 'SOFA', bg: 'bg-gray-700 dark:bg-gray-800 border-gray-500 rounded-lg', price: 2500000 },
            'cabinet': { type: 'furniture', soft: true, w: 1.0, h: 0.4, label: 'RAK STIK', bg: 'bg-yellow-900 border-yellow-700 rounded-sm', price: 800000 },
            'pillar':  { type: 'furniture', soft: false, w: 0.5, h: 0.5, label: 'PILAR', bg: 'bg-gray-400 dark:bg-gray-900 border-gray-600 rounded-sm', price: 0 },
            'wall_block': { type: 'furniture', soft: false, w: 2.0, h: 2.0, label: 'TEMBOK', bg: 'bg-gray-300 dark:bg-[#0a0a0a] border-gray-400 dark:border-gray-800', price: 0 },
        };

        const roomEl = document.getElementById('virtual-room');
        let draggedEl = null;
        let startX, startY, initialL, initialT;

        function toggleWallInputs() {
            const selector = document.getElementById('obj-selector').value;
            const wallInputs = document.getElementById('custom-wall-inputs');
            if(selector === 'wall_block') wallInputs.classList.remove('hidden');
            else wallInputs.classList.add('hidden');
        }

        function resizeRoom() {
            const rLen = parseFloat(document.getElementById('input-length').value);
            const rWid = parseFloat(document.getElementById('input-width').value);
            if(isNaN(rLen) || isNaN(rWid) || rLen < 3 || rWid < 3) { alert("Minimal 3x3 meter."); return; }
            roomEl.style.width = `${rLen * PIXELS_PER_METER}px`;
            roomEl.style.height = `${rWid * PIXELS_PER_METER}px`;
            checkAllCollisions(); 
        }

        function clearRoom() {
            roomEl.querySelectorAll('.draggable').forEach(el => el.remove());
            updateInventory();
        }

        function updateInventory() {
            let totalVal = 0;
            const elements = roomEl.querySelectorAll('.draggable');
            let tableCount = 0;
            let furnCount = 0;
            
            elements.forEach(el => {
                const key = el.dataset.key;
                if(OBJ_DB[key]) {
                    totalVal += OBJ_DB[key].price;
                    if(OBJ_DB[key].type === 'table') tableCount++;
                    if(OBJ_DB[key].type === 'furniture' && OBJ_DB[key].price > 0) furnCount++;
                }
            });

            let str = [];
            if(tableCount > 0) str.push(`${tableCount} Meja`);
            if(furnCount > 0) str.push(`${furnCount} Aksesoris`);
            document.getElementById('inv-count').innerText = str.length > 0 ? str.join(' | ') : 'Kosong';
            
            const priceEl = document.getElementById('live-price');
            if(priceEl) priceEl.innerText = totalVal > 0 ? "Rp " + totalVal.toLocaleString('id-ID') : "Rp 0";
        }

        function deleteObject(btnEl) {
            btnEl.parentElement.remove();
            updateInventory();
            checkAllCollisions();
        }

        function spawnObject(objKey = null, autoX = null, autoY = null, isRotated = false) {
            const key = objKey || document.getElementById('obj-selector').value;
            let data = {...OBJ_DB[key]}; 
            if(!data) return;

            if(key === 'wall_block' && !objKey) {
                data.w = parseFloat(document.getElementById('wall-len').value) || 2;
                data.h = parseFloat(document.getElementById('wall-wid').value) || 1;
            }

            const el = document.createElement('div');
            el.className = `draggable absolute flex items-center justify-center border-[3px] shadow-xl z-20 ${data.bg}`;
            el.dataset.type = data.type;
            el.dataset.key = key;
            el.dataset.rawW = data.w;
            el.dataset.rawH = data.h;
            
            let wPx = data.w * PIXELS_PER_METER;
            let hPx = data.h * PIXELS_PER_METER;
            
            if(isRotated) { let temp = wPx; wPx = hPx; hPx = temp; }

            el.style.width = `${wPx}px`;
            el.style.height = `${hPx}px`;

            const spawnX = autoX !== null ? autoX : (roomEl.clientWidth - wPx) / 2;
            const spawnY = autoY !== null ? autoY : (roomEl.clientHeight - hPx) / 2;
            el.style.left = `${spawnX}px`;
            el.style.top = `${spawnY}px`;

            const delBtn = `<div onclick="deleteObject(this)" class="btn-delete absolute -top-2 -right-2 bg-red-500 text-white w-5 h-5 rounded-full items-center justify-center text-[10px] cursor-pointer z-50 hover:bg-red-600 shadow-md">✕</div>`;

            if(data.type === 'table') {
                const rotationClass = isRotated ? 'rotate-90' : '';
                el.innerHTML = `${delBtn} <span class="text-white text-[12px] opacity-70 font-bold tracking-widest pointer-events-none select-none ${rotationClass}" id="label">${data.label}</span>`;
                
                const aura = document.createElement('div');
                aura.className = 'absolute border-2 border-dashed border-green-500 bg-green-500/10 pointer-events-none transition-all duration-300 z-10 flex items-center justify-center';
                aura.id = 'aura';
                el.appendChild(aura);

                const dirs = ['top', 'bottom', 'left', 'right'];
                dirs.forEach(d => {
                    const line = document.createElement('div'); line.className = `ruler-line r-${d}`;
                    const val = document.createElement('div'); val.className = `ruler-val rv-${d}`;
                    el.appendChild(line); el.appendChild(val);
                });
                
                recalibrateAura(el);
            } else {
                const rotationClass = isRotated ? 'rotate-90' : '';
                const sizeLabel = isRotated ? `${data.h}x${data.w}` : `${data.w}x${data.h}`;
                el.innerHTML = `${delBtn} <span class="text-white/50 text-[9px] font-bold uppercase tracking-widest text-center pointer-events-none select-none ${rotationClass}" id="label">${data.label}<br><span class="text-[7px]" id="size-label">${sizeLabel}</span></span>`;
            }

            el.addEventListener('dblclick', () => rotateObject(el));
            roomEl.appendChild(el);
            
            el.addEventListener('mousedown', dragStart);
            el.addEventListener('touchstart', dragStart, {passive: false});

            updateInventory();
            checkAllCollisions();
        }

        function rotateObject(el) {
            const curW = el.style.width;
            el.style.width = el.style.height;
            el.style.height = curW;

            const label = el.querySelector('#label');
            if(label) label.classList.toggle('rotate-90');
            
            const sizeLabel = el.querySelector('#size-label');
            if(sizeLabel) {
                const isRotated = label.classList.contains('rotate-90');
                const rw = el.dataset.rawW; const rh = el.dataset.rawH;
                sizeLabel.innerText = isRotated ? `${rh}x${rw}` : `${rw}x${rh}`;
            }

            if(el.dataset.type === 'table') recalibrateAura(el);
            
            keepInsideWalls(el);
            checkAllCollisions();
        }

        function recalibrateAura(tableEl) {
            const aura = tableEl.querySelector('#aura');
            const wPx = parseInt(tableEl.style.width);
            const hPx = parseInt(tableEl.style.height);
            
            const aW = wPx + (CUE_PX * 2);
            const aH = hPx + (CUE_PX * 2);
            
            aura.style.width = `${aW}px`;
            aura.style.height = `${aH}px`;
            aura.style.left = `-${CUE_PX}px`;
            aura.style.top = `-${CUE_PX}px`;
        }

        // SNAP TO WALL LOGIC
        function keepInsideWalls(el) {
            let newL = el.offsetLeft;
            let newT = el.offsetTop;
            const maxL = roomEl.clientWidth - el.offsetWidth;
            const maxT = roomEl.clientHeight - el.offsetHeight;

            // Snap Magnetic 5px ke dinding
            if(newL < 5) newL = 0; if(newL > maxL - 5) newL = maxL;
            if(newT < 5) newT = 0; if(newT > maxT - 5) newT = maxT;

            el.style.left = `${newL}px`;
            el.style.top = `${newT}px`;
        }

        // --- SISTEM DRAG ---
        function dragStart(e) {
            if(e.target.id === 'aura' || e.target.classList.contains('ruler-val') || e.target.classList.contains('btn-delete')) return;
            draggedEl = e.currentTarget;
            
            document.querySelectorAll('.draggable').forEach(el => el.style.zIndex = 20);
            draggedEl.style.zIndex = 50;

            const clientX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
            const clientY = e.type.includes('mouse') ? e.clientY : e.touches[0].clientY;
            
            startX = clientX; startY = clientY;
            initialL = draggedEl.offsetLeft; initialT = draggedEl.offsetTop;

            document.addEventListener('mousemove', drag);
            document.addEventListener('touchmove', drag, {passive: false});
            document.addEventListener('mouseup', dragEnd);
            document.addEventListener('touchend', dragEnd);
        }

        function drag(e) {
            if (!draggedEl) return;
            e.preventDefault();
            
            const clientX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
            const clientY = e.type.includes('mouse') ? e.clientY : e.touches[0].clientY;

            let newL = initialL + (clientX - startX);
            let newT = initialT + (clientY - startY);

            draggedEl.style.left = `${newL}px`;
            draggedEl.style.top = `${newT}px`;
            keepInsideWalls(draggedEl);

            checkAllCollisions();
        }

        function dragEnd() {
            draggedEl = null;
            document.removeEventListener('mousemove', drag);
            document.removeEventListener('touchmove', drag);
            document.removeEventListener('mouseup', dragEnd);
            document.removeEventListener('touchend', dragEnd);
        }

        // --- PHYSICS ENGINE V5 (Raycasting & Soft Collision) ---
        function checkAllCollisions() {
            const tables = Array.from(roomEl.querySelectorAll('.draggable[data-type="table"]'));
            const allObjects = Array.from(roomEl.querySelectorAll('.draggable'));

            tables.forEach(table => {
                const aura = table.querySelector('#aura');
                aura.classList.remove('aura-danger', 'aura-warning', 'border-red-500', 'border-orange-500', 'bg-red-500/20', 'bg-orange-500/20');
                aura.classList.add('border-green-500', 'bg-green-500/10');
                table.classList.remove('border-red-500', 'border-orange-500');
            });

            tables.forEach(table => {
                const aura = table.querySelector('#aura');
                let hardCollision = false; 
                let softCollision = false; 

                const tTop = table.offsetTop;
                const tLeft = table.offsetLeft;
                const tBottom = tTop + table.offsetHeight;
                const tRight = tLeft + table.offsetWidth;
                
                let nearestTop = 0; let nearestBottom = roomEl.clientHeight;
                let nearestLeft = 0; let nearestRight = roomEl.clientWidth;

                // Raycasting ke segala arah untuk mencari objek terdekat
                allObjects.forEach(other => {
                    if (table === other) return;
                    const oTop = other.offsetTop; const oLeft = other.offsetLeft;
                    const oBottom = oTop + other.offsetHeight; const oRight = oLeft + other.offsetWidth;

                    if (oBottom <= tTop && oRight > tLeft && oLeft < tRight) { if (oBottom > nearestTop) nearestTop = oBottom; }
                    if (oTop >= tBottom && oRight > tLeft && oLeft < tRight) { if (oTop < nearestBottom) nearestBottom = oTop; }
                    if (oRight <= tLeft && oBottom > tTop && oTop < tBottom) { if (oRight > nearestLeft) nearestLeft = oRight; }
                    if (oLeft >= tRight && oBottom > tTop && oTop < tBottom) { if (oLeft < nearestRight) nearestRight = oLeft; }
                });

                const dTop = tTop - nearestTop; const dBottom = nearestBottom - tBottom;
                const dLeft = tLeft - nearestLeft; const dRight = nearestRight - tRight;

                table.querySelector('.r-top').style.height = `${dTop}px`; table.querySelector('.r-top').style.top = `-${dTop}px`;
                table.querySelector('.r-bottom').style.height = `${dBottom}px`; table.querySelector('.r-bottom').style.bottom = `-${dBottom}px`;
                table.querySelector('.r-left').style.width = `${dLeft}px`; table.querySelector('.r-left').style.left = `-${dLeft}px`;
                table.querySelector('.r-right').style.width = `${dRight}px`; table.querySelector('.r-right').style.right = `-${dRight}px`;

                const vTop = table.querySelector('.rv-top'); vTop.innerText = (dTop / PIXELS_PER_METER).toFixed(2) + 'm'; vTop.style.top = `-${dTop/2}px`; vTop.style.left = '50%'; vTop.style.transform = 'translate(-50%, -50%)';
                const vBot = table.querySelector('.rv-bottom'); vBot.innerText = (dBottom / PIXELS_PER_METER).toFixed(2) + 'm'; vBot.style.bottom = `-${dBottom/2}px`; vBot.style.left = '50%'; vBot.style.transform = 'translate(-50%, 50%)';
                const vLeft = table.querySelector('.rv-left'); vLeft.innerText = (dLeft / PIXELS_PER_METER).toFixed(2) + 'm'; vLeft.style.left = `-${dLeft/2}px`; vLeft.style.top = '50%'; vLeft.style.transform = 'translate(-50%, -50%)';
                const vRight = table.querySelector('.rv-right'); vRight.innerText = (dRight / PIXELS_PER_METER).toFixed(2) + 'm'; vRight.style.right = `-${dRight/2}px`; vRight.style.top = '50%'; vRight.style.transform = 'translate(50%, -50%)';

                if (dTop < CUE_PX || dBottom < CUE_PX || dLeft < CUE_PX || dRight < CUE_PX) hardCollision = true;

                const aRect = aura.getBoundingClientRect();
                allObjects.forEach(other => {
                    if (table === other) return;
                    const oRect = other.getBoundingClientRect();
                    if (!(aRect.right < oRect.left || aRect.left > oRect.right || aRect.bottom < oRect.top || aRect.top > oRect.bottom)) {
                        if(other.dataset.type === 'furniture') {
                            const isSoft = OBJ_DB[other.dataset.key].soft;
                            if(isSoft) softCollision = true; 
                            else hardCollision = true; 
                        } else if (other.dataset.type === 'table') {
                            const otherAura = other.querySelector('#aura');
                            const oaRect = otherAura.getBoundingClientRect();
                            if (!(aRect.right < oaRect.left || aRect.left > oaRect.right || aRect.bottom < oaRect.top || aRect.top > oaRect.bottom)) {
                                hardCollision = true;
                            }
                        }
                    }
                });

                aura.classList.remove('border-green-500', 'bg-green-500/10'); 
                if (hardCollision) {
                    aura.classList.add('aura-danger', 'bg-red-500/20'); table.classList.add('border-red-500');
                } else if (softCollision) {
                    aura.classList.add('aura-warning', 'bg-orange-500/20'); table.classList.add('border-orange-500');
                } else {
                    aura.classList.add('border-green-500', 'bg-green-500/10');
                }
            });
        }

        // --- AGGRESSIVE AUTO LAYOUT ALGORITHM ---
        function smartAutoLayout() {
            clearRoom(); resizeRoom();
            const rLen = parseFloat(document.getElementById('input-length').value);
            const rWid = parseFloat(document.getElementById('input-width').value);
            const isRotated = rWid > rLen; // Orientasi vertikal
            
            const tData = OBJ_DB['table_9'];
            const sofaData = OBJ_DB['sofa_3'];
            const cabData = OBJ_DB['cabinet'];
            
            // Perlu ruang = meja + (2 * clearance stik)
            const reqL = tData.w + (CUE_CLEARANCE * 2); 
            const reqW = tH = tData.h + (CUE_CLEARANCE * 2); 

            const stepX = isRotated ? reqW : reqL;
            const stepY = isRotated ? reqL : reqW;

            let cols = Math.floor(rLen / stepX);
            let rows = Math.floor(rWid / stepY);

            // Jika ruangan terlalu sempit
            if (cols < 1 || rows < 1) {
                const cX = (rLen * PIXELS_PER_METER - (isRotated ? tData.h : tData.w)*PIXELS_PER_METER)/2;
                const cY = (rWid * PIXELS_PER_METER - (isRotated ? tData.w : tData.h)*PIXELS_PER_METER)/2;
                spawnObject('table_9', cX, cY, isRotated);
                alert(localStorage.getItem('lang') === 'en' ? "Warning: Room too small. Placing one table in center." : "Ruangan sempit. Kami letakkan 1 meja di tengah (ayunan stik mungkin mentok).");
                return;
            }

            const marginX = (rLen - (cols * stepX)) / 2;
            const marginY = (rWid - (rows * stepY)) / 2;

            for(let c = 0; c < cols; c++) {
                for(let r = 0; r < rows; r++) {
                    let footX = marginX + (c * stepX);
                    let footY = marginY + (r * stepY);

                    let tableX = (footX + CUE_CLEARANCE) * PIXELS_PER_METER;
                    let tableY = (footY + CUE_CLEARANCE) * PIXELS_PER_METER;

                    if(isRotated) {
                        tableX += ((tData.h - tData.w)/2) * PIXELS_PER_METER;
                        tableY -= ((tData.h - tData.w)/2) * PIXELS_PER_METER;
                    }
                    spawnObject('table_9', tableX, tableY, isRotated);

                    // Agresif meletakkan sofa di tepi tembok bawah
                    let sofaX = (footX + (stepX/2) - (sofaData.w/2)) * PIXELS_PER_METER;
                    let sofaY = (rWid * PIXELS_PER_METER) - (sofaData.h * PIXELS_PER_METER) - 2;
                    spawnObject('sofa_3', sofaX, sofaY, false);
                }
            }
            
            // Taruh rak stik di dinding tepi (Kiri tengah)
            spawnObject('cabinet', 2, (rWid * PIXELS_PER_METER)/2 - (cabData.w * PIXELS_PER_METER)/2, true);
        }

        window.onload = () => { resizeRoom(); spawnObject('table_9'); };
        
        // Mobile Menu Logic
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