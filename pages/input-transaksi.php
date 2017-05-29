<?php
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $id = $_GET["id"]; //Mengambil id dari url
    $page = "home";
    $judul = "Input Transaksi";
    $header_name = "INPUT TRANSAKSI";
    $sub_header_name = " ";

    $query = "SELECT * FROM tb_pelanggan WHERE id_pelanggan = $id";
    $data_pelanggan = tampil($query);
    $pelanggan = $data_pelanggan[0];
    $query2 = "SELECT * FROM tb_paket";
    $data_paket = tampil($query2);
    if (isset($_POST["submit"])) :
        // cek apakah data berhasil diinput

        if (tambahLaundry($_POST) > 0 ) {
            echo "
                <script>
                    alert('data berhasil diinput');
                    document.location.href = 'order-ongoing.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data gagal diinput');
                    document.location.href = 'home.php';
                </script>
            ";
        }
    endif;
    echo "<script>";
    echo "var inputBeratAwal= ".json_encode($pelanggan["total_kilo"]).";";    
    echo "</script>";
?>
<!DOCTYPE html>
<html lang="en">
<?php require '../templates/header.php'; ?>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require '../templates/nav.php'; ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <?php require '../templates/nav-top.php'; ?>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li>
                            <a href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                            </li>
                            <li class="active"><i class="fa fa-plus-square" aria-hidden="true"></i> Input Transaksi</li>
                        </ol>
                    </div>
                </div> <!--row-->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus-square" aria-hidden="true"></i> Input Transaksi</h3>
                            </div>
                            <div class="panel-body avoid-this" id="cetak">
                                <div class="col-md-8 col-md-offset-2">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="id" class="sr-only">Id :</label>
                                            <input name="id" type="hidden" id="id" value="<?php echo $pelanggan["id_pelanggan"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Pelanggan :</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $pelanggan["nama_pelanggan"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="paket">Paket :</label>
                                            <select class="form-control" id="paket" name="paket" autofocus>
                                                <option value="#" disabled selected>--Pilih Paket--</option>
                                        <?php   foreach ($data_paket as $row) : ?>
                                                    <option value="<?php echo $row["jenis_paket"]; ?>"><?php echo $row["nama_paket"]." - Rp. ".number_format($row["harga"],0,"","."); ?></option>
                                        <?php   endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="berat">Berat (Kg) :</label>
                                            <input type="text" class="form-control" name="berat" id="berat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga (Rp): </label>
                                            <input name="harga" id="harga" class="form-control" type="text" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Pakaian (Pcs)  :</label>
                                            <input type="text" class="form-control" name="jumlah" id="jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="diskon" >Diskon (Kg) :</label>
                                            <input name="diskon"  id="diskon" value="0" readonly style="width : 44px;border-color:transparent;">Gunakan diskon ? <input type="checkbox" id="checkDiskon" name="checkDiskon" disabled>
                                            <p class="help-block diskon-help">Belum dapat diskon, total laundry pelanggan belum 30 kg</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_bayar">Status Bayar :</label>
                                            <select class="form-control" id="status_bayar" name="status_bayar">
                                                <option value="#" disabled selected>--Pilih Kondisi--</option>
                                                <option value="1">Lunas</option>
                                                <option value="0" selected>Belum Bayar</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="pull-right">
                                                <a href="home.php" class="btn btn-danger">Batal</a>
                                                <button class="btn btn-success " type="submit" name="submit">Tambah</a></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/sidebar_menu.js"></script>
</body>
</html>
