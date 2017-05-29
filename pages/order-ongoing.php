<?php 
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $page = "ongoing-order";
    $judul = "Laundry Berjalan";
    $header_name = "DAFTAR LAUNDRY";
    $sub_header_name = "Laundry Berjalan";
    $query = "
        SELECT
            t.no_transaksi,
            p.nama_pelanggan,
            t.tanggal,
            pk.nama_paket,
            t.jmlh_pakaian,
            t.jmlh_kilo,
            t.harga,
            t.diskon,
            IF(t.status_bayar = 0, 'Belum Lunas', 'Lunas') as status_bayar
        FROM 
            tb_transaksi t, tb_pelanggan p, tb_paket pk
        WHERE 
            t.id_pelanggan = p.id_pelanggan AND
            t.jenis_paket = pk.jenis_paket AND
            status_laundry = 0
            ORDER BY t.no_transaksi DESC";
    $order_ongoing = tampil($query);
    $transaksi_terakhir = getLastTransaksi();
?>
<!DOCTYPE html>
<html lang="en">
<?php require '../templates/header.php'; ?>
<body>
    <div id="wrapper">
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
                            <li class="active"><i class="fa fa-tasks"></i> Laundry Berjalan</li>
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
                                    <a href="../print/print.php?id=<?php echo $transaksi_terakhir; ?>" target="_blank" type="button" class="btn btn-success btn-xs">
                                        <i class="fa fa-print" aria-hidden="true"></i> Cetak Nota Paling Baru
                                    </a>
                                    </div>
                                </div>
                                <h3 class="panel-title"><i class="fa fa-tasks" aria-hidden="true"></i> Laundry Yang Sedang Dalam Proses</h3>
                            </div>    
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tabel" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="100px">No. Transaksi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Tanggal</th>
                                                <th>Paket</th>
                                                <th>Jml</th>
                                                <th>Berat</th>
                                                <th>Diskon</th>
                                                <th>Harga Total</th>
                                                <th>Status Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php   foreach ($order_ongoing as $order): ?>
                                            <tr>
                                                <td align="center">
                                                    <?php echo $order["no_transaksi"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $order["nama_pelanggan"]; ?>     
                                                </td>
                                                <td align="center">
                                                    <?php echo date("d-m-Y",strtotime($order["tanggal"])); ?>
                                                </td>
                                                <td align="center">
                                                    <?php echo $order["nama_paket"]; ?>     
                                                </td>
                                                <td align="center">
                                                    <?php echo $order["jmlh_pakaian"].' pcs'; ?>
                                                </td>
                                                <td align="center">
                                                    <?php echo $order["jmlh_kilo"].' kg'; ?> 
                                                </td>
                                                <td align="center">
                                                    <?php echo $order["diskon"]; ?> 
                                                </td>
                                                <td align="center">Rp. 
                                                    <?php echo number_format($order["harga"], 0, ',', '.'); ?>  
                                                </td>
                                                <td align="center">
                                                    <?php echo $order["status_bayar"]; ?> 
                                                </td>
                                                <td>
                                                    <a href="edit.php?id=<?php echo $order["no_transaksi"]; ?>&page_src=1" type="button" class="btn btn-success btn-sm center-block clearfix" style="margin-bottom : 4px;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                                    <a href="../print/print.php?id=<?php echo $order["no_transaksi"]; ?>" target="_blank" type="button" class="btn btn-info btn-sm center-block clearfix" style="margin-bottom : 4px;"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                                                    <a href="hapus.php?id=<?php echo $order["no_transaksi"]; ?>&page_src=1&type=2" onclick="return confirm('Anda akan menghapus transaksi dengan nomor <?php echo $order["no_transaksi"]; ?>')" type="button" class="btn btn-danger btn-sm center-block clearfix"><i class="fa fa-eraser" aria-hidden="true"></i> Hapus</a>
                                                </td>
                                            </tr>
                                <?php   endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    <?php require '../templates/include-script.php'; ?>
</body>
</html>