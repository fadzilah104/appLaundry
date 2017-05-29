<?php 
	include 'fpdf.php';
	include '../functions/functions.php';
	$no_transaksi = $_GET["id"];
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
            no_transaksi = '$no_transaksi'";

    $transaksi = tampil($query)[0];

	$pdf = new FPDF('P', 'mm', array(100,150));
	$pdf->AddPage();
	$pdf->SetFont( 'Arial', 'B', 20 );
	$pdf->Cell( 0, 20, 'Saban Hari Laundry', 0, 0, 'C' );
	$pdf->SetFont( 'Courier', 'I', 10);
	$pdf->Ln(15);
	$pdf->Cell( 0, 5, 'Jl. M Saari no. 20 Sunter Jaya', 0, 0, 'C' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Jakarta', 0, 0, 'C' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, '=====================================', 0, 0, 'C' );
	$pdf->SetFont( 'Courier', 'I', 10);
	$pdf->Ln(6);
	$pdf->Cell( 0, 5, 'No. Transaksi : '.$transaksi["no_transaksi"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Tanggal : '.$transaksi["tanggal"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Nama : '.$transaksi["nama_pelanggan"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Berat : '.$transaksi["jmlh_kilo"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Jumlah Pakaian : '.$transaksi["jmlh_pakaian"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Paket : '.$transaksi["nama_paket"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Diskon : '.$transaksi["diskon"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->Cell( 0, 5, 'Pembayaran : '.$transaksi["status_bayar"], 0, 0, 'L' );
	$pdf->Ln(5);
	$pdf->SetFont( 'Courier', 'I', 15); //Set Font
	$pdf->Cell( 0, 5, 'Harga : '.$transaksi["harga"], 0, 0, 'L' );
	$pdf->Ln(6);
	$pdf->SetFont( 'Courier', 'I', 10);
	$pdf->Cell( 0, 5, '=====================================', 0, 0, 'C' );
	$pdf->Ln(8);
	$pdf->Cell( 0, 5, 'Terima kasih atas Kunjungan Anda', 0, 0, 'C' );
	$pdf->Ln(5);
	


	
	$pdf->Output( $transaksi["no_transaksi"].".pdf", "I" );
?>