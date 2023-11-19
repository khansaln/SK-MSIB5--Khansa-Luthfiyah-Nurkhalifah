<?php
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    $id = $_POST["id_obat"];
    $namaObat = $_POST['nama_obat'];
    $jenisObat = $_POST['jenis_obat'];
    $hargaJual = $_POST['harga_jual'];
    $hargaBeli = $_POST['harga_beli'];
    $qty = $_POST['qty'];

    // Ambil informasi file gambar
    $gambarObatPath = $_FILES['gambar_obat']['name'];
    $gambarObatTmpPath = $_FILES['gambar_obat']['tmp_name'];

    // Cek apakah file gambar diunggah
    if (!empty($gambarObatPath)) {
        // Direktori penyimpanan gambar
        $targetDirectory = "../asset/img/upload/";

        // Path lengkap gambar setelah diunggah
        $gambarObatFullPath = $targetDirectory . basename($gambarObatPath);

        // Pindahkan file gambar ke direktori penyimpanan
        if (move_uploaded_file($gambarObatTmpPath, $gambarObatFullPath)) {
            // Proses update data obat dengan gambar
            $queryObat = "UPDATE obat SET 
                            nama_obat = '$namaObat', 
                            jenis_obat = '$jenisObat', 
                            harga_jual = $hargaJual,
                            gambar_obat = '$gambarObatFullPath'
                          WHERE id_obat = $id";

            $resultObat = mysqli_query($conn, $queryObat);

            // Proses update data pembelian_detail
            $queryPembelianDetail = "UPDATE pembelian_detail SET 
                                        harga_beli = $hargaBeli,
                                        subtotal = $hargaBeli * $qty
                                     WHERE id_obat = $id";

            $resultPembelianDetail = mysqli_query($conn, $queryPembelianDetail);

            if ($resultObat && $resultPembelianDetail) {
                echo "<script>alert('Data Berhasil diupdate');</script>";
                header("Location: ../admin/data_obat.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // Proses update data obat tanpa mengubah gambar
        $queryObat = "UPDATE obat SET 
                        nama_obat = '$namaObat', 
                        jenis_obat = '$jenisObat', 
                        harga_jual = $hargaJual
                      WHERE id_obat = $id";

        $resultObat = mysqli_query($conn, $queryObat);

        // Proses update data pembelian_detail
        $queryPembelianDetail = "UPDATE pembelian_detail SET 
                                    harga_beli = $hargaBeli,
                                    qty =  $qty
                                 WHERE id_obat = $id";

        $resultPembelianDetail = mysqli_query($conn, $queryPembelianDetail);

        if ($resultObat && $resultPembelianDetail) {
            header("Location: ../admin/data_obat.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
