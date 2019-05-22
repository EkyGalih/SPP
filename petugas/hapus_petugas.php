<?php
require 'koneksi.php';
$con->query("DELETE FROM tbl_petugas where id_petugas=$_GET[id_petugas]");

session_start();
$_SESSION['Pesan'] = 'Data petugas berhasil dihapus';
?>
<script>
	document.location = 'home.php?page=petugas'
</script>