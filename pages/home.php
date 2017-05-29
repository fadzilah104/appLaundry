<?php 
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $page = 'home';
    $judul = "Home";
    $header_name = "HOME";
    $sub_header_name = "Laundry Baru";
    
    $query = "SELECT id_pelanggan, nama_pelanggan, total_kilo FROM tb_pelanggan ORDER BY id_pelanggan DESC";
    $data_pelanggan = tampil($query);

    $order_ongoing = hitung_record("
                        SELECT COUNT(no_transaksi) AS total 
                        FROM tb_transaksi
                        WHERE status_laundry = 0;
                    ");
    $order_completed = hitung_record("
                        SELECT COUNT(no_transaksi) AS total 
                        FROM tb_transaksi
                        WHERE status_laundry = 1;
                    ");
    $order_total = hitung_record("
                        SELECT COUNT(no_transaksi) AS total 
                        FROM tb_transaksi;
                    ");
    $pelanggan_total = hitung_record("
                        SELECT COUNT(id_pelanggan) AS total 
                        FROM tb_pelanggan;
                    ");
    $counter = 1;
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
            <div class="container-fluid">
                <?php require '../templates/nav-top.php'; ?>
                <br>
                <!-- row -->
                <!-- Breadcrumbs -->
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Home</li>
                        </ol>
                    </div>
                </div>
                <!--row-->
                <!-- Konten Page -->
                <div class="row">
                    <!--tabel tambah laundry-->
                    <div class="col-md-9">
                        <div class="panel panel-primary panel-pelanggan">
                        <!-- Default panel contents -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <div class="btn-group">
                                    <a href="tambah-pelanggan.php" type="button" class="btn btn-success btn-xs">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Pelanggan
                                    </a>
                                    </div>
                                </div>
                                <h3 class="panel-title"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Tambah Laundry Berdasarkan Pelanggan</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tabel" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50px">No.</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Jumlah Total (Kg)</th>
                                                <th width="100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php   foreach ($data_pelanggan as $pelanggan): ?>
                                                <tr>
                                                    <td align="center"><?php echo $counter ?></td>
                                                    <td><?php echo $pelanggan["nama_pelanggan"]; ?></td>
                                                    <td align="center"><?php echo $pelanggan["total_kilo"]; ?></td>
                                                    <td>
                                                        <a href="input-transaksi.php?id=<?php echo $pelanggan['id_pelanggan']; ?>" type="button" class="btn btn-success btn-sm center-block clearfix" style="margin-bottom : 5px; width : 90px;"><i class="fa fa-plus" aria-hidden="true"></i> Laundry</a>
                                                        <a href="hapus.php?id=<?php echo $pelanggan['id_pelanggan']; ?>&type=1" onclick="return confirm('Anda akan menghapus data pelanggan <?php echo $pelanggan["nama_pelanggan"]; ?>')" type="button" class="btn btn-danger btn-sm center-block clearfix" style="width : 90px;"><i class="fa fa-eraser" aria-hidden="true"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                    <?php   $counter++;
                                            endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart" aria-hidden="true"></i> Rekap</h3>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item"><a href="order-ongoing.php">Laundry Berjalan</a><span class="badge pull-right"><?php echo $order_ongoing; ?></span></li>
                                <li class="list-group-item"><a href="order-completed.php">Laundry Selesai</a><span class="badge pull-right"><?php echo $order_completed; ?></span></li>
                                <li class="list-group-item">Laundry Total<span class="badge pull-right"><?php echo $order_total; ?></span></li>
                                <li class="list-group-item">Total Pelanggan<span class="badge pull-right"><?php echo $pelanggan_total; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
</body>
</html>
<?php require '../templates/include-script.php'; ?>
</script>