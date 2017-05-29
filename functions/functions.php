<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	function koneksi(){
		// Koneksi ke database dan pilih database tertentu
	    $conn = mysqli_connect("localhost", "root", "") or die ("Koneksi ke database gagal");
	    mysqli_select_db($conn, "laundry") or die("Database Salah");

	    return $conn;
	}

	function hapusPelanggan($id_pelanggan){
		$conn = koneksi();
		$query = "DELETE FROM tb_pelanggan WHERE id_pelanggan = $id_pelanggan";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function hapusTransaksi($no_transaksi){
		$conn = koneksi();
		$query = "DELETE FROM tb_transaksi WHERE no_transaksi = '$no_transaksi'";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function getLastTransaksi(){
		$query = "SELECT no_transaksi FROM tb_transaksi ORDER BY no_transaksi DESC LIMIT 1";
		$transaksi = tampil($query);
		
		if (!empty($transaksi)) {
			$transaksi = tampil($query)[0];
			$hasil =  $transaksi["no_transaksi"];
		}else{
			$hasil = 0;
		}

		return $hasil;
	}

	function tampil($query){
		$conn = koneksi();
		$result = mysqli_query($conn, $query);
		$rows = array();

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function sum($query){
		$conn = koneksi();
		$result = mysqli_query($conn, $query);
		$data = mysqli_fetch_assoc($result);
		return $data;
	}


	function edit($data){
		$conn = koneksi();
		$no_transaksi = htmlspecialchars($data["id"]);

		if (!isset($data["status_bayar"])) {
			$status_bayar = 0;
		}else{
			$status_bayar = htmlspecialchars($data["status_bayar"]);
		}
		if (!isset($data["status_laundry"])) {
			$status_laundry = 0;
		}else{
			$status_laundry = htmlspecialchars($data["status_laundry"]);
		}

		if ($status_bayar == 1 && $status_laundry == 1 ) {
			transaksiToPendapatan($data);
		}
		
		$query = "UPDATE tb_transaksi
				SET status_bayar = '$status_bayar',
					status_laundry = '$status_laundry'
				WHERE no_transaksi = '$no_transaksi'";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);		
	}

	function login($data){
		$username = $data["username"];
		$password = $data["password"];
		$query = "SELECT username, password FROM tb_login WHERE username = '$username' AND password = '$password'";
		$data_login = tampil($query);

		$error = false;
		if (!empty($data_login)) {
			$_SESSION["username"] = $data["username"];
			header("Location: home.php");
		}else{
			$error = true;
		}

		return $error;
	}

	function loginFinansial($data){
		$username = $data["username"];
		$password = $data["password"];
		$query = "SELECT username, password FROM tb_login WHERE username = '$username' AND password = '$password'";
		$data_login = tampil($query);

		$error = false;
		if (!empty($data_login)) {
			$_SESSION["username2"] = $data["username"];
			header("Location: finansial.php");
		}else{
			$error = true;
		}

		return $error;
	}

	function setNol($id){
		$conn = koneksi();
		//cek total kilo
		$query = "SELECT * FROM tb_pelanggan WHERE id_pelanggan = $id";
    	$data_pelanggan = tampil($query)[0];
    	
    	$kiloAkhir = $data_pelanggan["total_kilo"] - 30;
	    // insert data ke database
		$query = "UPDATE tb_pelanggan
				SET total_kilo = $kiloAkhir
				WHERE id_pelanggan = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hitung_record($query){
		$conn = koneksi();
		
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$num_results = $row["total"];
		return $num_results;
	}

	function tambahPelanggan($data){
		$conn = koneksi();
		// pendeklarasian variabel dan pengisiannya.
		$nama_pelanggan = htmlspecialchars($data["nama"]);

	    // insert data ke database
		$query = "INSERT INTO tb_pelanggan
				VALUES
				('','$nama_pelanggan', 0,0)";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	//fungsi yang berkaitan dengan transaksi laundri baru

	function insertCounter(){
		$conn = koneksi();
		$sekarang = date("Y-m-d");
		$query = "INSERT INTO `tb_counter_id` (`counter`, `last_update`) 
				VALUES
				(NULL, CURRENT_DATE())";
		mysqli_query($conn, $query);
	}

	function selectCounter(){
		$conn = koneksi();
		$query = "SELECT * 
					FROM tb_counter_id 
					WHERE counter = (SELECT MAX(counter) 
					FROM tb_counter_id)";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0){
		    $row = mysqli_fetch_assoc($result);
		}else {
		    $row = 0;
		}
    	return $row;
	}

	function deleteAllCounter(){
		$conn = koneksi();
		$query = "TRUNCATE TABLE tb_counter_id";
		mysqli_query($conn, $query);
	}


	function kodeTransaksi(){
		$counter = selectCounter();
		$sekarang = date("Y-m-d");
		
		if ($counter == 0) {
			insertCounter();
			$counter = selectCounter();
			$last_update = $counter["last_update"];
			if ($sekarang == $last_update) {
				insertCounter();
	    		$kode = "LD";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    	}else{
	    		deleteAllCounter();
				insertCounter();
				$counter = selectCounter();
				$kode = "LD";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounter();
			}
		}else{
			$last_update = $counter["last_update"];
			if ($sekarang == $last_update) {
				insertCounter();
	    		$kode = "LD";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    	}else{
	    		deleteAllCounter();
				insertCounter();
				$counter = selectCounter();
				$kode = "LD";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounter();
			}
		}

		return $kode_trans;
	}

	function tambahBerat($id, $berat){
		$conn = koneksi();
	    // insert data ke database
		$query = "UPDATE tb_pelanggan
				SET total_kilo = (total_kilo + $berat)
				WHERE id_pelanggan = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function tambahLaundry($data){
		$conn = koneksi();
		
		$no_transaksi = kodeTransaksi();
		$id_pelanggan = htmlspecialchars($data["id"]);
		$berat = htmlspecialchars($data["berat"]);
		$jumlah = htmlspecialchars($data["jumlah"]);
		$paket = htmlspecialchars($data["paket"]);
		$status_bayar = htmlspecialchars($data["status_bayar"]);
		$harga = htmlspecialchars($data["harga"]);
		$status_laundry = 0;
		
		if (isset($data["checkDiskon"])) {
	        $diskon = 2;
	        tambahBerat($id_pelanggan, $berat);
	        setNol($data["id"]);
	    }else {
			tambahBerat($id_pelanggan, $berat);
	        $diskon = 0;
	    }	
	   			
	    // insert data ke database
		$query = "INSERT INTO tb_transaksi
				VALUES
				('$no_transaksi','$id_pelanggan', CURRENT_DATE(), '$paket', '$jumlah', '$berat', '$diskon', '$status_bayar', '$status_laundry', '$harga')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	//fungsi yg berkaitan dengan pendapatan

	function insertCounterIn(){
		$conn = koneksi();
		$sekarang = date("Y-m-d");
		$query = "INSERT INTO `tb_counter_in` (`counter`, `last_update`) 
				VALUES
				('', CURRENT_DATE())";
		mysqli_query($conn, $query);
	}

	function selectCounterIn(){
		$conn = koneksi();
		$query = "SELECT * 
					FROM tb_counter_in 
					WHERE counter = (SELECT MAX(counter) 
					FROM tb_counter_in)";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0){
		    $row = mysqli_fetch_assoc($result);
		}else {
		    $row = 0;
		}
    	return $row;
	}

	function deleteAllCounterIn(){
		$conn = koneksi();
		$query = "TRUNCATE TABLE tb_counter_in";
		mysqli_query($conn, $query);
	}

	function kodePendapatan(){
		$counter = selectCounterIn();
		$sekarang = date("Y-m-d");
		
		if ($counter == 0) {
			insertCounterIn();
			$counter = selectCounterIn();
			$last_update = $counter["last_update"];
			if ($sekarang == $last_update) {
	    		$kode = "IN";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterIn();
	    	}else{
	    		deleteAllCounterIn();
				insertCounterIn();
				$counter = selectCounterIn();
				$kode = "IN";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterIn();
			}
		}else{
			$last_update = $counter["last_update"];
			if ($sekarang == $last_update) {
	    		$kode = "IN";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterIn();
	    	}else{
	    		deleteAllCounterIn();
				insertCounterIn();
				$counter = selectCounterIn();
				$kode = "IN";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterIn();
			}
		}
		return $kode_trans;
	}

	function tambahPendapatan($data){
		$conn = koneksi();
		
		$no_transaksi = kodePendapatan();
		$deskripsi = htmlspecialchars($data["deskripsi"]);
		$harga = htmlspecialchars($data["harga"]);
			
	    // insert data ke database
		$query = "INSERT INTO tb_pendapatan
				VALUES
				('','$no_transaksi','$deskripsi',CURRENT_DATE(), '$harga')";
		mysqli_query($conn, $query);
		pendapatanToJurnal($deskripsi, $harga, 'Pemasukan');
		return mysqli_affected_rows($conn);
	}

	function transaksiToPendapatan($data){
		$conn = koneksi();
		
		$no_transaksi = kodePendapatan();
		$id_transaksi = htmlspecialchars($data["id"]);
		$berat = htmlspecialchars($data["berat"]);
		$jumlah = htmlspecialchars($data["jumlah"]);
		$paket = htmlspecialchars($data["paket"]);
		
		if ($paket == 1) {
			$deskripsi = 'Laundri kiloan paket reguler '.$berat.' kg, id transaksi : '.$id_transaksi;
		}elseif ($paket == 2) {
			$deskripsi = 'Laundri kiloan paket express '.$berat.' kg, id transaksi : '.$id_transaksi;
		}elseif ($paket == 3) {
			$deskripsi = 'Laundri kiloan paket satuan '.$jumlah.' potong, id transaksi : '.$id_transaksi;
		}
		$harga = htmlspecialchars($data["harga"]);
			
	    // insert data ke database
		$query = "INSERT INTO tb_pendapatan
				VALUES
				('','$no_transaksi','$deskripsi', CURRENT_DATE(), '$harga')";
		mysqli_query($conn, $query);

		pendapatanToJurnal($deskripsi, $harga, 'Pemasukan');

		return mysqli_affected_rows($conn);
	}

	//fungsi yang berkaitan dengan pengeluaran

	function insertCounterOut(){
		$conn = koneksi();
		$sekarang = date("Y-m-d");
		$query = "INSERT INTO `tb_counter_out` (`counter`, `last_update`) 
				VALUES
				(NULL, CURRENT_DATE())";
		mysqli_query($conn, $query);
	}

	function selectCounterOut(){
		$conn = koneksi();
		$query = "SELECT * 
					FROM tb_counter_out 
					WHERE counter = (SELECT MAX(counter) 
					FROM tb_counter_out)";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0){
		    $row = mysqli_fetch_assoc($result);
		}else {
		    $row = 0;
		}
    	return $row;
	}

	function deleteAllCounterOut(){
		$conn = koneksi();
		$query = "TRUNCATE tb_counter_out";
		mysqli_query($conn, $query);
	}

	function kodePengeluaran(){
		$counter = selectCounterOut();
		$sekarang = date("Y-m-d");

		if ($counter == 0) {
			insertCounterOut();
			$counter = selectCounterOut();
			$last_update = $counter["last_update"];

			if ($sekarang == $last_update) {
				insertCounterOut();
	    		$kode = "OUT";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    	}else{
	    		deleteAllCounterOut();
				insertCounterOut();
				$counter = selectCounterOut();
				$kode = "OUT";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterOut();
			}

		}else{

			$last_update = $counter["last_update"];
			
			if ($sekarang == $last_update) {
				insertCounterOut();
	    		$kode = "OUT";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    	}else{
	    		deleteAllCounterOut();
				insertCounterOut();
				$counter = selectCounterOut();
				$kode = "OUT";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterOut();
			}	
		}
		return $kode_trans;
	}

	function tambahPengeluaran($data){
		$conn = koneksi();
		
		$no_transaksi = kodePengeluaran();
		$deskripsi = htmlspecialchars($data["deskripsi"]);
		$harga = htmlspecialchars($data["harga"]);
			
	    // insert data ke database
		$query = "INSERT INTO tb_pengeluaran
				VALUES
				('','$no_transaksi','$deskripsi',CURRENT_DATE(), '$harga')";
		mysqli_query($conn, $query);
		pengeluaranToJurnal($deskripsi, $harga, 'Pengeluaran');
		return mysqli_affected_rows($conn);
	}

	//kumpulan fungsi jurnal

	function insertCounterJur(){
		$conn = koneksi();
		$sekarang = date("Y-m-d");
		$query = "INSERT INTO `tb_counter_jur` (`counter`, `last_update`) 
				VALUES
				(NULL, CURRENT_DATE())";
		mysqli_query($conn, $query);
	}

	function selectCounterJur(){
		$conn = koneksi();
		$query = "SELECT * 
					FROM tb_counter_jur 
					WHERE counter = (SELECT MAX(counter) 
					FROM tb_counter_jur)";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0){
		    $row = mysqli_fetch_assoc($result);
		}else {
		    $row = 0;
		}
    	return $row;
	}

	function deleteAllCounterJur(){
		$conn = koneksi();
		$query = "TRUNCATE tb_counter_jur";
		mysqli_query($conn, $query);
	}

	function kodeJurnal(){
		$counter = selectCounterJur();
		$sekarang = date("Y-m-d");
		if ($counter == 0) {
			insertCounterJur();
			$counter = selectCounterJur();
			$last_update = $counter["last_update"];
			if ($sekarang == $last_update) {
				insertCounterJur();
	    		$kode = "JUR";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    	}else{
	    		deleteAllCounterJur();
				insertCounterJur();
				$counter = selectCounterJur();
				$kode = "JUR";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterOut();
			}
		}else{
			$last_update = $counter["last_update"];
			if ($sekarang == $last_update) {
				insertCounterJur();
	    		$kode = "JUR";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    	}else{
	    		deleteAllCounterJur();
				insertCounterJur();
				$counter = selectCounterJur();
				$kode = "JUR";
	    		$tahun = date("y");
	    		$bulan = date("m");
	    		$hari = date("d");
	    		$nomor_urut = $counter["counter"];
	    		$nomor_urut = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
	    		$kode_trans = $kode."-".$tahun.$bulan.$hari."/".$nomor_urut;
	    		insertCounterOut();
			}
		}
		return $kode_trans;
	}

	function pendapatanToJurnal($deskripsi, $harga, $tipe){
		$conn = koneksi();
		$no_transaksi = kodeJurnal();
		$kredit = $harga;
		$deskripsi = $deskripsi. ', keterangan : '.$tipe;
		$saldo = getLastSaldo() + $kredit;
	    // insert data ke database
		$query = "INSERT INTO tb_jurnal
				VALUES
				('','$no_transaksi',CURRENT_DATE(),'$deskripsi', 0, $kredit, '$saldo')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

	}

	function pengeluaranToJurnal($deskripsi, $harga, $tipe){
		$conn = koneksi();
		$no_transaksi = kodeJurnal();
		$deskripsi = $deskripsi.', keterangan : '.$tipe;
		$debit = $harga;
		$saldo = getLastSaldo() - $debit;
	    // insert data ke database
		$query = "INSERT INTO tb_jurnal
				VALUES
				('','$no_transaksi',CURRENT_DATE(),'$deskripsi','$debit',0, '$saldo')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

	}
	
	function getLastSaldo(){
		$query = "SELECT 
					id_transaksi,
					saldo
					FROM tb_jurnal 
					ORDER BY id_transaksi DESC LIMIT 1";
		$order = tampil($query);
		if (!empty($order)) {
			$order = tampil($query)[0];
			$hasil =  $order["saldo"];
		}else{
			$hasil = 0;
		}

		return $hasil;
	}

?>