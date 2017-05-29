<?php 
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $page = "completed-order";
    $judul = "Laundry Selesai";
    $header_name = "DAFTAR LAUNDRY";
    $sub_header_name = "Laundry Selesai";
    $query = "
            SELECT
                t.no_transaksi,
                p.nama_pelanggan,
                t.tanggal,
                pk.nama_paket,
                t.jmlh_pakaian,
                t.jmlh_kilo,
                t.harga,
                IF(t.status_bayar = 0, 'Belum Lunas', 'Lunas') as status_bayar
            FROM 
                tb_transaksi t, tb_pelanggan p, tb_paket pk
            WHERE 
                t.id_pelanggan = p.id_pelanggan AND
                t.jenis_paket = pk.jenis_paket AND
                status_laundry = 1
                ORDER BY t.no_transaksi DESC";
    $order_completed = tampil($query);
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
                            <li class="active"><i class="fa fa-check-circle"></i> Laundry Selesai</li>
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
                                <h3 class="panel-title"><i class="fa fa-check-circle" aria-hidden="true"></i> Daftar Laundry Yang Sudah Selesai</h3>
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
                                                <th>Harga Total</th>
                                                <th>Status Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php   foreach ($order_completed as $order): ?>
                                                <tr>
                                                    <td align="center"><?php echo $order["no_transaksi"]; ?></td>
                                                    <td><?php echo $order["nama_pelanggan"]; ?></td>
                                                    <td align="center"><?php echo date("d-m-Y",strtotime($order["tanggal"])); ?></td>
                                                    <td align="center"><?php echo $order["nama_paket"]; ?></td>
                                                    <td align="center"><?php echo $order["jmlh_pakaian"].' pcs'; ?></td>
                                                    <td align="center"><?php echo $order["jmlh_kilo"].' kg'; ?></td>
                                                    <td align="center">Rp. 
                                                    <?php echo number_format($order["harga"], 0, ',', '.'); ?> </td>
                                                    <td align="center"><?php echo $order["status_bayar"]; ?></td>
                                                    <td>
                                                        <a href="edit.php?id=<?php echo $order["no_transaksi"]; ?>&page_src=2" type="button" class="btn btn-success btn-sm center-block clearfix" style="margin-bottom : 4px;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                                        <a href="hapus.php?id=<?php echo $order["no_transaksi"]; ?>&page_src=1&type=2" onclick="return confirm('Anda akan menghapus transaksi dengan nomor <?php echo $order["no_transaksi"]; ?>')" type="button" class="btn btn-danger btn-sm center-block clearfix"><i class="fa fa-eraser" aria-hidden="true"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                    <?php   endforeach ?>
                                        </tbody>
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