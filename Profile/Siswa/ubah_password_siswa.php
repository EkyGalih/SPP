<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Ubah Password</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-3 pull-left"></div>
			<div class="col-sm-6">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
				$p = mysqli_fetch_array($sql);
				?>
				<?php
				if ($_SESSION['Error']) {
					?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $_SESSION['Error'] ?>
					</div>
					<?php
				}
				$_SESSION['Error'] = "";
				?>
				<form action="" method="POST" onclick="return validateForm()">
					<input type="hidden" name="id_siswa" value="<?php echo $p['id_siswa'] ?>">
					<label>Password Baru</label>
					<input type="password" name="password_baru" class="form-control" placeholder="Password Baru" autofocus><br/>
					<label>Ulangi Password Baru</label>
					<input type="password" name="ulang_password" class="form-control" placeholder="Ulangi Password Baru"><br/>
					<button type="submit" name="submit" class="btn btn-success btn-md">
						<i class="fa fa-save fa-fw"></i> Simpan
					</button>
				</form>
			</div>
			<div class="col-sm-3 pull-right"></div>
		</div>
	</div>
</body>
</html>
<?php

if (isset($_POST['submit'])) {
	$id 			= $_POST['id_siswa'];
	$new_pass 		= mysqli_real_escape_string($con, $_POST['password_baru']);
	$rep_pass 		= mysqli_real_escape_string($con, $_POST['ulang_password']);
	$ency 			= md5($new_pass);


if ($new_pass != $rep_pass) {
		session_start();
		$_SESSION['Error'] = 'Password baru tidak sama, coba lagi!';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=ubah_password'
	</script>";
}elseif ($new_pass == $rep_pass){

	$query = "UPDATE tbl_siswa SET password='".$ency."' WHERE id_siswa=".$id;

	if (mysqli_query($con, $query)) {
		session_start();
		$_SESSION['Pesan'] = 'Update Password Berhasil!';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=profile'
	</script>";
}else{
	echo "Error : " . $query . "<br/>" . mysqli_error($con);
}
}
}