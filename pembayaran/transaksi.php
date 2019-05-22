<!DOCTYPE html>
<html>
<head>
	<title>APP SPP - Transaksi</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Proses Transaksi</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-4 pull-left"></div>
			<div class="col-sm-4">
				<form action="" method="post" onsubmit="return validateForm()">
					<label>Nama Siswa</label>
					<select name="nama_siswa" class="selectSpp form-control" tabindex="-1">
						<option>Pilih</option>
						<?php
						include "koneksi.php";
						$sql = "SELECT * FROM tbl_siswa ORDER BY id_siswa DESC";
						$hasil = $con->query($sql);
						if ($hasil == FALSE) {
							trigger_error("Syntax mysql salah: " . $sql . "Error: " . $con->error, E_USER_ERROR);
						} else {
							while ($s = $hasil->fetch_array()) {
								?>
								<option value="<?php echo $s['id_siswa'] ?>"><?php echo $s['nama_siswa'] ?></option>
								<?php
							}
						}
						?>
					</select><br/><br/>
					<label>Jenis Pembayaran</label>
					<select name="jenis_pembayaran" class="selectSpp form-control" tabindex="-1">
						<option>Pilih</option>
						<option value="SPP">SPP</option>
						<option value="DPP">DPP</option>
					</select><br/><br/>
					<label>Tgl Bayar</label>
					<input type="date" name="tgl_bayar" class="form-control"><br/>
					<label>Periode Pembayaran</label>
					<select name="periode_bayar" class="selectSpp form-control" tabindex="-1">
						<option>Pilih</option>
						<option value="2017/2018">2017/2018</option>
						<option value="2018/2019">2018/2019</option>
						<option value="2019/2020">2019/2020</option>
						<option value="2020/2021">2020/2021</option>
						<option value="2021/2022">2021/2022</option>
						<option value="2022/2023">2022/2023</option>
					</select><br/><br/>
					<label>Total Bayar</label>
					<input type="text" name="total_bayar" class="form-control" placeholder="Rp.0"><br/>
					<button type="submit" name="submit" class="btn btn-success btn-md">
						<i class="fa fa-save fa-fw"></i> Simpan
					</button>
					<button type="reset" class="btn btn-danger btn-md">
						<i class="fa fa-backward fa-fw"></i> Batal
					</button>
				</form>
			</div>
			<div class="col-sm-4 pull-right"><p><strong>NB</strong> : </p><p style="color: red; font-size: 10px;">Pembayaran SPP sebesar <strong><u>Rp.500.000,00</u></strong><br/>Pembayaran DPP sebesar <strong><u>Rp.350.000,00</u></strong></p></div>
			<div class="col-sm-12">
				<br/>
				<div class="table-responsive">
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
					<table class="table table-hover table-bordered table-striped" id="TableSpp">
						<thead>
							<tr>
								<th>No</th>
								<th>Nis</th>
								<th>Nama</th>
								<th>Jenis Pembayaran</th>
								<th>Tanggal bayar</th>
								<th>Periode</th>
								<th>Total Bayar</th>
								<th>Status Pembayaran</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<?php
						include "koneksi.php";
						$sql = "SELECT tbl_pembayaran.*, tbl_siswa.* FROM tbl_pembayaran, tbl_siswa WHERE tbl_pembayaran.id_siswa=tbl_siswa.id_siswa ORDER BY id_pembayaran DESC;";
						$hasil = $con->query($sql);
						if ($hasil == FALSE) {
							trigger_error("Syntax mysql salah: " . $sql . "Error: " . $con->error, E_USER_ERROR);
						} else {
							$no=1;
							while ($s = $hasil->fetch_array()) {
								?>
								<tbody>
									<tr>
										<td align="center"><?php echo $no ?></td>
										<td><?php echo $s['nis'] ?></td>
										<td><?php echo $s['nama_siswa'] ?></td>
										<td align="center"><?php echo $s['jenis_pembayaran'] ?></td>
										<td align="center"><?php echo $s['tgl_bayar'] ?></td>
										<td align="center"><?php echo $s['periode_bayar'] ?></td>
										<td align="center">Rp. <?php echo number_format($s['total_bayar'],2,",",".") ?></td>
										<td align="center">
											<?php
											if ($s['status_pembayaran'] == false) {
												?>
												<label class="label label-warning">Belum Lunas</label>
												<?php
											}
											else if ($s['status_pembayaran'] == true) {
												?>
												<label class="label label-success">Lunas</label>
												<?php
											}
											?>
										</td>
										<td align="center" class="tooltip-demo">
											<a data-toggle="tooltip" data-placement="right" title="Ubah data" href="home.php?page=ubah_transaksi&id_pembayaran=<?php echo $s['id_pembayaran'] ?>" class="btn btn-warning btn-sm">
												<i class="fa fa-edit fa-fw"></i>
											</a>
										</td>
									</tr>
								</tbody>
								<?php
								$no++;
							}
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

if (isset($_POST['submit'])) {
	$nama 			= mysqli_real_escape_string($con, $_POST['nama_siswa']);
	$jenis_bayar 	= mysqli_real_escape_string($con, $_POST['jenis_pembayaran']);
	$tgl_bayar		= mysqli_real_escape_string($con, $_POST['tgl_bayar']);
	$periode 		= mysqli_real_escape_string($con, $_POST['periode_bayar']);
	$total_bayar	= mysqli_real_escape_string($con, $_POST['total_bayar']);

	if ($jenis_bayar == 'SPP') {
		if ($total_bayar < 500000) {
			echo $status = 0;
		}
		else if ($total_bayar == 500000 ) {
			echo $status = 1;
		}
	}
	else if ($jenis_bayar == 'DPP') {
		if ($total_bayar < 350000) {
			echo $status = 0;
		}
		else if ($total_bayar == 350000 ) {
			echo $status = 1;
		}
	}

	$query = "INSERT INTO tbl_pembayaran (jenis_pembayaran, tgl_bayar, periode_bayar, total_bayar, status_pembayaran, id_siswa) VALUES ('$jenis_bayar','$tgl_bayar','$periode','$total_bayar','$status','$nama')";

	if (mysqli_query($con, $query)) {
		session_start();
		$_SESSION['Pesan'] = 'Tambah Transaksi Berhasil';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=transaksi';
	</script>";
}
}
// else{
// 	echo "Error : " . $query . "<br/>" . mysqli_error($con);;
// }