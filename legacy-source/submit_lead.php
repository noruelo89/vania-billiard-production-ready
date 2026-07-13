<?php
// File: submit_lead.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_wa = $_POST['nomor_wa'];
    $minat_produk = $_POST['minat_produk'];

    // Simpan ke MySQL
    $sql = "INSERT INTO leads (nama_pelanggan, nomor_wa, minat_produk) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$nama, $nomor_wa, $minat_produk])) {
        // Jika berhasil, redirect kembali ke index dengan pesan sukses
        echo "<script>
                alert('Terima kasih! Permintaan Anda telah kami terima. Tim kami akan segera menghubungi via WhatsApp.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Terjadi kesalahan sistem.";
    }
}
?>