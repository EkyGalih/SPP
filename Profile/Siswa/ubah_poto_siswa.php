<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Ubah Foto Profile</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-3 pull-left"></div>
			<div class="col-sm-6">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=".$_GET['id_siswa']);
				$p = mysqli_fetch_array($sql);
				?>
				<form action="" method="POST" onclick="return validateForm()" enctype="multipart/form-data">
					<input type="hidden" name="id_siswa" value="<?php echo $p['id_siswa'] ?>">
					<div class="form-group">
						<label class="col-sm-4 col-sm-4 control-label">Photo</label>
						<div class="col-sm-8">
							<img src="<?php echo $p['gambar'];?>" width="200" height="250" class="img-rounded" style="border: 3px solid #888;"/>
							<input type="file" name="gambar" value="<?php echo $p['gambar'] ?>" class="form-control" required><br/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label"></label>
						<div class="col-sm-8">
							<button type="submit" name="submit" class="btn btn-success btn-sm">
								<i class="fa fa-save fa-fw"></i> Simpan
							</button>
							<a href="home.php?page=profile" class="btn btn-warning btn-sm">
								<i class="fa fa-backward"></i> Kembali
							</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-3 pull-right"></div>
		</div>
	</div>
</body>
</html>
<?php

if (isset($_POST['submit'])) {
	$id 		= $_POST['id_siswa'];
//folder tempet gambar
	$target_dir = "Profile/Siswa/Gambar_siswa/";
//target nama file di folder
	$target_file = $target_dir . basename($_FILES["gambar"]["name"]);
//masih keadaan oke
	$uploadOk = 1;
//dapetin tipe file
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// cek apakah gambar ato gambar palsu
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["gambar"]["tmp_name"]);
		if($check !== false) {
			echo "fil adalah gambar - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "file bukan gambar.";
			$uploadOk = 0;
		}
	}
// cek apakah file sudah ada
	if (file_exists($target_file)) {
		echo "Sorry, file sudah ada.";
		$uploadOk = 0;
	}
// cek ukuran
	if ($_FILES["gambar"]["size"] > 500000) {
		echo "Sorry, file terlalu besar.";
		$uploadOk = 0;
	}
// ijinkan format tertentu
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, hanya JPG, JPEG, PNG & GIF diijinkan.";
	$uploadOk = 0;
}
// cek jika upload = 0
if ($uploadOk == 0) {
	echo "Sorry, file tidak diupload.";
// jika uploadOk = 1 maka upload gambar
} else {
	if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
		echo "File ". basename( $_FILES["gambar"]["name"]). " sudah di upload.";
	} else {
		echo "Sorry, terjadi error saat upload file. ".basename( $_FILES["gambar"]["name"]);
	}
}

$query = "UPDATE tbl_siswa SET gambar='".$target_file."' WHERE id_siswa=".$id;

if (mysqli_query($con, $query)) {
	session_start();
	$_SESSION['Pesan'] = 'Update Foto Profile Berhasil!';
	echo "<script language='JavaScript'>
	window.location = 'home.php?page=profile'
	</script>";
}
}