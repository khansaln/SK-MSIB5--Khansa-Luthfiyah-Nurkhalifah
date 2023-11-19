<?php
include '../config/koneksi.php';

if (isset($_GET['id_obat'])) {
    $id = $_GET['id_obat'];
    $sql = "DELETE FROM obat WHERE id_obat= $id";
    $query = mysqli_query($conn, $sql);

    // cek query simpan data berhasil atau tidak
    if ($query) {

        header('Location: ../admin/data_obat.php');
    } else {

        header('Location: ../admin/data_obat.php');
    }
} else {
    die('akses di larang ...');
}
