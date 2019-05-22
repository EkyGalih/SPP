<!DOCTYPE html>
<html>
<head>
	<title>App SPP - Ubah Siswa</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 align="center">Ubah Siswa</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-4 pull-left"></div>
			<div class="col-sm-4">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
				$s = mysqli_fetch_array($sql);
				?>
				<form action="" method="post" onsubmit="return validateForm()">
					<input type="hidden" name="id_siswa" value="<?php echo $s['id_siswa'] ?>">
					<label>Nis</label>
					<input type="text" name="nis" value="<?php echo $s['nis'] ?>" class="form-control"><br/>
					<label>Nama</label>
					<input type="text" name="nama_siswa" value="<?php echo $s['nama_siswa'] ?>" class="form-control"><br/>
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" rows="3" cols="4"><?php echo $s['alamat'] ?></textarea><br/>
					<label>Jenis Kelamin</label><br/>
					<?php
					$sql = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
					$r = mysqli_fetch_array($sql);
					?>
					<input type="radio" name="jk"  value="laki-laki" <?php if(isset($r['jenis_kelamin']) && $r['jenis_kelamin'] == 'laki-laki') {echo "checked";} ?>> Laki - Laki 
					<input type="radio" name="jk" value="perempuan" <?php if(isset($r['jenis_kelamin']) && $r['jenis_kelamin'] == 'perempuan') {echo "checked";} ?>> Perempuan<br/><br/>
					<label>Kelas</label>
					<select name="kelas" class="selectSpp form-control" tabindex="-1">
						<?php
						$kelas = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
						$k = mysqli_fetch_array($kelas);
						?>
						<option value="X" <?php if(isset($k['kelas']) && $k['kelas'] == 'X') {echo "selected";} ?>>X</option>
						<option value="XI" <?php if(isset($k['kelas']) && $k['kelas'] == 'XI') {echo "selected";} ?>>XI</option>
						<option value="XII" <?php if(isset($k['kelas']) && $k['kelas'] == 'XII') {echo "selected";} ?>>XII</option>
					</select><br/><br/>
					<label>Jurusan</label>
					<select name="jurusan" class="selectSpp form-control" tabindex="-1">
						<?php
						$sql = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
						$r = mysqli_fetch_array($sql);
						?>
						<option value="BAHASA" <?php if(isset($r['jurusan']) && $r['jurusan'] == 'BAHASA') {echo "selected";} ?>>BAHASA</option>
						<option value="IPA" <?php if(isset($r['jurusan']) && $r['jurusan'] == 'IPA') {echo "selected";} ?>>IPA</option>
						<option value="IPS" <?php if(isset($r['jurusan']) && $r['jurusan'] == 'IPS') {echo "selected";} ?>>IPS</option>
					</select><br/><br/>
					<label>Periode</label>
					<input type="text" name="periode" class="form-control" value="<?php echo $r['periode'] ?>" readonly><br/>
					<input type="hidden" name="kategori" value="<?php echo $r['kategori'] ?>">
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
	$id 		= $_POST['id_siswa'];
	$nis 		= mysqli_real_escape_string($con, $_POST['nis']);
	$nama 		= mysqli_real_escape_string($con, $_POST['nama_siswa']);
	$alamat 	= mysqli_real_escape_string($con, $_POST['alamat']);
	$jk		 	= mysqli_real_escape_string($con, $_POST['jk']);
	$kelas	 	= mysqli_real_escape_string($con, $_POST['kelas']);
	$jurusan 	= mysqli_real_escape_string($con, $_POST['jurusan']);
	$periode 	= mysqli_real_escape_string($con, $_POST['periode']);
	$kategori 	= mysqli_real_escape_string($con, $_POST['kategori']);

	$query	= "UPDATE tbl_siswa SET nis='".$nis."', nama_siswa='".$nama."', alamat='".$alamat."', jenis_kelamin='".$jk."', kelas='".$kelas."', jurusan='".$jurusan."', periode='".$periode."', kategori='".$kategori."' WHERE id_siswa=".$id;
	if (mysqli_query($con, $query)) {
		session_start();
		$_SESSION['Pesan'] = 'Ubah Data Siswa Berhasil';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=siswa';
	</script>";
}
}
?>