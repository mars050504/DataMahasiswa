<?php
session_start();
include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h2 {
            color: #0066cc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

<div class="container">
    <h2>Data Mahasiswa</h2>
</div>
    
    <!-- Formulir pencarian -->
    <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="search">Cari Nama atau Angkatan atau Alamat:</label>
        <input type="text" id="search" name="search" placeholder="Masukkan nama atau angkatan atau Alamat.">
        <button type="submit" name="submit_search">Cari</button>
    </form>

    <!-- Form untuk menambahkan karyawan -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="id_mahasiswa">ID:</label>
        <input type="text" id="id_mahasiswa" name="id_mahasiswa" required>

        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="Tahun_Masuk">Tahun Masuk:</label>
        <input type="text" id="Tahun_Masuk" name="Tahun_Masuk" required>

        <label for="Prodi">Prodi:</label>
        <input type="text" id="Prodi" name="Prodi" required>

        <label for="UKT">UKT:</label>
        <input type="number" id="UKT" name="UKT" required>

        <label for="Alamat">Alamat:</label>
        <input type="text" id="Alamat" name="Alamat" required>

         <label for="Email">Email:</label>
        <input type="text" id="Email" name="Email" required>

        <button type="submit" name="submit">Simpan</button>
    </form>

    <?php
    // Proses data yang dikirim dari form
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $id = $_POST["id_mahasiswa"];
        $name = $_POST["name"];
        $Tahun_Masuk = $_POST["Tahun_Masuk"];
        $Prodi = $_POST["Prodi"];
        $UKT = $_POST["UKT"];
        $Alamat = $_POST["Alamat"];
        $Email = $_POST["Email"];




        // Simpan data ke dalam tabel mahasiswa pada database
        $sql = "INSERT INTO data_mhs (id_mahasiswa, Nama, Tahun_Masuk, Prodi, UKT, Alamat, Email) VALUES ('$id', '$name', '$Tahun_Masuk', '$Prodi', '$UKT', '$Alamat', '$Email')";

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
            $sql = "SELECT * FROM data_mhs WHERE Nama LIKE '%$search_keyword%' OR Tahun_Masuk LIKE '%$search_keyword%' OR Alamat LIKE '%$search_keyword%'";

            $result = $koneksi->query($sql);


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
