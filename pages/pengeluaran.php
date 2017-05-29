<?php 
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $page = "pengeluaran";
    $judul = "Laundry Selesai";
    $header_name = "TRANSAKSI";
    $sub_header_name = "Pengeluaran";
   $query = "
            SELECT
                no_transaksi,
                deskripsi,
                tanggal,
                harga
            FROM 
                tb_pengeluaran
            ORDER BY no_transaksi DESC";
    $query2 = "
            SELECT
               SUM(harga) as total
            FROM 
                tb_pengeluaran ";
    $pengeluaran = tampil($query);
    $total_harga = sum($query2);
    
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
                <!-- Breadcrumbs -->
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="active"><i class="fa fa-upload"></i> Transaksi Pengeluaran</li>
                        </ol>
                    </div>
                </div>
                <!--row-->
                <!-- Konten Page -->
                <div class="row">
                    <!--tabel tambah laundry-->
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                        <!-- Default panel contents -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <div class="btn-group">
                                    <a href="input-pengeluaran.php" type="button" class="btn btn-success btn-xs">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Pengeluaran
                                    </a>
                                    </div>
                                </div>
                                <h3 class="panel-title"><i class="fa fa-upload" aria-hidden="true"></i> Daftar transaksi pengeluaran</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tabel" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="100px">No. Transaksi</th>
                                                <th width="500px">Deskripsi</th>
                                                <th>Tanggal</th>
                                                <th>Harga </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php   foreach ($pengeluaran as $pengeluaran): ?>
                                                <tr>
                                                    <td align="center"><?php echo $pengeluaran["no_transaksi"]; ?></td>
                                                    <td><?php echo $pengeluaran["deskripsi"]; ?></td>
                                                    <td align="center"><?php echo date("d-m-Y",strtotime($pengeluaran["tanggal"])); ?></td>
                                                    <td>Rp. <?php echo number_format($pengeluaran["harga"], 0, ',', '.'); ?></td>
                                                    
                                                </tr>
                                    <?php   endforeach ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <td>
                                                    <b>Rp. <?php echo number_format($total_harga['total'], 0, ',', '.'); ?></b>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- panel body -->
                        </div><!-- panel primary -->
                    </div><!-- col-md-12 -->
                </div> <!-- row -->
            </div><!-- row -->
        </div><!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <?php require '../templates/include-script.php'; ?>
</body>
</html>