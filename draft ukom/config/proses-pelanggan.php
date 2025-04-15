<?php
include '../config/koneksi.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'simpan') {
    $NamaPelanggan = $_POST['NamaPelanggan'];
    $Alamat = $_POST['Alamat'];
    $NomorTelepon = $_POST['NomorTelepon'];

    mysqli_query($conn, "INSERT INTO pelanggan (NamaPelanggan, Alamat, NomorTelepon) VALUES ('$NamaPelanggan', '$Alamat', '$NomorTelepon')");
    header("Location: ../pages/data-pelanggan.php?pesan=simpan");

} elseif ($action == 'update') {
    $PelangganID = $_POST['PelangganID'];
    $NamaPelanggan = $_POST['NamaPelanggan'];
    $Alamat = $_POST['Alamat'];
    $NomorTelepon = $_POST['NomorTelepon'];

    mysqli_query($conn, "UPDATE pelanggan SET NamaPelanggan='$NamaPelanggan', Alamat='$Alamat', NomorTelepon='$NomorTelepon' WHERE PelangganID='$PelangganID'");
    header("Location: ../pages/data-pelanggan.php?pesan=update");

} elseif ($action == 'hapus') {
    $PelangganID = $_POST['PelangganID'];

    mysqli_query($conn, "DELETE FROM pelanggan WHERE PelangganID='$PelangganID'");
    header("Location: ../pages/data-pelanggan.php?pesan=hapus");

} else {
    header("Location: ../pages/data-pelanggan.php?pesan=aksi_tidak_dikenali");
}
?>
