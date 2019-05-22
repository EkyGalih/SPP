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
			$query = "SELECT * FROM tbl_petugas WHERE username='$_SESSION[user_login]'";
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
					<img src="assets/img/user.jpg" alt="profile.jpg" height="80px" width="65px" class="img-bordered"><br/>
					<div style="font-size: 20px;">
						<?php echo $s['nama_petugas'] ?> [<i style="font-size: 15px; color: grey;"><u><?php echo $s['username'] ?></u></i>] ~ 
						<strong><?php echo $s['hak_akses'] ?></strong>
					</div>
				</center><br/><br/>
				<center class="tooltip-demo">
					<a data-toggle="tooltip" data-placement="right" title="Ubah Profile" href="home.php?page=ubah_profile&id_petugas=<?php echo $s['id_petugas'] ?>" class="btn btn-default btn-md">
						<i class="fa fa-edit fa-fw"></i>
					</a>
					<a data-toggle="tooltip" data-placement="right" title="Ubah Password" href="home.php?page=ubah_password&id_petugas=<?php echo $s['id_petugas'] ?>" class="btn btn-primary btn-md">
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