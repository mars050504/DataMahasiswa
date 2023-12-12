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
        <a class="nav-link active" aria-current="page" href="mencari_data.php">cari</a>
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
    <table class="table table-striped mt-5">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Tahun Masuk</th>
            <th>Prodi</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
  </body>
</html>
