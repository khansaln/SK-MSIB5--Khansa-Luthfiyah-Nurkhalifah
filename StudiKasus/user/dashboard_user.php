<?php
include '../config/koneksi.php';
include '../layout/header.php';
include '../layout/navbar.php';
include '../user/sidebar-user.php';

$sql = "SELECT * FROM obat";
$query = mysqli_query($conn, $sql);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- carousol -->
    <section class="section mx-3" id="carousel">
        <div id="carouselExampleControlsNoTouching" class="carousel slide " data-bs-touch="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://belanja.swiperxapp.com/wp-content/uploads/2020/02/84598865_718479185222975_6175497560954765312_n-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://th.bing.com/th/id/OIP.hOUOW_idIiEhBlD3k2mYXQHaE7?pid=ImgDet&w=1685&h=1123&rs=1" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://cdn-2.tstatic.net/jabar/foto/bank/images/apotek-kbb.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- end carousel -->
    <!-- Content Header (Page header) -->
    <div class="content-header mx-3">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Obat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin/dashboard_admin.php" style="text-decoration: none;">Home</a></li>
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

    <div class="row mx-3">
        <?php


        while ($row = mysqli_fetch_assoc($query)) {
            echo '<div class="col-lg-3 ">';
            echo '<div class="card m-3">';
            echo "<td><img  class='p-1 mx-auto' src='" . $row['gambar_obat'] . "'width='70px' alt='Gambar Obat'></td>";
            echo '<div class="card-body ">';
            echo '<h5 class="text-center">' . $row['nama_obat'] . '</h5>';
            echo '<p class="card-text text-center">' . $row['jenis_obat'] . '</p>';
            echo '<p class="card-text text-center">Rp. ' . $row['harga_jual'] . '</p>';
            echo '<a href="#" class="btn btn-primary mx-5"><i class="fa-solid fa-cart-plus"></i></a>';
            echo '<a href="#" class="btn btn-primary">Beli</a>';
            echo '</div>'; // card-body
            echo '</div>'; // card
            echo '</div>'; // col-md-4
        }

        echo '</div>'; // row
        ?>
    </div>
    <?php include '../layout/footer.php'; ?>