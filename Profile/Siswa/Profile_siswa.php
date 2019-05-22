<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Profile Detail</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-3 pull-left"></div>
			<?php
			include "koneksi.php";
			$query = "SELECT * FROM tbl_siswa WHERE nis='$_SESSION[user_login]'";
			$rows = $con->query($query);
			$s = $rows->fetch_array();
			?>
			<div class="col-sm-6">
				<?php
				if ($_SESSION['Pesan']) {
					?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $_SESSION['Pesan'] ?>
					</div>
					<?php
				}
				$_SESSION['Pesan'] = "";
				?>
				<center style="background-color: rgb(209, 212, 216); border-radius: 15px;">
					<br/>
					<img src="<?php echo $s['gambar'] ?>" alt="profile.jpg" height="80px" width="65px" class="img-bordered"><br/>
					<div style="font-size: 20px;">
						<?php echo $s['nama_siswa'] ?> [<i style="font-size: 15px; color: grey;"><u><?php echo $s['nis'] ?></u></i>] ~ 
						<strong><?php echo $s['kategori'] ?></strong> kelas <strong><?php echo $s['kelas'] ?></strong>
					</div>
				</center><br/><br/>
				<center class="tooltip-demo">
					<a data-toggle="tooltip" data-placement="right" title="Lihat Profile" href="home.php?page=ubah_profile_siswa&id_siswa=<?php echo $s['id_siswa'] ?>" class="btn btn-default btn-md">
						<i class="fa fa-eye fa-fw"></i>
					</a>
					<a data-toggle="tooltip" data-placement="right" title="Update Foto" href="home.php?page=ubah_foto_siswa&id_siswa=<?php echo $s['id_siswa'] ?>" class="btn btn-warning btn-md">
						<i class="fa fa-file fa-fw"></i>
					</a>
					<a data-toggle="tooltip" data-placement="right" title="Ubah Password" href="home.php?page=ubah_password_siswa&id_siswa=<?php echo $s['id_siswa'] ?>" class="btn btn-primary btn-md">
						<i class="fa fa-wrench fa-fw"></i>
					</a>
					<a data-toggle="tooltip" data-placement="right" title="keluar" href="home.php?page=keluar" class="btn btn-danger btn-md">
						<i class="fa fa-sign-out fa-fw"></i>
					</a>
				</center>
			</div>
			<div class="col-sm-3 pull-right"></div>
		</div>
	</div>
</body>
</html>