<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .navbar {
            margin-bottom: 20px;
        }
        h4 {
            text-align: center;
        }
        .btn-toolbar {
            margin: 10px 0;
        }
    </style>
</head>
<title>wings</title>
<body>
<nav class="navbar navbar-dark bg-primary">
    <a href="php/logout.php"> <button class="btn btn-light">Log Out</button> </a>
    <span class="navbar-brand mb-0 h1">Admin</span>
   <a href="data.php" id="reportButton" class="btn btn-light ml-auto">Report</a>
</nav>
<div class="container">
    <br>
    <h4><center>Daftar Barang</center></h4>
<?php

    include "koneksi.php";

    //Cek apakah ada kiriman form dari method post
    if (isset($_GET['id_peserta'])) {
        $id_peserta=htmlspecialchars($_GET["id_peserta"]);

        $sql="delete from peserta where id_peserta='$id_peserta' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:home.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


     <tr class="table-danger">
            <br>
        <thead>
        <tr>
       <table class="my-3 table table-bordered">
            <tr class="table-primary">           
            <th>No</th>
            <th>no resi</th>
            <th>Nama pengirim</th>
            <th>Nama penerima</th>
            <th>Alamat penerima</th>
            <th>No Hp</th>
            <th>Status</th>
            <th colspan='2'>Aksi</th>

        </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="select * from peserta order by id_peserta desc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["no_resi"]; ?></td>
                <td><?php echo $data["nama_pengirim"]; ?></td>
                <td><?php echo $data["nama_penerima"];   ?></td>
                <td><?php echo $data["alamat"];   ?></td>
                <td><?php echo $data["no_hp"];   ?></td>
                <td><?php echo $data["keterangan"];   ?></td>
                <td>
                    <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-success" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
</div>
<script>
    // Fungsi untuk menampilkan notifikasi
    function showNotification() {
        var reportButton = document.getElementById('reportButton');
        reportButton.classList.add('btn-danger'); // Tambahkan class 'btn-danger' untuk warna merah
    }

    // Panggil fungsi showNotification() ketika ada notifikasi yang muncul
    // Contoh: Ketika ada pesan baru atau tindakan yang memerlukan perhatian
    // Anda dapat memanggil fungsi ini sesuai kebutuhan Anda.
    // Misalnya, setelah pesan baru diterima atau saat tindakan tertentu dilakukan.
    // Jangan lupa untuk menghapus notifikasi saat pengguna sudah melihatnya.
</script>
</body>
</html>
