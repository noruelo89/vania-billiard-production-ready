<?php
require 'db.php';

// 1. Menangkap ID Produk dari URL
$id_produk = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_produk === 0) { header("Location: katalog.php"); exit; }

// 2. Mengambil data produk spesifik
$sql = "SELECT p.*, c.nama_kategori, c.tipe_pengiriman 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id_produk]);
$product = $stmt->fetch();

if (!$product) {
    echo "<h1 style='color:white; background:#0a0a0a; text-align:center; padding:50px;'>Mahakarya tidak ditemukan.</h1>";
    exit;
}

// 3. ENGINE BACA CSV ONGKIR (Inovasi Baru)
$ongkir_data = [];
$csv_file = 'ongkir.csv'; // Pastikan file ini ada di folder yang sama
if (file_exists($csv_file)) {
    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        $current_prov = "";
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Skip header atau baris kosong
            if (strtoupper(trim($data[0])) === 'NO' || empty($data[2])) continue; 
            
            // Jika kolom provinsi tidak kosong, set sebagai provinsi saat ini
            if (!empty(trim($data[1]))) {
                $current_prov = trim($data[1]);
            }
            
            $kota = trim($data[2]);
            $harga = trim($data[3]);
            
            if ($current_prov && $kota) {
                // Kelompokkan kota ke dalam provinsinya
                $ongkir_data[$current_prov][] = [
                    'kota' => $kota, 
                    'harga' => $harga
                ];
            }
        }
        fclose($handle);
    }
}
// Konversi ke JSON agar bisa dibaca oleh JavaScript di bawah
$ongkir_json = json_encode($ongkir_data);
?>

