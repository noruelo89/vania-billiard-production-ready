<?php
// File: index.php
require 'db.php';

// Ambil data produk dari database
$stmt = $pdo->query('SELECT * FROM products LIMIT 3');
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vania Billiard | Premium Quality</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'luxury-black': '#121212',
              'luxury-gray': '#1A1A1A',
              'luxury-white': '#F5F5F0',
              'luxury-copper': '#C86A36',
              'luxury-copper-hover': '#b05929',
            }
          }
        }
      }
    </script>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* Cursor Blinking untuk Typewriter */
        .cursor::after {
            content: '|';
            animation: blink 1s step-end infinite;
            color: #C86A36; /* Warna Copper */
        }
        @keyframes blink { 50% { opacity: 0; } }
        
        /* Preloader Transition */
        #preloader { transition: opacity 0.5s ease-out; }

        /* Custom Scrollbar agar senada dengan tema gelap */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #121212; }
        ::-webkit-scrollbar-thumb { background: #1A1A1A; border-radius: 4px; border: 1px solid #333; }
        ::-webkit-scrollbar-thumb:hover { background: #C86A36; }
    </style>
</head>
<body class="bg-luxury-black text-luxury-white font-sans antialiased overflow-x-hidden selection:bg-luxury-copper selection:text-white">

    <div id="preloader" class="fixed inset-0 z-50 bg-luxury-black flex flex-col items-center justify-center">
        <div class="flex space-x-6 text-luxury-copper mb-6 animate-pulse">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4" fill="#121212"/></svg>
            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 20L20 4m-4 16l4-4"/></svg>
            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4l8 16H4z"/></svg>
        </div>
        <h1 class="text-2xl font-bold tracking-widest uppercase text-luxury-white mb-2">Vania Billiard</h1>
        <div class="flex space-x-1 mb-2">
            <div class="w-2 h-2 bg-luxury-copper rounded-full animate-bounce"></div>
            <div class="w-2 h-2 bg-luxury-copper rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
            <div class="w-2 h-2 bg-luxury-copper rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
        </div>
        <p class="text-sm text-gray-500 tracking-widest">EST. 2023</p>
    </div>

    <nav class="bg-luxury-black/90 backdrop-blur-md py-4 px-8 flex justify-between items-center fixed w-full z-40 border-b border-gray-800">
        <h1 class="text-xl font-bold tracking-tighter uppercase"><span class="text-luxury-copper">Vania</span>.</h1>
        <div class="hidden md:flex space-x-6 text-sm font-semibold items-center">
            <a href="#katalog" class="text-gray-400 hover:text-luxury-copper transition">Katalog</a>
            <a href="#keunggulan" class="text-gray-400 hover:text-luxury-copper transition">Nilai Kami</a>
            <a href="#pesan" class="bg-luxury-copper text-white px-5 py-2.5 rounded-full hover:bg-luxury-copper-hover transition shadow-[0_0_15px_rgba(200,106,54,0.3)]">Konsultasi</a>
        </div>
    </nav>

    <section class="relative min-h-screen flex flex-col items-center justify-center pt-20 px-8 text-center overflow-hidden">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-luxury-copper rounded-full blur-[150px] opacity-10 pointer-events-none"></div>
        
        <div class="relative z-10 max-w-5xl mx-auto">
            <div class="inline-block border border-luxury-copper text-luxury-copper px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-8 bg-luxury-copper/10">Koleksi Terkurasi</div>
            
            <h2 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
                Arena Billiard Premium <br>
                <span id="typewriter" class="text-luxury-copper cursor"></span>
            </h2>
            
            <p class="text-lg md:text-xl text-gray-400 mb-12 max-w-2xl mx-auto font-light" data-aos="fade-up" data-aos-delay="500">
                Reseller resmi meja turnamen dan aksesoris dengan material terbaik. Menghadirkan presisi absolut untuk ruang personal maupun bisnis Anda.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4" data-aos="fade-up" data-aos-delay="700">
                <a href="#pesan" class="bg-luxury-copper text-white px-8 py-3.5 rounded-sm font-bold hover:bg-luxury-copper-hover transition flex items-center justify-center tracking-wide">
                    Minta Penawaran <span class="ml-2">→</span>
                </a>
                <a href="#katalog" class="bg-transparent text-luxury-white px-8 py-3.5 rounded-sm border border-gray-600 font-bold hover:border-luxury-white transition flex items-center justify-center tracking-wide">
                    Eksplorasi Meja
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-24 pt-12 border-t border-gray-800" data-aos="fade-in" data-aos-delay="1000">
                <div><h4 class="text-3xl font-bold text-luxury-white">100%</h4><p class="text-xs text-luxury-copper uppercase mt-2 tracking-widest">Presisi Leveling</p></div>
                <div><h4 class="text-3xl font-bold text-luxury-white">Grade A</h4><p class="text-xs text-luxury-copper uppercase mt-2 tracking-widest">Kurasi Material</p></div>
                <div><h4 class="text-3xl font-bold text-luxury-white">Ahli</h4><p class="text-xs text-luxury-copper uppercase mt-2 tracking-widest">Instalasi Lokal</p></div>
                <div><h4 class="text-3xl font-bold text-luxury-white">Aman</h4><p class="text-xs text-luxury-copper uppercase mt-2 tracking-widest">Logistik Unit</p></div>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="py-24 bg-luxury-gray px-8 relative border-t border-b border-gray-800">
        <div class="max-w-6xl mx-auto text-center relative z-10">
            <h3 class="text-4xl font-bold mb-4 tracking-tight">Standar Layanan Kami</h3>
            <p class="text-gray-400 mb-16 max-w-2xl mx-auto font-light">Tidak sekadar menyalurkan barang. Kami memastikan aset investasi hiburan Anda terpasang dengan sempurna di ruangan.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div data-aos="fade-up" class="p-8 bg-luxury-black border border-gray-800 rounded-xl hover:border-luxury-copper transition duration-300 group">
                    <div class="w-16 h-16 bg-luxury-gray rounded-full mx-auto mb-6 flex items-center justify-center text-luxury-copper group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-3 uppercase tracking-wide">Kurasi Ketat</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Hanya menyalurkan meja dengan spesifikasi turnamen, memastikan kayu solid dan kualitas laken terjaga tanpa cacat.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100" class="p-8 bg-luxury-black border border-gray-800 rounded-xl hover:border-luxury-copper transition duration-300 group">
                    <div class="w-16 h-16 bg-luxury-gray rounded-full mx-auto mb-6 flex items-center justify-center text-luxury-copper group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-3 uppercase tracking-wide">Instalasi Profesional</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Dirakit langsung oleh teknisi spesialis untuk menjamin keseimbangan absolut (leveling) di setiap sudut meja.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" class="p-8 bg-luxury-black border border-gray-800 rounded-xl hover:border-luxury-copper transition duration-300 group">
                    <div class="w-16 h-16 bg-luxury-gray rounded-full mx-auto mb-6 flex items-center justify-center text-luxury-copper group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-bold mb-3 uppercase tracking-wide">Coverage Jateng</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Pengiriman dan perakitan khusus yang terjamin keamanannya untuk area Semarang, Ambarawa, dan sekitarnya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-luxury-black px-8 border-b border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-luxury-copper text-xs font-bold uppercase tracking-[0.2em] border border-luxury-copper/30 px-4 py-1.5 rounded-full bg-luxury-copper/5">Dalam Pengembangan</span>
                <h3 class="text-3xl font-bold mt-6 mb-4">Eksplorasi Ruang Interaktif</h3>
                <p class="text-gray-400 font-light max-w-xl mx-auto">Alat visual cerdas untuk membantu Anda merencanakan ruang billiard idaman.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div data-aos="fade-right" class="bg-luxury-gray border border-gray-800 rounded-xl p-10 hover:border-gray-600 transition">
                    <div class="flex items-center text-luxury-white font-bold text-xl mb-4">
                        <svg class="w-6 h-6 mr-3 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                        Room Size Calculator
                    </div>
                    <p class="text-gray-400 text-sm mb-8 leading-relaxed font-light">Hitung ukuran ideal ruangan berdasarkan dimensi meja dan area ayunan stick (cue) untuk memastikan manuver bermain tanpa batasan dinding.</p>
                    <div class="w-full bg-luxury-black text-gray-600 text-sm text-center py-3 rounded border border-gray-800 cursor-not-allowed">Segera Hadir</div>
                </div>
                
                <div data-aos="fade-left" class="bg-luxury-gray border border-gray-800 rounded-xl p-10 hover:border-gray-600 transition">
                    <div class="flex items-center text-luxury-white font-bold text-xl mb-4">
                        <svg class="w-6 h-6 mr-3 text-luxury-copper" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        Cloth Color Customizer
                    </div>
                    <p class="text-gray-400 text-sm mb-8 leading-relaxed font-light">Visualisasikan berbagai pilihan warna laken secara langsung pada model meja untuk menyesuaikan dengan tema interior arsitektur Anda.</p>
                    <div class="w-full bg-luxury-black text-gray-600 text-sm text-center py-3 rounded border border-gray-800 cursor-not-allowed">Segera Hadir</div>
                </div>
            </div>
        </div>
    </section>

    <section id="katalog" class="py-24 bg-luxury-gray px-8">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-3xl font-bold mb-16 text-center tracking-tight">Koleksi Kami</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <?php foreach ($products as $product): ?>
                    <div data-aos="fade-up" class="bg-luxury-black border border-gray-800 rounded-lg overflow-hidden hover:shadow-[0_10px_30px_rgba(0,0,0,0.5)] transition duration-500 group">
                        <div class="h-72 bg-[#171717] flex items-center justify-center relative overflow-hidden">
                            <?php if (!empty($product['image_url'])): ?>
                                <img src="assets/images/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 group-hover:opacity-80 transition duration-700 ease-in-out opacity-90">
                            <?php else: ?>
                                <div class="text-gray-600 font-mono text-xs uppercase tracking-widest flex flex-col items-center">
                                    <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Menunggu Aset Gambar
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-4 right-4 bg-luxury-black/80 backdrop-blur border border-gray-700 text-luxury-copper text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-sm">
                                <?= htmlspecialchars($product['category']) ?>
                            </div>
                        </div>
                        
                        <div class="p-8">
                            <h4 class="text-xl font-bold mb-3 text-luxury-white tracking-wide"><?= htmlspecialchars($product['name']) ?></h4>
                            <p class="text-gray-400 text-sm font-light leading-relaxed line-clamp-2 mb-6">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>
                            <div class="flex justify-between items-center pt-5 border-t border-gray-800">
                                <span class="font-bold text-lg text-luxury-white">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="pesan" class="py-24 bg-luxury-black px-8 relative border-t border-gray-800">
        <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-luxury-copper rounded-full blur-[200px] opacity-5 pointer-events-none"></div>

        <div class="max-w-5xl mx-auto flex flex-col lg:flex-row gap-16 relative z-10">
            <div class="lg:w-5/12" data-aos="fade-right">
                <div class="inline-block border border-gray-700 text-gray-400 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6 bg-gray-900/50">Langkah Pertama</div>
                <h3 class="text-4xl font-bold mb-6 tracking-tight">Mulai Diskusi Ruang Anda</h3>
                <p class="text-gray-400 mb-10 text-sm font-light leading-relaxed">Sampaikan ketertarikan Anda. Tim kami akan segera merespon dengan Quotation detail, ketersediaan stok, hingga opsi survei instalasi di lokasi Anda.</p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-luxury-gray border border-gray-700 flex items-center justify-center mr-4 text-luxury-copper shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm text-luxury-white mb-1">Konsultasi WhatsApp</h5>
                            <p class="text-xs text-gray-500">Fast response via pesan teks.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full bg-luxury-gray border border-gray-700 flex items-center justify-center mr-4 text-luxury-copper shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm text-luxury-white mb-1">Jam Operasional</h5>
                            <p class="text-xs text-gray-500">Setiap Hari: 09.00 - 18.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:w-7/12" data-aos="fade-left">
                <div class="bg-luxury-gray p-10 rounded-sm border border-gray-800 shadow-2xl relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-luxury-copper to-transparent"></div>
                    
                    <form action="submit_lead.php" method="POST" class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="nama" required class="w-full px-5 py-3.5 bg-luxury-black border border-gray-700 text-luxury-white rounded-sm focus:ring-1 focus:ring-luxury-copper focus:border-luxury-copper outline-none transition placeholder-gray-600" placeholder="Cth: Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Nomor WhatsApp</label>
                            <input type="number" name="nomor_wa" required class="w-full px-5 py-3.5 bg-luxury-black border border-gray-700 text-luxury-white rounded-sm focus:ring-1 focus:ring-luxury-copper focus:border-luxury-copper outline-none transition placeholder-gray-600" placeholder="0812xxxxxx">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Topik Diskusi / Minat</label>
                            <select name="minat_produk" class="w-full px-5 py-3.5 bg-luxury-black border border-gray-700 text-luxury-white rounded-sm focus:ring-1 focus:ring-luxury-copper focus:border-luxury-copper outline-none transition appearance-none">
                                <option value="Belum Yakin, Butuh Konsultasi Ruang">Konsultasi Ukuran & Ruangan</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= htmlspecialchars($product['name']) ?>">Tanya Harga: <?= htmlspecialchars($product['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-luxury-copper text-white font-bold py-4 mt-4 rounded-sm hover:bg-luxury-copper-hover transition tracking-wide shadow-[0_0_20px_rgba(200,106,54,0.2)]">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#0a0a0a] text-gray-600 py-10 text-center text-sm border-t border-gray-900">
        <p class="font-light tracking-widest uppercase mb-2">Vania Billiard</p>
        <p class="text-xs">&copy; 2026. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // 1. Inisialisasi Animasi Scroll
        AOS.init({ once: true, duration: 1000, offset: 50 });

        // 2. Preloader Logic
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => { preloader.style.display = 'none'; }, 500);
            }, 1200); 
        });

        // 3. Typewriter Effect Logic
        const words = ["Kualitas Terbaik", "Instalasi Akurat", "Estetika Elegan"];
        let i = 0;
        let timer;

        function typingEffect() {
            let word = words[i].split("");
            var loopTyping = function() {
                if (word.length > 0) {
                    document.getElementById('typewriter').innerHTML += word.shift();
                } else {
                    setTimeout(deletingEffect, 2500); // Pause lebih lama di akhir kata
                    return false;
                };
                timer = setTimeout(loopTyping, 80); // Kecepatan ngetik
            };
            loopTyping();
        }

        function deletingEffect() {
            let word = words[i].split("");
            var loopDeleting = function() {
                if (word.length > 0) {
                    word.pop();
                    document.getElementById('typewriter').innerHTML = word.join("");
                } else {
                    if (words.length > (i + 1)) { i++; } else { i = 0; };
                    setTimeout(typingEffect, 500); // Jeda sebelum ngetik kata baru
                    return false;
                };
                timer = setTimeout(loopDeleting, 40); // Kecepatan hapus
            };
            loopDeleting();
        }
        
        // Mulai typewriter setelah preloader hilang
        setTimeout(typingEffect, 1800); 
    </script>
</body>
</html>