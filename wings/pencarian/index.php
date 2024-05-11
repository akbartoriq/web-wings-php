<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Nomor Resi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            background-image: url('../gambar/ct.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: black;
        }

        .content {
            padding: 100px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="header" style="background-color: #ffffff; color: #ffffff;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand logo" href="#">
                <img src="../gambar/7788.png" alt="Logo Saya" style="width: 75px; height: 75px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../pencarian/index.php">Cek Resi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../ongkir/index.html">Cek Ongkir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../kontak/index.php">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login/index.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="container">
    <h2>Pencarian Nomor Resi</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>Masukkan Nomor Resi:</label>
            <input type="text" name="nomor_resi" class="form-control" placeholder="Masukkan nomor resi" required />
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Cari</button>
        <!-- Tombol Kembali -->
        <a href="../index.html" class="btn btn-secondary">Kembali ke Halaman Awal</a>

    </form>

    <?php
    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomor_resi = $_POST["nomor_resi"];

        // Query pencarian nomor resi
        $query = "SELECT * FROM peserta WHERE no_resi = '$nomor_resi'";
        $result = mysqli_query($kon, $query);

        if (mysqli_num_rows($result) > 0) {
            // Nomor resi ditemukan, tampilkan hasilnya
            echo "<h3>Hasil Pencarian:</h3>";
            echo "<table class='table'>";
            echo "<tr><th>No. Resi</th><th>Nama Pengirim</th><th>Nama Penerima</th><th>Alamat</th><th>No HP</th><th>Keterangan</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["no_resi"] . "</td>";
                echo "<td>" . $row["nama_pengirim"] . "</td>";
                echo "<td>" . $row["nama_penerima"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["no_hp"] . "</td>";
                echo "<td>" . $row["keterangan"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            // Tambahkan tombol "Kembali"
            echo "<a href='javascript:history.back()' class='btn btn-secondary'>Kembali</a>";
        } else {
            // Nomor resi tidak ditemukan
            echo "<div class='alert alert-danger'>Nomor Resi Tidak Ditemukan.</div>";
            // Tambahkan tombol "Kembali"
            echo "<a href='javascript:history.back()' class='btn btn-secondary'>Kembali</a>";
        }
    }
    ?>
</div>
</body>
</html>
