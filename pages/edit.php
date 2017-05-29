<?php
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }

    unset($_SESSION["username2"]);

    $id = $_GET["id"]; //Mengambil id dari url
    $page_source = $_GET["page_src"];
    if ($page_source == 1) {
        $page = "ongoing-order";
    }else{
        $page = "completed-order";
    }
    $judul = "Edit Transaksi";
    $header_name = "EDIT TRANSAKSI";
    $sub_header_name = " ";

    $query = "SELECT
                t.no_transaksi,
                p.nama_pelanggan,
                t.tanggal,
                t.jenis_paket,
                pk.nama_paket,
                t.jmlh_pakaian,
                t.jmlh_kilo,
                t.harga,
                t.status_laundry,
                IF(t.status_bayar = 0, 'Belum Lunas', 'Lunas') as status_bayar
            FROM 
                tb_transaksi t, tb_pelanggan p, tb_paket pk
            WHERE 
                t.id_pelanggan = p.id_pelanggan AND
                t.jenis_paket = pk.jenis_paket AND t.no_transaksi = '$id'";
    $order = tampil($query)[0];
    $status = $order["status_bayar"];
    $statusL = $order["status_laundry"]; 
    if (isset($_POST["submit"])) :
        // cek apakah data berhasil diinput
        if (edit($_POST) > 0 ) { ?>
            <script>
                alert('data berhasil diinput');
                <?php   if ($page_source == 1) { ?>
                            document.location.href = 'order-ongoing.php';
                <?php   }else{ ?>
                            document.location.href = 'order-completed.php';
                <?php   } ?>
            </script>
<?php   }else{ ?>
            <script>
                alert('data gagal diinput');
        <?php   if ($page_source == 1) { ?>
                    document.location.href = 'order-ongoing.php';
        <?php   }else{ ?>
                    document.location.href = 'order-completed.php';
        <?php   } ?>
            </script>
<?php   }
    endif;
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
                            <li class="active"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Transaksi</li>
                        </ol>
                    </div>
                </div> <!--row-->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Transaksi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group hidden_input">
                                            <label for="id" class="sr-only">Id :</label>
                                            <input name="id" type="hidden" id="id" value="<?php echo $order["no_transaksi"]; ?>">
                                        </div>
                                        <div class="form-group hidden_input">
                                            <label for="paket" class="sr-only">jenis paket :</label>
                                            <input name="paket" type="hidden" id="paket" value="<?php echo $order["jenis_paket"]; ?>">
                                        </div>
                                        <div class="form-group hidden_input">
                                            <label for="jumlah" class="sr-only">jmlh_pakaian :</label>
                                            <input name="jumlah" type="hidden" id="jumlah" value="<?php echo $order["jmlh_pakaian"]; ?>">
                                        </div>
                                        <div class="form-group hidden_input">
                                            <label for="berat" class="sr-only">jmlh_kilo :</label>
                                            <input name="berat" type="hidden" id="berat" value="<?php echo $order["jmlh_kilo"]; ?>">
                                        </div>
                                        <div class="form-group hidden_input">
                                            <label for="harga" class="sr-only">harga :</label>
                                            <input name="harga" type="hidden" id="harga" value="<?php echo $order["harga"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Pelanggan :</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $order["nama_pelanggan"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_bayar">Status Bayar :</label>
                                            <select class="form-control" id="status_bayar" name="status_bayar" autofocus>
                                                <option value="#" disabled >--Pilih Kondisi--</option>
                                                <?php if($status == "Lunas") :?>
                                                <option value="1" selected>Lunas</option>
                                                <option value="0">Belum Bayar</option>
                                                 <?php else :?>
                                                <option value="1" >Lunas</option>
                                                <option value="0" selected>Belum Bayar</option>
                                            <?php endif ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_laundry">Status Laundry :</label>
                                            <select class="form-control" id="status_laundry" name="status_laundry">
                                                <option value="#" disabled >--Pilih Kondisi--</option>
                                                 <?php if($statusL == 1 ) :?>
                                                <option value="1" selected>Selesai</option>
                                                <option value="0">Berjalan</option>
                                                 <?php else :?>
                                                <option value="1" >Selesai</option>
                                                <option value="0" selected>Berjalan</option>
                                            <?php endif ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="pull-right">
                                        <?php   if ($page_source == 1){ ?>
                                                    <a href="order-ongoing.php" class="btn btn-danger">Batal</a>
                                        <?php   }else{ ?>
                                                    <a href="order-completed.php" class="btn btn-danger">Batal</a>
                                        <?php   } ?>
                                                <button class="btn btn-success" type="submit" name="submit">Simpan</button>
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
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/sidebar_menu.js"></script>
</body>
</html>
