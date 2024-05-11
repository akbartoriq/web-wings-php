<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <!-- Mengimpor Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Mengimpor ikon FontAwesome (fontawesome.com) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Mengimpor file CSS terpisah -->
    <link rel="stylesheet" href="style.css">
    <style >
          body {
            background-image: url('../gambar/ct.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: black;
        }
        .header {
            background-color: #ffffff;
            color: #000000;
            padding: 10px;
            position: fixed;
            top: 0;
            width: 100%;
            right: 0%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        .navbar {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar li {
            margin-right: 20px;
        }
    </style>
   
</head>
<body>
    <div class="container">
    <?php
    // Include file koneksi, untuk koneksikan ke database
    include "proses_kontak.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $no_resi = input($_POST["no_resi"]);
        $nama = input($_POST["nama"]);
        $email = input($_POST["email"]);
        $no_hp = input($_POST["no_hp"]);
        $pesan = input($_POST["pesan"]);

        // Query input menginput data kedalam tabel anggota
        $sql = "INSERT INTO report (no_resi, nama, email, no_hp, pesan) VALUES ('$no_resi', '$nama', '$email', '$no_hp', '$pesan')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <div class="header">
        <div class="logo">
            <img src="../gambar/7788.png" alt="Logo Saya" style="width: 70px; height: 70px;">
        </div>
        <ul class="navbar">
            <li><a href="../pencarian/index.php" style="color: skyblue; text-decoration: none;">Cek Resi</a></li>
            <li><a href="../ongkir/index.html" style="color: skyblue; text-decoration: none;">Cek Ongkir</a></li>
            <li><a href="../kontak/index.php" style="color: skyblue; text-decoration: none;">Kontak</a></li>
            <li><a href="../login/index.php" style="color: skyblue; text-decoration: none;">Login</a></li>
        </ul>
    </div>
    <br>
    <br>
    <div class="container">
        <h2>Kontak</h2>
        <h2>Formulir Kontak</h2>
        <h2>Input Data</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
                <label for="no_resi">No Resi</label>
                <input type="text" class="form-control" id="no_resi" name="no_resi">
            </div>
            <div class="form-group">
                <label for="nama">Name *</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No Telp *</label>
                <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="form-group">
                <label for="pesan">Pesan *</label>
                <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
                <a href="../index.html" class="btn btn-secondary">Kembali</a>
        </form>
       <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">    
    <!-- Tombol Kembali -->

</form>

    </form>
</div>
</body>
</html>