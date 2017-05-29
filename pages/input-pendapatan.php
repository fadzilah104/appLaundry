<?php
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $page = "pendapatan";
    $judul = "Input Pendapatan";
    $header_name = "Input Pendapatan";
    $sub_header_name = " ";
    
    if (isset($_POST["submit"])) :
        // cek apakah data berhasil diinput
        if (tambahPendapatan($_POST) > 0 ) {
            echo "
                <script>
                    alert('data berhasil diinput');
                    document.location.href = 'pendapatan.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data gagal diinput');
                    document.location.href = 'pendapatan.php';
                </script>
            ";
        }
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
                            <li class="active"><i class="fa fa-upload" aria-hidden="true"></i> Tambah Pendapatan</li>
                        </ol>
                    </div>
                </div> <!--row-->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-upload" aria-hidden="true"></i> Input Transaksi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi Pendapatan :</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi" value="" autofocus required></textarea>  
                                        </div>
                                         <div class="form-group">
                                            <label for="harga">Harga (Rp): </label>
                                            <input name="harga" id="harga" class="form-control" type="text" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="pull-right">
                                                <a href="pendapatan.php" class="btn btn-danger">Batal</a>
                                                <button class="btn btn-success" type="submit" name="submit">Tambah</button>
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