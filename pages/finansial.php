<?php 
    require '../functions/functions.php';

    if (!isset($_SESSION["username2"])) {
        header("Location: login-finansial.php");
    }elseif (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }

    $page = "finansial";
    $judul = "Laporan Finansial";
    $header_name = "LAPORAN FINANSIAL";
    $sub_header_name = " ";
    $query = "
            SELECT
                id_transaksi,
                no_transaksi,
                tanggal,
                deskripsi,
                debit,
                kredit,
                saldo
            FROM 
                tb_jurnal 
            ORDER BY no_transaksi DESC";
    $jurnal = tampil($query);
    $last_saldo = getLastSaldo();
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
                            <li class="active"><i class="fa fa-book"></i> Laporan finansial</li>
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
                                    
                                </div>
                                <h3 class="panel-title"><i class="fa fa-book" aria-hidden="true"></i> Histori transaksi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tabel" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="100px">No. Transaksi</th>
                                                <th width="70px">Tanggal</th>
                                                <th width="400px">Deskripsi</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th>Saldo </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php   foreach ($jurnal as $jurnal): ?>
                                                <tr>
                                                    <td align="center"><?php echo $jurnal["no_transaksi"]; ?></td>
                                                    <td align="center"><?php echo date("d-m-Y",strtotime($jurnal["tanggal"])); ?></td>
                                                    <td><?php echo $jurnal["deskripsi"]; ?></td>
                                                    <td>Rp. <?php echo number_format($jurnal["kredit"], 0, ',', '.'); ?></td>
                                                    <td>Rp. <?php echo number_format($jurnal["debit"], 0, ',', '.'); ?></td>
                                                    <td>Rp. <?php echo number_format($jurnal["saldo"], 0, ',', '.'); ?></td>
                                                </tr>
                                    <?php   endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Saldo Sekarang</th>
                                                <td><b>Rp. <?php echo number_format($last_saldo, 0, ',', '.'); ?></b></td>
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