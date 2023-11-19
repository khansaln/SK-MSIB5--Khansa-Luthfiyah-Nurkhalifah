<?php
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    // Ambil data dari form
    $id_obat = $_POST['id_obat'];
    $gambar_obat = $_FILES['gambar_obat']['name'];
    $nama_obat = $_POST['nama_obat'];
    $jenis_obat = $_POST['jenis_obat'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $qty = $_POST['qty'];

    // Proses upload gambar
    $target_dir = "../asset/img/aupload";
    $target_file = $target_dir . basename($_FILES["gambar_obat"]["name"]);
    move_uploaded_file($_FILES["gambar_obat"]["tmp_name"], $target_file);

    // Proses insert data ke tabel obat
    $query_obat = "INSERT INTO obat (gambar_obat, nama_obat, jenis_obat, harga_jual) 
                   VALUES ('$gambar_obat', '$nama_obat', '$jenis_obat', '$harga_jual')";
    $result_obat = mysqli_query($conn, $query_obat);

    // Ambil ID obat yang baru ditambahkan
    $id_obat = mysqli_insert_id($conn);

    // Proses insert data ke tabel pembelian_detail
    $query_pembelian_detail = "INSERT INTO pembelian_detail (id_obat, harga_beli, qty) 
                              VALUES ('$id_obat','$harga_beli', '$qty')";
    $result_pembelian_detail = mysqli_query($conn, $query_pembelian_detail);

    if ($result_obat && $result_pembelian_detail) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
        echo "<script>window.location.href='../admin/data_obat.php';</script>";
    } else {
        // Jika gagal, tampilkan alert error
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
