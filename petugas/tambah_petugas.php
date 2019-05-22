<!DOCTYPE html>
<html>
<head>
	<title>App SPP - Tambah Petugas</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 align="center">Tambah User</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-4 pull-left"></div>
			<div class="col-sm-4">
				<?php
				if ($_SESSION['Pesan']) {
					?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $_SESSION['Pesan'] ?> <a href="home.php?page=petugas" class="alert-link">lihat daftar</a>.
					</div>
					<?php
				}
				$_SESSION['Pesan'] = "";
				?>
				<form action="" method="post" onsubmit="return validateForm()">
					<label>Nama</label>
					<input type="text" name="nama_user" class="form-control" autofocus required><br/>
					<label>Username</label>
					<input type="text" name="username" class="form-control" required><br/>
					<label>Password</label>
					<input type="text" name="password" class="form-control" required><br/>
					<label>Status</label>
					<select name="status" class="selectSpp form-control" tabindex="-1" required>
						<option>Pilih</option>
						<option value="sysadmin">Sysadmin</option>
						<option value="admin">Admin</option>
						<option value="siswa">Siswa</option>
					</select><br/><br/>
					<button type="submit" name="submit" class="btn btn-success btn-md">
						<i class="fa fa-plus fa-fw"></i> Tambah
					</button>
					<button type="button" class="btn btn-danger btn-md">
						<i class="fa fa-backward fa-fw"></i> Batal
					</button>
				</form>
			</div>
			<div class="col-sm-4 pull-right"></div>
		</div>
	</div>
	<?php include "js.php"; ?>
</body>
</html>
<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
	$nama 		= mysqli_real_escape_string($con, $_POST['nama_user']);
	$username	= mysqli_real_escape_string($con, $_POST['username']);
	$password	= mysqli_real_escape_string($con, $_POST['password']);
	$ency		= md5($password);
	$status		= mysqli_real_escape_string($con, $_POST['status']);

	$query	= "INSERT INTO tbl_petugas (nama_petugas, username, password, hak_akses) VALUES ('$nama','$username','$ency','$status')";
	if (mysqli_query($con, $query)) {
		session_start();
		$_SESSION['Pesan'] = 'Tambah Petugas Berhasil';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=tambah_petugas';
		</script>";
	}else{
		echo "Error : " . $sql . "<br/>" . mysqli_error($con);
	}
}
?>