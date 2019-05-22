<?php
require 'koneksi.php';
$sql = $con->query("SELECT * FROM tbl_pembayaran WHERE id_siswa=$_GET[id_siswa]");
$p = mysqli_fetch_array($sql);

if ($p['id_siswa'] != NULL) {
	$_SESSION['Pesan'] = 'Siswa terkait memiliki data pembayaran, anda tidak bisa melakukan penghapusan!';
	?>
	<script>
		document.location = 'home.php?page=siswa'
	</script>
	<?php
}elseif ($p['id_siswa'] == NULL) {
	$con->query("DELETE FROM tbl_siswa where id_siswa=".$_GET['id_siswa']);

	$_SESSION['Pesan'] = 'Data siswa berhasil dihapus';
	?>
	<script>
		document.location = 'home.php?page=siswa'
	</script>
	<?php
}

