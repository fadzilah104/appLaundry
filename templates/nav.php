<?php
    if (!strcmp($page, "home")) { ?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                <a class="sidebar-brand" href="home.php">
                    <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
                </a>
                <li class="aktif">
                    <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
                </li>
                <li>
                    <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
                </li>
                <li>
                    <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
                </li>
                <li>
                    <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
                </li>
                <li>
                    <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
                </li>
                <li>
                    <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span>Finansial</a>
                </li>
            </ul>
        </div><!-- /#sidebar-wrapper -->
<?php }elseif (!strcmp($page, "pendapatan")) { ?>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <a class="sidebar-brand" href="home.php">
                <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
            </a>
            <li>
                <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
            </li>
            <li>
                <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
            </li>
            <li>
                <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
            </li>
            <li class="aktif">
                <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
            </li>
            <li>
                <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
            </li>
            <li>
                <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span> Finansial</a>
            </li>
        </ul>
    </div><!-- /#sidebar-wrapper -->
<?php }elseif (!strcmp($page, "pengeluaran")) { ?>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <a class="sidebar-brand" href="home.php">
                <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
            </a>
            <li>
                <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
            </li>
            <li>
                <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
            </li>
            <li>
                <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
            </li>
            <li>
                <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
            </li>
            <li class="aktif">
                <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
            </li>
            <li>
                <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span> Finansial</a>
            </li>
        </ul>
    </div><!-- /#sidebar-wrapper -->
<?php }elseif (!strcmp($page, "finansial")){ ?>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <a class="sidebar-brand" href="home.php">
                <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
            </a>
            <li>
                <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
            </li>
            <li>
                <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
            </li>
            <li>
                <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
            </li>
            <li>
                <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
            </li>
            <li>
                <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
            </li>
            <li class="aktif">
                <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span> Finansial</a>
            </li>
        </ul>
    </div><!-- /#sidebar-wrapper -->
<?php }elseif (!strcmp($page,"ongoing-order")) { ?>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <a class="sidebar-brand" href="home.php">
                <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
            </a>
            <li>
                <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
            </li>
            <li class="aktif">
                <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
            </li>
            <li>
                <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
            </li>
            <li>
                <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
            </li>
            <li>
                <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
            </li>
            <li>
                <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span> Finansial</a>
            </li>
        </ul>
    </div><!-- /#sidebar-wrapper -->
<?php }elseif (!strcmp($page, "completed-order")) { ?>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <a class="sidebar-brand" href="home.php">
                <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
            </a>
            <li>
                <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
            </li>
            <li>
                <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
            </li>
            <li class="aktif">
                <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
            </li>
            <li>
                <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
            </li>
            <li>
                <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
            </li>
            <li>
                <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span> Finansial</a>
            </li>
        </ul>
    </div><!-- /#sidebar-wrapper -->

<?php }else { ?>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <a class="sidebar-brand" href="home.php">
                <img src="../images/logo.png" class="center-block" alt="Saban Hari Laundry">
            </a>
            <li>
                <a href="home.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-home fa-stack-1x "></i></span> Home</a>
            </li>
            <li>
                <a href="order-ongoing.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks fa-stack-1x "></i></span>Laundry Berjalan</a>
            </li>
            <li>
                <a href="order-completed.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-check-circle fa-stack-1x "></i></span>Laundry Selesai</a>
            </li>
            <li>
                <a href="pendapatan.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-download fa-stack-1x "></i></span>Pendapatan</a>
            </li>
            <li>
                <a href="pengeluaran.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-upload fa-stack-1x "></i></span>Pengeluaran</a>
            </li>
            <li>
                <a href="finansial.php"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span> Finansial</a>
            </li>
        </ul>
    </div><!-- /#sidebar-wrapper -->
<?php } ?>

