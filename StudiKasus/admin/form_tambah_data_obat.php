<?php
include '../config/koneksi.php';
include '../layout/header.php';
include '../layout/navbar.php';
include '../layout/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form tambah data obat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form tambah data obat</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <form action="../controller/proses_create_obat.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"></label>
                            <input type="hidden" name="id_obat">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Gambar</label>
                            <input type="file" accept="image/jpeg, image/png, image/gif" name="gambar_obat" class="form-control" id="exampleFormControlInput1" placeholder="Pilih file">
                            <small><i>Max 5MB</i></small>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control" id="exampleFormControlInput1" placeholder="Nama obat">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_obat">Jenis Obat:</label>
                            <select name="jenis_obat" class="form-control" id="exampleFormControlInput1">
                                <?php
                                $query_jenis_obat = "SHOW COLUMNS FROM obat LIKE 'jenis_obat'";
                                $result = mysqli_query($conn, $query_jenis_obat);

                                if ($result) {
                                    $row_enum_values = mysqli_fetch_assoc($result);
                                    $enum_values = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row_enum_values['Type']));

                                    echo "<option value=''>Pilih Jenis Obat</option>";
                                    foreach ($enum_values as $value) {
                                        echo "<option value='$value'>$value</option>";
                                    }
                                } else {
                                    echo "<option value=''>Error: " . mysqli_error($conn) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Harga Jual</label>
                            <input class="form-control" name="harga_jual" id="exampleFormControlTextarea1" rows="3">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Harga Beli</label>
                            <input class="form-control" name="harga_beli" id="exampleFormControlTextarea1" rows="3">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Quantity</label>
                            <input class="form-control" name="qty" id="exampleFormControlTextarea1" rows="3">
                        </div>
                        <button name="tambah" type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include '../layout/footer.php'; ?>