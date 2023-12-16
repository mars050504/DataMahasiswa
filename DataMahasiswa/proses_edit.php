<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_edit"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $Tahun_Masuk = $_POST["Tahun_Masuk"];
    $Prodi = $_POST["Prodi"];
    $UKT = $_POST["UKT"];
    $Alamat = $_POST["Alamat"];
    $Email = $_POST["Email"];

    // Lakukan update data di tabel
    $sql = "UPDATE data_mhs SET Nama='$name', Tahun_Masuk='$Tahun_Masuk', Prodi='$Prodi', UKT='$UKT', Alamat='$Alamat', Email='$Email' WHERE id_mahasiswa='$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>
