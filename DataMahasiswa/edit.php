<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Ambil data mahasiswa berdasarkan ID
    $result = $koneksi->query("SELECT * FROM data_mhs WHERE id_mahasiswa = '$id'");

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        // Tampilkan formulir edit dengan data yang sudah ada
        echo "
            <form method='post' action='proses_edit.php'>
                <input type='hidden' name='id' value='" . $data["id_mahasiswa"] . "'>
                <label for='name'>Nama:</label>
                <input type='text' id='name' name='name' value='" . $data["Nama"] . "' required>
                <label for='Tahun_Masuk'>Tahun_Masuk:</label>
                <input type='text' id='Tahun_Masuk' name='Tahun_Masuk' value='" . $data["Tahun_Masuk"] . "' required>
                <label for='Prodi'>Prodi:</label>
                <input type='text' id='Prodi' name='Prodi' value='" . $data["Prodi"] . "' required>
                <label for='UKT'>UKT:</label>
                <input type='number' id='UKT' name='UKT' value='" . $data["UKT"] . "' required>
                <label for='Alamat'>Alamat:</label>
                <input type='text' id='Alamat' name='Alamat' value='" . $data["Alamat"] . "' required>
                <label for='Email'>Email:</label>
                <input type='text' id='Email' name='Email' value='" . $data["Email"] . "' required>
                <button type='submit' name='submit_edit'>Simpan Perubahan</button>
            </form>
        ";
    } else {
        echo "Data tidak ditemukan.";
    }
}
?>