<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['nama_produk']) ?> | Vania Billiard</title>
    
    <meta name="description" content="<?= htmlspecialchars(substr($product['deskripsi'], 0, 150)) ?>...">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] }, colors: { 'luxury-bg': '#0a0a0a', 'luxury-surface': '#141414', 'luxury-copper': '#C86A36', } } } }
    </script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" rel="stylesheet">
    
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <style>
        body { opacity: 0; transition: opacity 0.6s ease-in-out, background-color 0.5s ease, color 0.5s ease; }
        body.page-loaded { opacity: 1; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }
        .lang-active { font-weight: bold; color: #C86A36 !important; }
        .swiper-pagination-bullet-active { background: #C86A36 !important; }
        .detail-gallery { transition: transform 0.5s ease; cursor: zoom-in; }
        .swiper-slide-active:hover .detail-gallery { transform: scale(1.05); }
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
                    <a href="katalog.php" class="relative text-luxury-copper transition-colors py-2 border-b border-luxury-copper" data-tr="nav_koleksi">Koleksi</a>
                    <a href="simulator.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_infrastruktur">Simulator 2D<span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
                    <a href="jurnal.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_jurnal">Jurnal Kurator<span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
                    <a href="profil.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_jejak">Jejak Karya<span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
                    <a href="b2b.php" class="relative text-gray-600 dark:text-gray-300 hover:text-luxury-copper transition-colors py-2 group" data-tr="nav_b2b">B2B & Ekspor<span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-luxury-copper transition-all duration-300 group-hover:w-full group-hover:left-0"></span></a>
                    
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
                <a href="katalog.php" class="block text-luxury-copper transition-transform hover:translate-x-2">Koleksi</a>
                <a href="simulator.php" class="block text-gray-800 dark:text-gray-300 hover:text-luxury-copper transition-transform hover:translate-x-2">Simulator 2D</a>
                <a href="index.php#pesan" class="block bg-luxury-copper text-white text-center py-4 mt-4 shadow-lg">Konsultasi VIP</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto px-6 md:px-12 pt-32 pb-20 flex flex-col lg:flex-row gap-12 lg:gap-20">
        
        <div class="w-full lg:w-1/2">
            <div class="sticky top-32">
                <div class="flex items-center space-x-2 text-[10px] uppercase tracking-widest text-gray-500 mb-6">
                    <a href="index.php" class="hover:text-luxury-copper transition">Home</a> <span>/</span>
                    <a href="katalog.php" class="hover:text-luxury-copper transition">Koleksi</a> <span>/</span>
                    <span class="text-gray-900 dark:text-white font-bold"><?= htmlspecialchars($product['nama_produk']) ?></span>
                </div>

                <div class="swiper productSwiper w-full aspect-[4/3] bg-gray-200 dark:bg-luxury-surface border border-gray-300 dark:border-gray-800 overflow-hidden shadow-2xl mb-4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide bg-gray-100 dark:bg-[#111] flex items-center justify-center overflow-hidden" onclick="openLightbox(this.querySelector('img') ? this.querySelector('img').src : '')">
                            <?php if (!empty($product['image_url'])): ?>
                                <img src="assets/images/<?= htmlspecialchars($product['image_url']) ?>" class="w-full h-full object-cover detail-gallery opacity-90 hover:opacity-100">
                            <?php else: ?>
                                <span class="font-serif italic text-gray-500 text-sm">[Gambar Utama: <?= htmlspecialchars($product['nama_produk']) ?>]</span>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-slide bg-gray-100 dark:bg-[#111] flex items-center justify-center overflow-hidden">
                            <span class="font-serif italic text-gray-500 text-sm">[Close-up: Sudut Pocket Kulit]</span>
                        </div>
                        <div class="swiper-slide bg-gray-100 dark:bg-[#111] flex items-center justify-center overflow-hidden">
                            <span class="font-serif italic text-gray-500 text-sm">[Close-up: Sistem Rangka & Slate]</span>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <p class="text-[9px] text-gray-500 italic text-center">*Klik gambar untuk memperbesar resolusi.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center">
            
            <div class="flex items-center gap-3 mb-6">
                <span class="text-[10px] uppercase tracking-[0.2em] text-gray-500 border border-gray-300 dark:border-gray-700 px-3 py-1"><?= htmlspecialchars($product['nama_kategori']) ?></span>
                <?php if (strpos(strtolower($product['nama_kategori']), 'meja') !== false): ?>
                <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-copper border border-luxury-copper bg-luxury-copper/10 px-3 py-1 font-bold">Instalasi VIP Tersedia</span>
                <?php endif; ?>
            </div>

            <h1 class="font-serif text-4xl md:text-5xl text-gray-900 dark:text-white mb-6 leading-tight"><?= htmlspecialchars($product['nama_produk']) ?></h1>
            <p class="text-luxury-copper font-serif italic text-3xl mb-8 border-b border-gray-200 dark:border-gray-800 pb-8">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>

            <div class="prose prose-sm dark:prose-invert font-light text-gray-600 dark:text-gray-400 leading-relaxed mb-10">
                <p><?= nl2br(htmlspecialchars($product['deskripsi'])) ?></p>
            </div>

            <?php if (strpos(strtolower($product['nama_kategori']), 'meja') !== false): ?>
            <div class="mb-10">
                <h4 class="text-[10px] uppercase tracking-widest text-gray-900 dark:text-white font-bold mb-4 border-b border-gray-200 dark:border-gray-800 pb-2">Spesifikasi Kurator</h4>
                <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-xs font-light text-gray-600 dark:text-gray-400">
                    <div><span class="block text-[9px] uppercase tracking-widest text-gray-500 mb-1">Material Alas</span><span class="font-bold text-gray-800 dark:text-gray-200">Batu Black Slate 2.5cm</span></div>
                    <div><span class="block text-[9px] uppercase tracking-widest text-gray-500 mb-1">Bantalan Karet</span><span class="font-bold text-gray-800 dark:text-gray-200">K-66 Tournament Grade</span></div>
                    <div><span class="block text-[9px] uppercase tracking-widest text-gray-500 mb-1">Kain Laken</span><span class="font-bold text-gray-800 dark:text-gray-200">Worsted Cloth (Tanpa Bulu)</span></div>
                    <div><span class="block text-[9px] uppercase tracking-widest text-gray-500 mb-1">Dimensi Luar</span><span class="font-bold text-gray-800 dark:text-gray-200">2.8m x 1.5m</span></div>
                </div>
            </div>

            <div class="bg-gray-100 dark:bg-luxury-surface border border-gray-200 dark:border-gray-800 p-6 mb-10">
                <p class="text-[10px] uppercase tracking-widest text-gray-900 dark:text-white font-bold mb-4">Termasuk dalam Pembelian (Bundle):</p>
                <div class="grid grid-cols-2 gap-3 text-xs font-bold text-gray-700 dark:text-gray-300">
                    <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg> 4x Stik Sambung (Play)</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg> 1x Stik Rest (Cagak)</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg> 1 Set Bola Aramith/Taiwan</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg> Rak Stik Dinding</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg> Segitiga & 12 Pcs Kapur</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg> Sikat Laken</span>
                </div>
            </div>

            <div class="border border-luxury-copper/50 bg-white dark:bg-[#0a0a0a] p-6 mb-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-luxury-copper rounded-full blur-[60px] opacity-10 pointer-events-none"></div>
                <h4 class="text-[11px] uppercase tracking-widest text-gray-900 dark:text-white font-bold mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Estimasi Ongkos Kirim & Kargo
                </h4>
                <p class="text-[10px] text-gray-500 mb-5">Pilih lokasi Anda untuk melihat estimasi biaya pengiriman meja.</p>
                
                <?php if(empty($ongkir_data)): ?>
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 text-red-600 text-xs border-l-2 border-red-500">
                        File <b>ongkir.csv</b> tidak ditemukan di server. Harap hubungi Admin.
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <select id="provinsi" class="w-full bg-gray-50 dark:bg-luxury-surface border border-gray-300 dark:border-gray-700 py-3 px-3 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition appearance-none" onchange="loadKota()">
                            <option value="">-- Pilih Provinsi Tujuan --</option>
                            </select>
                        <select id="kota" class="w-full bg-gray-50 dark:bg-luxury-surface border border-gray-300 dark:border-gray-700 py-3 px-3 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-luxury-copper transition appearance-none" onchange="showOngkir()" disabled>
                            <option value="">-- Pilih Kota / Kabupaten --</option>
                        </select>
                    </div>
                    
                    <div id="ongkir-result" class="hidden p-4 bg-luxury-copper/10 border-l-2 border-luxury-copper mt-4 transition-all duration-300">
                        <p class="text-[9px] uppercase tracking-widest text-gray-500 mb-1">Estimasi Biaya Ongkir:</p>
                        <p id="ongkir-price" class="text-xl font-serif font-bold text-luxury-copper mb-2"></p>
                        <p class="text-[9px] text-gray-500 italic">*Biaya sudah termasuk Packing Kayu Kargo (ISPM 15). Harga dapat berubah sewaktu-waktu sesuai kebijakan ekspedisi.</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="flex flex-col sm:flex-row gap-4 relative z-20">
                <?php 
                    $waText = urlencode("Halo Tim Kurator Vania Billiard, saya tertarik dengan produk " . $product['nama_produk'] . " (Rp " . number_format($product['harga'], 0, ',', '.') . "). Mohon informasi lebih lanjut.");
                ?>
                <a href="https://wa.me/62812XXXXX?text=<?= $waText ?>" target="_blank" class="w-full sm:w-2/3 bg-luxury-copper text-white text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#b05929] hover:shadow-[0_10px_20px_rgba(200,106,54,0.3)] transition-all duration-300">
                    Konsultasi & Pesan via WA
                </a>
                
                <a href="https://shopee.co.id" target="_blank" class="w-full sm:w-1/3 bg-white dark:bg-transparent border border-luxury-copper text-luxury-copper text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-luxury-copper hover:text-white transition-colors duration-300">
                    Beli via Shopee
                </a>
            </div>

            <div class="mt-8 flex items-center justify-center space-x-6 border-t border-gray-200 dark:border-gray-800 pt-6 opacity-60">
                <div class="flex items-center text-[9px] uppercase tracking-widest font-bold text-gray-500">
                    <svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 100% Presisi Leveling
                </div>
                <div class="flex items-center text-[9px] uppercase tracking-widest font-bold text-gray-500">
                    <svg class="w-4 h-4 mr-2 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> Kargo Asuransi Penuh
                </div>
            </div>

        </div>
    </main>

    <div id="lightbox" class="fixed inset-0 z-[110] bg-black/95 hidden items-center justify-center opacity-0 transition-opacity duration-300" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-luxury-copper text-3xl font-light">✕</button>
        <img id="lightbox-img" src="" class="max-w-[90%] max-h-[90%] object-contain scale-95 transition-transform duration-300 shadow-2xl">
    </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>
    <script src="lang.js"></script>
    
    <script>
        // Init Smooth Scroll
        if (typeof Lenis !== 'undefined') {
            const lenis = new Lenis({ duration: 1.2 });
            function raf(time) { lenis.raf(time); requestAnimationFrame(raf); } 
            requestAnimationFrame(raf);
        }

        // ANIMASI FADE-IN HALAMAN
        window.addEventListener('load', function() {
            document.body.classList.add('page-loaded'); 
        });

        // Init Swiper Gallery
        if (typeof Swiper !== 'undefined') {
            var swiper = new Swiper(".productSwiper", {
                pagination: { el: ".swiper-pagination", clickable: true },
                loop: true,
                grabCursor: true
            });
        }

        // LOGIKA KALKULATOR ONGKIR (Inovasi Baru)
        const ongkirData = <?= !empty($ongkir_json) ? $ongkir_json : '{}' ?>;
        const provSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        const resultBox = document.getElementById('ongkir-result');
        const priceText = document.getElementById('ongkir-price');

        // Isi Dropdown Provinsi saat halaman dimuat
        if(provSelect && Object.keys(ongkirData).length > 0) {
            for (let prov in ongkirData) {
                let opt = document.createElement('option');
                opt.value = prov;
                opt.innerHTML = prov;
                provSelect.appendChild(opt);
            }
        }

        function loadKota() {
            const selectedProv = provSelect.value;
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            resultBox.classList.add('hidden');
            
            if(selectedProv && ongkirData[selectedProv]) {
                ongkirData[selectedProv].forEach(item => {
                    let opt = document.createElement('option');
                    // Simpan harga di value agar mudah diambil
                    opt.value = item.harga; 
                    opt.innerHTML = item.kota;
                    kotaSelect.appendChild(opt);
                });
                kotaSelect.disabled = false;
            } else {
                kotaSelect.disabled = true;
            }
        }

        function showOngkir() {
            const selectedPrice = kotaSelect.value;
            if(selectedPrice) {
                // Tampilkan Harga (Jika data berbentuk rentang misal "4,5 - 5 JT", tampilkan dengan prefix Rp)
                let cleanPrice = selectedPrice.replace(/"/g, ''); // Hapus kutip jika terbawa dari CSV
                if(cleanPrice.includes('JT') || cleanPrice.includes('RB') || cleanPrice.includes('FREE')) {
                    priceText.innerHTML = cleanPrice; 
                } else {
                    priceText.innerHTML = "Rp " + cleanPrice;
                }
                resultBox.classList.remove('hidden');
            } else {
                resultBox.classList.add('hidden');
            }
        }

        // Lightbox Logic
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        
        function openLightbox(src) {
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

        // DYNAMIC NAVBAR SCROLL EFFECT
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