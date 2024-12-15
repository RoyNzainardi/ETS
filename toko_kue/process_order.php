<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $nomor_meja = $_POST['nomor_meja'];
    $daftar_kue = json_encode($_POST['daftar_kue']);
    $total_harga = $_POST['total_harga'];

    // Cek apakah nama pelanggan sudah ada
    $check_sql = "SELECT * FROM pesanan WHERE nama_pelanggan='$nama_pelanggan'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Nama pelanggan sudah ada. Silakan gunakan nama yang berbeda.');window.location.href='form_pemesanan.php';</script>";
    } else {
        // Insert into database
        $sql = "INSERT INTO pesanan (nama_pelanggan, nomor_meja, daftar_kue, total_harga) VALUES ('$nama_pelanggan', '$nomor_meja', '$daftar_kue', '$total_harga')";

        if ($conn->query($sql) === TRUE) {
            header("Location: orders.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
