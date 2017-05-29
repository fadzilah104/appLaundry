<?php 
    require '../functions/functions.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
    $page = "home";
    $judul = "Tambah Pelanggan";
    $header_name = "TAMBAH PELANGGAN";
    $sub_header_name = " ";
    if (isset($_POST["submit"])) :
        // cek apakah data berhasil diinput
        if (tambahPelanggan($_POST) > 0 ) {
            echo "
                <script>
                    alert('data berhasil diinput');
                    document.location.href = 'home.php';
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
                            <li class="active"><i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Pelanggan</li>
                        </ol>
                    </div>
                </div> <!--row-->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Pelanggan</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8 col-md-offset-2">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="nama">Nama Pelanggan :</label>
                                            <input type="text" class="form-control" name="nama" id="nama" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <div class="pull-right">
                                                <a href="home.php" class="btn btn-danger">Batal</a>
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
