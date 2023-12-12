<?php
session_start();
include("koneksi.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data Mahasiswa</title>
  </head>
  <body>
        <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Mahasiswa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
        <a class="nav-link active" aria-current="page" href="mahasiswa.php">Data</a>
        <a class="nav-link" href="#">belum</a>
      </div>
    </div>
  </div>
</nav>
</div>

<div class="container mt-3">
    <h1>Mahasiswa</h1>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php
    // Proses data yang dikirim dari form
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $id = $_POST["id_mahasiswa"];
        $name = $_POST["name"];
        $Tahun = $_POST["tahun_masuk"];
        $Prodi = $_POST["prodi"];
        $UKT = $_POST["UKT"];
        $Alamat = $_POST["alamat"];
        $Email = $_POST["email"];



        // Simpan data ke dalam tabel mahasiswa pada database
        $sql = "INSERT INTO data_mhs (id_mahasiswa, Nama, Tahun_Masuk, Prodi, Alamat, Email) VALUES ('$id', '$name', '$Tahun', '$Prodi','$UKT','$Alamat','$Email')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<p style='color: green;'>Data berhasil disimpan ke database.</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $koneksi->error . "</p>";
        }
    }
    ?>

    <!-- Tabel untuk menampilkan data mahasiswa -->
    <table class="table table-striped mt-5">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Tahun Masuk</th>
            <th>Prodi</th>
            <th>UKT</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
        // ...

        // Proses pencarian
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit_search"])) {
            $search_keyword = $_GET["search"];

            // Buat query pencarian berdasarkan nama atau angkatan
            $sql = "SELECT * FROM data_mhs WHERE Nama LIKE '%$search_keyword%' OR Prodi LIKE '%$search_keyword%'OR Alamat LIKE '%$search_keyword%'";

            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_mahasiswa"] . "</td>";
                    echo "<td>" . $row["Nama"] . "</td>";
                    echo "<td>" . $row["Tahun Masuk"] . "</td>";
                    echo "<td>" . $row["Prodi"] . "</td>";
                    echo "<td>" . $row["UKT"] . "</td>";
                    echo "<td>" . $row["Alamat"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    // Tambahkan tombol edit dan hapus
                    echo "<td><a href='edit.php?id=" . $row["id_mahasiswa"]  . "'>Edit</a></td>";
                    echo "<td><a href='hapus.php?id=" . $row["id_mahasiswa"] . "'>Hapus</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada hasil pencarian.</td></tr>";
            }
        } else {
            // Tampilkan semua data mahasiswa dari database (tanpa pencarian)
            $result = $koneksi->query("SELECT * FROM data_mhs");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_mahasiswa"] . "</td>";
                    echo "<td>" . $row["Nama"] . "</td>";
                    echo "<td>" . $row["Tahun_Masuk"] . "</td>";
                    echo "<td>" . $row["Prodi"] . "</td>";
                    echo "<td>" . $row["UKT"] . "</td>";
                    echo "<td>" . $row["Alamat"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    // Tambahkan tombol edit dan hapus
                    echo "<td><a href='edit.php?id=" . $row["id_mahasiswa"] . "'>Edit</a></td>";
                    echo "<td><a href='hapus.php?id=" . $row["id_mahasiswa"] . "'>Hapus</a></td>";
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>
  </body>
</html>
