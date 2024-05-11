<?php
// Koneksi ke database MySQL
$servername = "localhost"; // Ganti sesuai dengan host database Anda
$username = "root";          // Ganti sesuai dengan username database Anda
$password = "";              // Ganti sesuai dengan password database Anda
$dbname = "tutorial";      // Ganti sesuai dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir HTML
$kota_asal = $_POST['kota_asal'];
$kota_tujuan = $_POST['kota_tujuan'];
$berat = $_POST['berat'];

// Query SQL untuk mengambil tarif pengiriman
$sql = "SELECT tarif FROM tarif_pengiriman WHERE kota_asal = '$kota_asal' AND kota_tujuan = '$kota_tujuan' AND berat_max >= $berat ORDER BY berat_max LIMIT 1";
$result = $conn->query($sql);

// Periksa apakah ada hasil
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tarif = $row['tarif'];
    echo "Ongkir untuk pengiriman dari $kota_asal ke $kota_tujuan dengan berat $berat kg adalah Rp. " . number_format($tarif, 0, ',', '.');
} else {
    echo "Ongkir tidak ditemukan untuk rute tersebut.";
}

// Tutup koneksi database
$conn->close();
?>