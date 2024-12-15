<?php
include 'db.php';

$sql = "SELECT * FROM pesanan ORDER BY tanggal_pemesanan DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #ff6600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ff6600;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-selesai {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-selesai:hover {
            background-color: #cc5200;
        }
        .back-button {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #ff6600;
            color: #fff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #cc5200;
        }
    </style>
</head>
<body>
    <h2>Daftar Pesanan</h2>
    <table>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Nomor Meja</th>
            <th>Daftar Kue</th>
            <th>Total Harga</th>
            <th>Tanggal Pemesanan</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nama_pelanggan"] . "</td>";
                echo "<td>" . $row["nomor_meja"] . "</td>";
                echo "<td>" . $row["daftar_kue"] . "</td>";
                echo "<td>Rp " . number_format($row["total_harga"], 0, ',', '.') . "</td>";
                echo "<td>" . $row["tanggal_pemesanan"] . "</td>";
                echo "<td><a href='delete_order.php?id=" . $row["id"] . "'><button class='btn-selesai'>Selesai</button></a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada pesanan.</td></tr>";
        }
        ?>
    </table>
    <a href="home.html" class="back-button">Kembali ke Beranda</a>
</body>
</html>
