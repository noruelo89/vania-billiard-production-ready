// File: lang.js (Global Translation Matrix)

const dictionary = {
    id: {
        // NAVIGASI
        nav_koleksi: "Koleksi", nav_infrastruktur: "Simulator 2D", nav_jurnal: "Jurnal Kurator", nav_jejak: "Jejak Karya", nav_b2b: "B2B & Ekspor", nav_cta: "Konsultasi VIP", nav_back: "Kembali",
        
        // HERO & ABOUT
        hero_title_1: "Seni Presisi", hero_title_2: "Dalam", hero_desc: "Menghadirkan furnitur hiburan bertaraf turnamen. Kami mengkurasi, mengirim, dan merakit presisi absolut untuk ruang eksklusif Anda.",
        hero_cta_1: "Eksplorasi Kurasi", hero_cta_2: "Proses Leveling", hotspot_1: "Anyaman tanpa bulu, memaksimalkan laju bola.", trust_title: "Dipercaya Oleh:",
        about_quote: '"Kami tidak memproduksi meja secara massal.<br>Kami menyeleksi, menguji, dan mengkurasi presisi absolut untuk ruang eksklusif Anda."',
        
        // STATS & ANATOMI
        stat_1: "Unit Terinstalasi", stat_2: "Kota Jangkauan", stat_3: "Presisi Leveling", stat_4: "Dukungan Klien",
        dist_title: "Jejak Distribusi", dist_subtitle: "Menguasai Teritori, Menjaga Kualitas.",
        anatomi_sub: "Anatomi Presisi", anatomi_title: "Mengenal Komponen Turnamen", anatomi_desc: "Kemewahan sejati terletak pada detail yang tidak terlihat dari luar.",
        
        // FORM & FOOTER
        form_title: "Undangan Diskusi.", form_desc: "Sampaikan kebutuhan Anda. Berikan detail lokasi agar tim kurator kami dapat menghitung presisi total biaya unit.", form_btn: "Kirim Data ke Kurator",
        footer_desc: "Bukan sekadar manufaktur massal. Kami adalah kurator meja billiard turnamen yang memastikan setiap batu slate dan rangka kayu terkalibrasi presisi.",
        footer_nav_1: "Eksplorasi", footer_nav_2: "Operasional & Logistik", footer_nav_3: "Sosial Media",

        // KATALOG
        cat_sub: "The Complete Collection", cat_title: "Koleksi Kurator.", cat_desc: "Eksplorasi seluruh lini mahakarya kami. Dari meja turnamen profesional hingga aksesoris kalibrasi.",
        
        // SIMULATOR
        sidebar_title: "Arsitektur Ruang", step_1: "1. Dimensi Denah", label_length: "Panjang (M)", label_width: "Lebar (M)", btn_apply: "Terapkan Dimensi", 
        step_2: "2. Tambah Elemen", btn_drop: "+ Drop ke Kanvas", btn_magic: "Sihir Rekomendasi Layout", 
        est_cost: "Estimasi Nilai Aset", est_note: "*Tidak termasuk kargo / custom item.", 
        leg_1: "Jarak stik aman (> 1.5 meter).", leg_2: "Toleransi (Menyenggol sofa/rak).", leg_warn: "FATAL:", leg_3: "Mentok tembok / meja lain!", btn_reset: "Reset Ruang"
    },
    en: {
        // NAVIGATION
        nav_koleksi: "Collection", nav_infrastruktur: "2D Simulator", nav_jurnal: "Curator's Journal", nav_jejak: "Portfolio", nav_b2b: "B2B & Export", nav_cta: "VIP Consult", nav_back: "Back",
        
        // HERO & ABOUT
        hero_title_1: "The Art of Precision", hero_title_2: "In", hero_desc: "Delivering tournament-grade entertainment furniture. We curate, ship, and assemble with absolute precision for your exclusive space.",
        hero_cta_1: "Explore Collection", hero_cta_2: "Leveling Process", hotspot_1: "Lint-free weave, maximizing ball speed.", trust_title: "Trusted By:",
        about_quote: '"We do not mass-produce tables.<br>We select, test, and curate absolute precision for your exclusive space."',
        
        // STATS & ANATOMY
        stat_1: "Units Installed", stat_2: "Cities Reached", stat_3: "Leveling Precision", stat_4: "Client Support",
        dist_title: "Distribution Footprint", dist_subtitle: "Mastering Territory, Maintaining Quality.",
        anatomi_sub: "Precision Anatomy", anatomi_title: "Know the Tournament Components", anatomi_desc: "True luxury lies in the unseen details.",
        
        // FORM & FOOTER
        form_title: "Invitation to Discuss.", form_desc: "Tell us your needs. Provide location details so our curators can calculate precision unit costs.", form_btn: "Send Data to Curator",
        footer_desc: "Not just mass manufacturers. We are tournament billiard table curators ensuring every slate and wood frame is precision-calibrated.",
        footer_nav_1: "Explore", footer_nav_2: "Operations & Logistics", footer_nav_3: "Social Media",

        // CATALOG
        cat_sub: "The Complete Collection", cat_title: "Curator's Collection.", cat_desc: "Explore our entire line of masterpieces. From professional tournament tables to precision calibration accessories.",
        
        // SIMULATOR
        sidebar_title: "Space Architecture", step_1: "1. Floor Dimensions", label_length: "Length (M)", label_width: "Width (M)", btn_apply: "Apply Dimensions", 
        step_2: "2. Add Elements", btn_drop: "+ Drop to Canvas", btn_magic: "Magic Auto Layout", 
        est_cost: "Estimated Asset Value", est_note: "*Excluding freight / custom items.", 
        leg_1: "Safe cue distance (> 1.5m).", leg_2: "Tolerance (Nudging soft objects).", leg_warn: "DANGER:", leg_3: "Hitting wall / other tables!", btn_reset: "Reset Room"
    }
};

function setLanguage(lang) {
    document.querySelectorAll('[data-tr]').forEach(el => {
        const key = el.getAttribute('data-tr');
        if (dictionary[lang] && dictionary[lang][key]) el.innerHTML = dictionary[lang][key];
    });
    
    const btnId = document.getElementById('btn-id'); 
    const btnEn = document.getElementById('btn-en');
    
    if (btnId && btnEn) {
        btnId.classList.remove('lang-active', 'text-luxury-copper'); btnId.classList.add('text-gray-900', 'dark:text-white');
        btnEn.classList.remove('lang-active', 'text-luxury-copper'); btnEn.classList.add('text-gray-400');
        const activeBtn = document.getElementById('btn-' + lang);
        if(activeBtn) {
            activeBtn.classList.remove('text-gray-900', 'dark:text-white', 'text-gray-400'); 
            activeBtn.classList.add('lang-active', 'text-luxury-copper');
        }
    }
    localStorage.setItem('lang', lang);
}

// Inisialisasi Otomatis saat file dimuat
document.addEventListener('DOMContentLoaded', () => {
    setLanguage(localStorage.getItem('lang') || 'id');
});