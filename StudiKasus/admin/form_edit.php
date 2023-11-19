 <?php
    include '../config/koneksi.php';
    include '../layout/header.php';
    include '../layout/navbar.php';
    include '../layout/sidebar.php';
    ?>
 <!-- ambil data tabel obat -->
 <?php
    $id = $_GET['id_obat'];
    $query = "SELECT * FROM v_obat_pembelian where id_obat = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Form Update row obat</h1>
                 </div>
                 <!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Form update data obat</li>
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
                     <form action="../controller/proses_update_data_obat.php" method="post" enctype="multipart/form-data">
                         <div class="mb-3">
                             <input type="hidden" name="id_obat" class="form-control" id="id" value="<?= $row['id_obat'] ?>">
                         </div>
                         <div class="mb-3">
                             <label for="exampleFormControlInput1" class="form-label">Gambar</label>
                             <input type="file" accept="image/jpeg, image/png, image/gif" name="gambar_obat" class="form-control" id="exampleFormControlInput1" placeholder="choise file">
                         </div>
                         <div class=" mb-3">
                             <label for="exampleFormControlInput1" class="form-label">Nama Obat</label>
                             <input type="text" name="nama_obat" class="form-control" id="exampleFormControlInput1" placeholder="nama obat" value="<?= $row['nama_obat']; ?>">
                         </div>
                         <div class="mb-3">
                             <label for="jenis_obat">Jenis Obat:</label>
                             <select type="text" name="jenis_obat" class="form-control" id="exampleFormControlInput1" placeholder="nama obat">
                                 <?php
                                    $query_jenis_obat = "SHOW COLUMNS FROM obat LIKE 'jenis_obat'";
                                    $result = mysqli_query($conn, $query_jenis_obat);
                                    if ($result) {
                                        $data = mysqli_fetch_assoc($result);
                                        $values = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $data['Type']));

                                        echo "<option value=''>Pilih Jenis Obat</option>";
                                        foreach ($values as $value) {
                                            echo "<option value='$value'>$value</option>";
                                        }

                                        echo "</select>";
                                    } else {
                                        echo "Error: " . mysqli_error($conn);
                                    }

                                    mysqli_close($conn);
                                    ?>
                         </div>

                         <!-- Menambahkan input untuk Harga Beli dan Harga Jual -->
                         <div class="mb-3">
                             <label for="harga_beli">Harga Beli:</label>
                             <input type="text" name="harga_beli" class="form-control" id="harga_beli" placeholder="harga beli" value="<?= $row['harga_beli']; ?>">
                         </div>
                         <div class="mb-3">
                             <label for="harga_jual">Harga Jual:</label>
                             <input type="text" name="harga_jual" class="form-control" id="exampleFormControlInput1" placeholder="harga jual" value="<?= $row['harga_jual']; ?>">
                         </div>

                         <div class="mb-3">
                             <label for="qty" class="form-label">Quantity</label>
                             <input type="text" class="form-control" name="qty" id="qty" rows="3" value="<?= $row['qty']; ?>">
                         </div>
                         <button name="tambah" type="submit" class="btn btn-success" onclick="save()">Simpan</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <script>
         function save() {
             swal('Good job!', 'data berhasil di update!', 'success');
         }
     </script>


     <?php include '../layout/footer.php';; ?>