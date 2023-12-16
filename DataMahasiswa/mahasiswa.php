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

        <!-- Formulir Filter -->
        <form method="GET" action="">
            <div class="row mb-3">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ukt" id="filter_option_ukt" name="filter_options[]">
                <label class="form-check-label" for="filter_option_ukt">Filter berdasarkan UKT</label>
                <div class="col-md-4">
                    <label for="ukt_min_filter" class="form-label">Rentang UKT (Min):</label>
                    <input type="text" class="form-control" id="ukt_min_filter" name="ukt_min_filter" placeholder="Misal: 1000000">
                </div>
                <div class="col-md-4">
                    <label for="ukt_max_filter" class="form-label">Rentang UKT (Max):</label>
                    <input type="text" class="form-control" id="ukt_max_filter" name="ukt_max_filter" placeholder="Misal: 2000000">
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="alamat" id="filter_option_alamat" name="filter_options[]">
                <label class="form-check-label" for="filter_option_alamat">Filter berdasarkan Alamat</label>
                <input type="text" class="form-control" id="Alamat_fil" name="alamat_filter" placeholder="Misal: Surabaya">

            </div>

            <button type="submit" class="btn btn-primary" name="submit_filter">Filter</button>
        </form>

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
            // ...

            // Proses pencarian dengan filter opsi
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit_filter"])) {
                $ukt_min_filter = isset($_GET["ukt_min_filter"]) ? $_GET["ukt_min_filter"] : 0;
                $ukt_max_filter = isset($_GET["ukt_max_filter"]) ? $_GET["ukt_max_filter"] : PHP_INT_MAX;
                $alamat_filter = isset($_GET["alamat_filter"]) ? $_GET["alamat_filter"] : '';
                $filter_options = isset($_GET["filter_options"]) ? $_GET["filter_options"] : [];

                // Buat query pencarian berdasarkan filter
                $sql = "SELECT * FROM data_mhs WHERE 1=1";

                if (in_array("ukt", $filter_options)) {
                    $sql .= " AND UKT BETWEEN $ukt_min_filter AND $ukt_max_filter";
                }

                if (in_array("alamat", $filter_options)) {
                    $sql .= " AND Alamat LIKE '%$alamat_filter%'";
                }

                $result = $koneksi->query($sql);

                // ...

                // Sisanya sama seperti sebelumnya

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
