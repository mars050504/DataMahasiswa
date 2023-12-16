<?php
session_start();
include("koneksi.php");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Array untuk memetakan nama kolom di HTML dengan nama kolom di database
$columnMappings = array(
    'id_mahasiswa' => 'ID',
    'Nama' => 'Nama',
    'Tahun_Masuk' => 'Tahun Masuk',
    'Prodi' => 'Program Studi',
    'UKT' => 'UKT',
    'Alamat' => 'Alamat',
    'Email' => 'Email'
);

// Ambil nilai pencarian dari formulir
$searchValue = isset($_GET['search']) ? htmlspecialchars($koneksi->real_escape_string($_GET['search'])) : '';

// Ambil kolom yang dipilih oleh pengguna
$selectedColumns = isset($_GET['selected_columns']) ? $_GET['selected_columns'] : array('id_mahasiswa', 'Nama', 'Tahun_Masuk', 'Prodi', 'UKT', 'Alamat', 'Email');

// Pastikan kolom yang dipilih sesuai dengan daftar yang diizinkan
$allowedColumns = array_keys($columnMappings);
$selectedColumns = array_intersect($selectedColumns, $allowedColumns);

// Bangun string kolom untuk query
$selectedColumnsString = implode(", ", $selectedColumns);

// Contoh perintah SQL langsung menampilkan data yang lebih besar
$query = "SELECT $selectedColumnsString
          FROM data_mhs
          WHERE Nama LIKE '%$searchValue%' OR Tahun_Masuk LIKE '%$searchValue%'";

// Eksekusi query
$result = $koneksi->query($query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error dalam eksekusi query: " . $koneksi->error);
}

// Proses pencarian dengan filter opsi
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit_filter"])) {
    $ukt_min_filter = isset($_GET["ukt_min_filter"]) ? $_GET["ukt_min_filter"] : 0;
    $ukt_max_filter = isset($_GET["ukt_max_filter"]) ? $_GET["ukt_max_filter"] : PHP_INT_MAX;
    $alamat_filter = isset($_GET["alamat_filter"]) ? htmlspecialchars($_GET["alamat_filter"]) : '';
    $filter_options = isset($_GET["filter_options"]) ? $_GET["filter_options"] : [];

    // Buat query pencarian berdasarkan filter
    $sql = "SELECT $selectedColumnsString FROM data_mhs WHERE 1=1";

    if (in_array("ukt", $filter_options)) {
        $sql .= " AND UKT BETWEEN ? AND ?";
    }

    if (in_array("alamat", $filter_options)) {
        $sql .= " AND Alamat LIKE ?";
    }

    // Gunakan prepared statement
    $stmt = $koneksi->prepare($sql);

    if (in_array("ukt", $filter_options)) {
        $stmt->bind_param("ii", $ukt_min_filter, $ukt_max_filter);
    }

    if (in_array("alamat", $filter_options)) {
        $alamat_filter_like = '%' . $alamat_filter . '%';
        $stmt->bind_param("s", $alamat_filter_like);
    }

    // Eksekusi prepared statement
    $stmt->execute();
    $result = $stmt->get_result();
}
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

<div class="container mt-5">
    <h2>Data Mahasiswa</h2>
    <div class="row">
        <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="input-group input-group-sm mb-3">
                        <input name="search" type="text" id="search" class="form-control" placeholder="Cari Nama atau Angkatan" value="<?php echo $searchValue; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit" name="submit_search">Cari</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="selected_columns">Pilih Kolom yang Ingin Ditampilkan:</label>
                    <select name="selected_columns[]" id="selected_columns" class="form-control" multiple>
                        <?php
                        // Tampilkan opsi kolom yang dipilih sebelumnya
                        foreach ($allowedColumns as $column) {
                            $selected = in_array($column, $selectedColumns) ? 'selected' : '';
                            echo "<option value='$column' $selected>{$columnMappings[$column]}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>

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
        </div>
    </form>

    <table class="table table-striped mt-3">
        <tr>
            <?php
            // Tampilkan header kolom yang dipilih
            foreach ($selectedColumns as $column) {
                echo "<th>{$columnMappings[$column]}</th>";
            }
            ?>
        </tr>

        <?php
        // Tampilkan data hasil query
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // Tampilkan nilai dari setiap kolom yang dipilih
            foreach ($selectedColumns as $column) {
                echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <!-- ... (Bagian Script dan Koneksi Bootstrap Lainnya) ... -->
</body>
</html>

<?php
// Tutup koneksi
$koneksi->close();
?>