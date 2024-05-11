<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kontak</title>
    <!-- Mengimpor Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Data Kontak</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>No Resi</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Pesan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = "localhost";
                $user = "root";
                $password = "";
                $db = "tutorial";

                $kon = mysqli_connect($host, $user, $password, $db);
                if (!$kon) {
                    die("Koneksi Gagal: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM report"; // Ganti nama_tabel dengan nama tabel yang benar

                $result = mysqli_query($kon, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["no_resi"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["no_hp"] . "</td>";
                        echo "<td>" . $row["pesan"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data yang tersedia</td></tr>";
                }

                mysqli_close($kon);
                ?>
            </tbody>

        </table>
         <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>
    <!-- Mengimpor Bootstrap JS dan jQuery untuk responsif dan fitur lainnya -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
