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
                    <h1 class="m-0">Daftar Obat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Obat</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">Daftar Obat</h2>
                    <button class="btn btn-success "><a class="text-light" href="../admin/form_tambah_data_obat.php">Tambahkan Data Obat</a></button>
                    <?php
                    $query = mysqli_query($conn, "SELECT * from obat as o join pembelian_detail as pd on o.id_obat=pd.id_obat;");
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title ">Data Obat</h5>
                                <table class="table table-striped table-hover table-bordered table-fluid">
                                    <thead class="table-info">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Gambar Obat</th>
                                            <th scope="col">Nama obat</th>
                                            <th scope="col">Jenis Obat</th>
                                            <th scope="col">Harga Beli</th>
                                            <th scope="col">Harga Jual</th>
                                            <th scope="col">QTY</th>
                                            <th scope="col" colspan="2" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($query) > 0) {
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $data["id_obat"] ?></td>
                                                    <td> <img src="<?php echo $data["gambar_obat"] ?>" width="100"> </td>
                                                    <td> <?php echo $data["nama_obat"] ?> </td>
                                                    <td> <?php echo $data["jenis_obat"] ?> </td>
                                                    <td> <?php echo $data["harga_beli"] ?></td>
                                                    <td> <?php echo $data["harga_jual"] ?></td>
                                                    <td> <?php echo $data["qty"] ?></td>
                                                    <?php echo "<td class='text-center'><button id='edit' type='button' class='btn btn-success '><a class='text-light' href='../admin/form_edit.php?id_obat=" . $data['id_obat'] . "'><i class='fa-regular fa-pen-to-square'></i> Edit</a></button></td>";
                                                    echo "<td class='text-center'><button id='delete' class='btn btn-danger ' onclick='konfirmasiHapus(" . $data['id_obat'] . ")'><i class='fa-solid fa-trash'></i> Delete</button></td>";
                                                    ?>

                                                </tr>
                                            <?php } ?>
                                        <?php } ?>

                                    </tbody>
                                </table>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    function konfirmasiHapus(id_obat) {

        swal({
                title: "Apakah Kamu yakin?",
                text: "Data akan terhapus!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Redirect ke halaman Proses-hapus-data.php jika konfirmasi disetujui
                    swal({
                        title: "Good job!",
                        text: "Data terhapus!",
                        icon: "success",
                    });
                    setTimeout(function() {
                        window.location.href = "../controller/proses_delete_obat.php?id_obat=" + id_obat;
                    }, 2000);
                } else {
                    swal("Data Batal Di hapus!", {
                        icon: "info",
                    });
                }
            });
    }
</script>







<?php include '../layout/footer.php'; ?>