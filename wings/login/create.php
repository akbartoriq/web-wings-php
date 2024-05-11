<!DOCTYPE html>
<html>
<head>
    <title>Form barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Fungsi untuk menghasilkan nomor resi yang unik
    function generateUniqueResi($koneksi) {
        $nomor_resi = ""; // Inisialisasi nomor resi
        do {
            $nomor_resi = "Wings" . rand(1000000000000, 9999999999999); // Contoh format nomor resi (R123456)
            $query = "SELECT COUNT(*) as count FROM peserta WHERE no_resi = '$nomor_resi'";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
        } while ($count > 0);
        return $nomor_resi;
    }

    // Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $no_resi = generateUniqueResi($kon); // Menghasilkan nomor resi yang unik
        $nama_pengirim = input($_POST["nama_pengirim"]);
        $nama_penerima = input($_POST["nama_penerima"]);
        $alamat = input($_POST["alamat"]);
        $no_hp = input($_POST["no_hp"]);
        $keterangan = input($_POST["keterangan"]);

        // Query input menginput data kedalam tabel anggota
        $sql = "INSERT INTO peserta (no_resi, nama_pengirim, nama_penerima, alamat, no_hp, keterangan) VALUES ('$no_resi', '$nama_pengirim', '$nama_penerima', '$alamat', '$no_hp', '$keterangan')";

        // Mengeksekusi/menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: home.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>no resi:</label>
            <input type="text" name="no_resi" class="form-control" value="<?php echo generateUniqueResi($kon); ?>" readonly />
        </div>
            <div class="form-group">
            <label>Nama pengirim:</label>
            <input type="text" name="nama_pengirim" class="form-control" placeholder="Masukan Nama" required />
        </div>
        <div class="form-group">
            <label>nama penerima:</label>
            <input type="text" name="nama_penerima" class="form-control" placeholder="Masukan Nama" required/>
        </div>
       <div class="form-group">
            <label>alamat penerima :</label>
            <input type="text" name="alamat" class="form-control" placeholder="Masukan alamat" required/>
        </div>
                </p>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>keterangan:</label>
            <textarea name="keterangan" class="form-control" rows="5"placeholder="Masukan keterangan" required></textarea>
        </div>   
       <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <!-- ... Form input lainnya tetap sama seperti yang Anda punya sebelumnya ... -->
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    
    <!-- Tombol Kembali -->
    <a href="home.php" class="btn btn-secondary">Kembali</a>
</form>

    </form>
</div>
</body>
</html>
