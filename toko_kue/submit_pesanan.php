<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "toko_kue");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $no_meja = $_POST['no_meja'];
    $jumlah = $_POST['jumlah'];
    $total_harga = 0;

    foreach ($jumlah as $kue_id => $qty) {
        $result = $conn->query("SELECT harga FROM kue WHERE id = $kue_id");
        $row = $result->fetch_assoc();
        $total_harga += $row['harga'] * $qty;
    }

    // Simpan pesanan ke tabel `pesanan`
    $conn->query("INSERT INTO pesanan (no_meja, total_harga) VALUES ($no_meja, $total_harga)");
    $pesanan_id = $conn->insert_id;

    // Simpan detail pesanan ke tabel `detail_pesanan`
    foreach ($jumlah as $kue_id => $qty) {
        if ($qty > 0) {
            $conn->query("INSERT INTO detail_pesanan (pesanan_id, kue_id, jumlah) VALUES ($pesanan_id, $kue_id, $qty)");
        }
    }

    $conn->close();

    // Redirect ke halaman selesai
    header("Location: selesai.html");
    exit;
}
?>
