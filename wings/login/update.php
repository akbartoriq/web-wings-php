<!DOCTYPE html>
<html>
<head>
    <title>Form maskapai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['id_peserta'])) {
        $id_peserta=input($_GET["id_peserta"]);

        $sql="select * from peserta where id_peserta=$id_peserta";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);



    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peserta=htmlspecialchars($_POST["id_peserta"]);
        $nama_pengirim=input($_POST["nama_pengirim"]);
        $nama_penerima=input($_POST["nama_penerima"]);
        $alamat=input($_POST["alamat"]);
        $no_hp=input($_POST["no_hp"]);
        $keterangan=input($_POST["keterangan"]);

        //Query update data pada tabel anggota
        $sql="update peserta set
			nama_pengirim='$nama_pengirim',
			nama_penerima='$nama_penerima',
			alamat='$alamat',
			no_hp='$no_hp',
			keterangan='$keterangan'
			where id_peserta=$id_peserta";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:home.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
         <div class="form-group">
            <label>No resi:</label>
            <input value="<?php echo $data["no_resi"]?>" type="text" name="no_resi" class="form-control" placeholder="Masukan no resi" required />
        </div>
        <div class="form-group">
            <label>Nama pengirim:</label>
            <input value="<?php echo $data["nama_pengirim"]?>" type="text" name="nama_pengirim" class="form-control" placeholder="Masukan Nama" required />
        </div>
        <div class="form-group">
            <label>nama penerima:</label>
            <input value="<?php echo $data["nama_penerima"]?>" type="text" name="nama_penerima" class="form-control" placeholder="Masukan Nama" required/>
        </div>
        <div class="form-group">
            <label>alamat penerima:</label>
            <input value="<?php echo $data["alamat"]?>" type="text" name="alamat" class="form-control" placeholder="Masukan alamat" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input value="<?php echo $data["no_hp"]?>" type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>keterangan:</label>
            <input value="<?php echo $data["keterangan"]?>" type="text" name="keterangan" class="form-control" placeholder="" required/>
        </div>

        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />
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