<!DOCTYPE html>
<html>
<head>
	<title>App SPP - Tambah Siswa</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-plus fa-fw"></i> Tambah Siswa</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-4 pull-left"></div>
			<div class="col-sm-4">
				<?php
				if ($_SESSION['Pesan']) {
					?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $_SESSION['Pesan'] ?> <a href="home.php?page=siswa" class="alert-link">lihat daftar</a>.
					</div>
					<?php
				}
				$_SESSION['Pesan'] = "";
				?>
				<form action="" method="post" onsubmit="return validateForm()">
					<label>Nis</label>
					<input type="text" name="nis" class="form-control" required autofocus><br/>
					<label>Nama</label>
					<input type="text" name="nama_siswa" class="form-control" required><br/>
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" rows="3" cols="4" required></textarea><br/>
					<label>Jenis Kelamin</label><br/>
					<input type="radio" name="jk" value="laki-laki"> Laki - Laki 
					<input type="radio" name="jk" value="perempuan"> Perempuan<br/><br/>
					<label>Kelas</label>
					<select name="kelas" class="selectSpp form-control" tabindex="-1">
						<option>Pilih</option>
						<option value="X">X</option>
						<option value="XI">XI</option>
						<option value="XII">XII</option>
					</select><br/><br/>
					<label>Jurusan</label>
					<select name="jurusan" class="selectSpp form-control" tabindex="-1">
						<option>Pilih</option>
						<option value="BAHASA">BAHASA</option>
						<option value="IPA">IPA</option>
						<option value="IPS">IPS</option>
					</select><br/><br/>
					<label>Periode</label>
					<select name="periode"  class="selectSpp form-control" tabindex="-1">
						<option>Pilih</option>
						<option value="2017/2018">2017/2018</option>
						<option value="2018/2019">2018/2019</option>
						<option value="2019/2020">2019/2020</option>
						<option value="2020/2021">2020/2021</option>
						<option value="2021/2022">2021/2022</option>
						<option value="2022/2023">2022/2023</option>
					</select><br/><br/>
					<input type="hidden" name="kategori" value="siswa">
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
</body>
</html>
<?php
include "koneksi.php";
if (isset($_POST['submit'])) {
	$nis 		= mysqli_real_escape_string($con, $_POST['nis']);
	$ency 		= md5($nis);
	$nama 		= mysqli_real_escape_string($con, $_POST['nama_siswa']);
	$alamat 	= mysqli_real_escape_string($con, $_POST['alamat']);
	$jk		 	= mysqli_real_escape_string($con, $_POST['jk']);
	$kelas	 	= mysqli_real_escape_string($con, $_POST['kelas']);
	$jurusan 	= mysqli_real_escape_string($con, $_POST['jurusan']);
	$periode 	= mysqli_real_escape_string($con, $_POST['periode']);
	$kategori 	= mysqli_real_escape_string($con, $_POST['kategori']);

	$query	= "INSERT INTO tbl_siswa (nis, password, nama_siswa, alamat, jenis_kelamin, kelas, jurusan, periode, kategori) VALUES ('$nis','$ency','$nama','$alamat','$jk','$kelas','$jurusan','$periode','$kategori')";
	if (mysqli_query($con, $query)) {
		session_start();
		$_SESSION['Pesan'] = 'Tambah Siswa Berhasil';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=tambah_siswa';
		</script>";
	}else{
		echo "Error : " . $query . "<br/>" . mysqli_error($con);
	}
}
?>