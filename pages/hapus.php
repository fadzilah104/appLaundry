<?php
	require '../functions/functions.php';
	if (!isset($_SESSION["username"])) {
        header("Location: login-awal.php");
    }
    unset($_SESSION["username2"]);
	$type = $_GET["type"];

	if ($type == 1) {
		if (hapusPelanggan($_GET["id"]) > 0) {
			echo "
					<script>
						document.location.href = 'home.php';
					</script>
				";
		}else{
			echo "
					<script>
						alert('data gagal dihapus');
						document.location.href = 'home.php';
					</script>
				";
		}
	}else{
		$page_source = $_GET["page_src"];
	    if ($page_source == 1) {
	        $page = "order-ongoing";
	    }else{
	        $page = "order-completed";
	    }

	    if (hapusTransaksi($_GET["id"]) > 0) {
			echo "
					<script>
						document.location.href = '$page.php';
					</script>
				";
		}else{
			echo "
					<script>
						alert('data gagal dihapus');
						document.location.href = '$page.php';
					</script>
				";
		}
	}
?>