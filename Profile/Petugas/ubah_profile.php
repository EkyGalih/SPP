<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Ubah Profile</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-3 pull-left"></div>
			<div class="col-sm-6">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_petugas WHERE id_petugas=".$_GET['id_petugas']);
				$p = mysqli_fetch_array($sql);
				?>
				<form action="" method="POST" onclick="return validateForm()" enctype="multipart/form-data">
					<input type="hidden" name="id_petugas" value="<?php echo $p['id_petugas'] ?>">
					<div class="form-group">
						<label class="col-sm-4 col-sm-4 control-label">Nama Petugas</label>
						<div class="col-sm-8">
							<input type="text" name="nama_petugas" class="form-control" value="<?php echo $p['nama_petugas'] ?>">
						</div><br/>
					</div><br/>
					<div class="form-group">
						<label class="col-sm-4 col-sm-4 control-label">Username</label>
						<div class="col-sm-8">
							<input type="text" name="username" class="form-control" value="<?php echo $p['username'] ?>">
						</div><br/>
					</div><br/>
					<div class="form-group">
						<label class="col-sm-4 col-sm-4 control-label">Hak Akses</label>
						<div class="col-sm-8">
							<input type="text" name="hak_akses" class="form-control" value="<?php echo $p['hak_akses'] ?>" readonly>
						</div><br/>
					</div><br/>
					<!-- <div class="form-group">
						<label class="col-sm-4 col-sm-4 control-label">Photo</label>
						<div class="col-sm-8">
							<img src="Profile/Petugas/<?php echo $p['gambar'];?>" width="200" height="250" class="img-rounded" style="border: 3px solid #888;"/>
						</div><br/><br/>
					</div><br/><br/> -->
					<!-- <div class="form-group">
						<label class="col-sm-4 col-sm-4 control-label"></label>
						<div class="col-sm-8">
							<input type="file" name="gambar" class="form-control"><br/>
						</div><br/><br/>
					</div><br/><br/> -->
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
	$id 		= $_POST['id_petugas'];
	$nama 		= mysqli_real_escape_string($con, $_POST['nama_petugas']);
	$user 		= mysqli_real_escape_string($con, $_POST['username']);
	$hak 		= mysqli_real_escape_string($con, $_POST['hak_akses']);

	//folder tempet gambar
	$target_dir = "Profile/Petugas/Gambar_Petugas/";
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

$query = "UPDATE tbl_petugas SET nama_petugas='".$nama."', username='".$user."', hak_akses='".$hak."', gambar='".$target_file."' WHERE id_petugas=".$id;

if (mysqli_query($con, $query)) {
	session_start();
	$_SESSION['Pesan'] = 'Update Profile Berhasil!';
	echo "<script language='JavaScript'>
	window.location = 'home.php?page=profile'
	</script>";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($con);
}
}