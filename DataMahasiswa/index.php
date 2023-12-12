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
        <a class="nav-link active" aria-current="page" href="mencari_data.php">cari</a>
      </div>
    </div>
  </div>
</nav>
</div>

<div class="container">
    <h2>Data Mahasiswa</h2>
</div>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Your Page Title</title>
</head>
<body>

<div class="container mt-5">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="id_mahasiswa">ID:</label>
            <input type="text" id="id_mahasiswa" name="id_mahasiswa" class="form-control" required>
            <div class="invalid-feedback">
                Please provide an ID.
            </div>
        </div>

        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" class="form-control" required>
            <div class="invalid-feedback">
                Please provide a name.
            </div>
        </div>

        <div class="form-group">
            <label for="angkatan">Angkatan:</label>
            <input type="text" id="angkatan" name="angkatan" class="form-control" required>
            <div class="invalid-feedback">
                Please provide an angkatan.
            </div>
        </div>

        <div class="form-group">
            <label for="NPM">NPM:</label>
            <input type="number" id="NPM" name="NPM" class="form-control" required>
            <div class="invalid-feedback">
                Please provide an NPM.
            </div>
        </div>
        
        <button type="submit" name="submit" class="btn btn-outline-success">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Enable Bootstrap's custom form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>



    <?php
    // Proses data yang dikirim dari form
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $id = $_POST["id_mahasiswa"];
        $name = $_POST["name"];
        $Angkatan = $_POST["angkatan"];
        $NPM = $_POST["NPM"];

        // Simpan data ke dalam tabel mahasiswa pada database
        $sql = "INSERT INTO tb_mahasiswa (id_mahasiswa, Nama, Angkatan, NPM) VALUES ('$id', '$name', '$Angkatan', '$NPM')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<p style='color: green;'>Data berhasil disimpan ke database.</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $koneksi->error . "</p>";
        }
    }
    ?>

    <!-- Tabel untuk menampilkan data mahasiswa -->
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Angkatan</th>
            <th>NPM</th>
            <th>Ubah</th>
            <th>Delete</th>
        </tr>
        <?php
        // ...

        // Proses pencarian
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit_search"])) {
            $search_keyword = $_GET["search"];

            // Buat query pencarian berdasarkan nama atau angkatan
            $sql = "SELECT * FROM tb_mahasiswa WHERE Nama LIKE '%$search_keyword%' OR Angkatan LIKE '%$search_keyword%'";

            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_mahasiswa"] . "</td>";
                    echo "<td>" . $row["Nama"] . "</td>";
                    echo "<td>" . $row["Angkatan"] . "</td>";
                    echo "<td>" . $row["NPM"] . "</td>";
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
            $result = $koneksi->query("SELECT * FROM tb_mahasiswa");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_mahasiswa"] . "</td>";
                    echo "<td>" . $row["Nama"] . "</td>";
                    echo "<td>" . $row["Angkatan"] . "</td>";
                    echo "<td>" . $row["NPM"] . "</td>";
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
