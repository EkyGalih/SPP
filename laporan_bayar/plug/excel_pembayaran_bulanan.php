<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file hasil ekspor
header("Content-Disposition: attachment; filename=Laporan Pembayaran Bulanan.xls");
 
// Tambahkan table
include 'export_pembayaran_bulanan.php';
?>