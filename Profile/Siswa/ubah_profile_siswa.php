<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Detail Profile</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-3 pull-left"></div>
			<div class="col-sm-6">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
				$s = mysqli_fetch_array($sql);
				?>
				<table class="table table-hover table-striped">
					<tr>
						<td>Nama Siswa</td>
						<td>:</td>
						<td><?php echo $s['nama_siswa'] ?></td>
					</tr>
					<tr>
						<td>NIS</td>
						<td>:</td>
						<td><?php echo $s['nis'] ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo $s['alamat'] ?></td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td>:</td>
						<td><?php echo $s['kelas'] ?></td>
					</tr>
					<tr>
						<td>Angkatan</td>
						<td>:</td>
						<td><?php echo $s['periode'] ?></td>
					</tr>
					<tr>
						<td>Jurusan</td>
						<td>:</td>
						<td><?php echo $s['jurusan'] ?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td><?php echo $s['jenis_kelamin'] ?></td>
					</tr>
				</table>
				<a href="home.php?page=profile_siswa" class="btn btn-default btn-sm"><i class="fa fa-backward"></i> Kembali</a>
			</div>
			<div class="col-sm-3 pull-right"></div>
		</div>
	</div>
</body>
</html>