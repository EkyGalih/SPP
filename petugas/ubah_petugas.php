<!DOCTYPE html>
<html>
<head>
	<title>App SPP - Ubah Petugas</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 align="center">Ubah Data Petugas</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-4 pull-left"></div>
			<div class="col-sm-4">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_petugas WHERE id_petugas=".$_GET['id_petugas']);
				$p = mysqli_fetch_array($sql);
				?>
				<form action="" method="post" onsubmit="return validateForm()">
					<input type="hidden" name="id_petugas" value="<?php echo $p['id_petugas'] ?>">
					<label>Nama</label>
					<input type="text" value="<?php echo $p['nama_petugas'] ?>" name="nama_user" class="form-control" autofocus><br/>
					<label>Username</label>
					<input type="text" value="<?php echo $p['username'] ?>" name="username" class="form-control"><br/>
							<!-- <label>Password</label>
							<input type="text" value="<?php echo $p['password'] ?>" name="password" class="form-control"><br/> -->
							<label>Status</label>
							<select name="status" class="selectSpp form-control" tabindex="-1">
								<?php
								$status = $con->query("SELECT * FROM tbl_petugas WHERE id_petugas=".$_GET['id_petugas']);
								$r = mysqli_fetch_array($status);
								?>
								<option value="admin" <?php if(isset($r['hak_akses']) && $r['hak_akses'] == 'petugas') {echo "selected";} ?>>Petugas</option>
								<option value="siswa" <?php if(isset($r['hak_akses']) && $r['hak_akses'] == 'siswa') {echo "selected";} ?>>Siswa</option>
							</select><br/><br/>
							<button type="submit" name="submit" class="btn btn-success btn-md">
								<i class="fa fa-save fa-fw"></i> Simpan
							</button>
							<button type="button" class="btn btn-danger btn-md">
								<i class="fa fa-backward fa-fw"></i> Batal
							</button>
						</form>
					</div>
					<div class="col-sm-4 pull-right"></div>
				</div>
			</div>
		</body>
		</html>
		<?php

		if (isset($_POST['submit'])) {
			$id 		= $_POST['id_petugas'];
			$nama 		= mysqli_real_escape_string($con, $_POST['nama_user']);
			$username	= mysqli_real_escape_string($con, $_POST['username']);
			$status		= mysqli_real_escape_string($con, $_POST['status']);

			$query	= "UPDATE tbl_petugas SET nama_petugas='".$nama."', username='".$username."', hak_akses='".$status."' WHERE id_petugas=".$id;
			if (mysqli_query($con, $query)) {
				session_start();
				$_SESSION['Pesan'] = 'Ubah Petugas Berhasil';
				echo "<script language='JavaScript'>
				window.location = 'home.php?page=petugas';
			</script>";
		}
	}
	?>