<!DOCTYPE html>
<html>
<head>
	<title>APP SPP - Transaksi</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Ubah Transaksi</h4>
		</div>
		<div class="panel-body">
			<div class="col-sm-4 pull-left"></div>
			<div class="col-sm-4">
				<?php
				include "koneksi.php";
				$sql = $con->query("SELECT * FROM tbl_pembayaran WHERE id_pembayaran=$_GET[id_pembayaran]");
				$p = mysqli_fetch_array($sql);
				$sql2 = $con->query("SELECT * FROM tbl_siswa WHERE id_siswa=$p[id_siswa]");
				$s = mysqli_fetch_array($sql2);
				?>
				<form action="" method="post" onsubmit="return validateForm()">
					<input type="hidden" name="id_pembayaran" value="<?php echo $p['id_pembayaran'] ?>">
					<input type="hidden" name="id_siswa" value="<?php echo $s['id_siswa'] ?>">
					<label>Nama Siswa</label>
					<input type="text" name="nama_siswa" class="form-control" value="<?php echo $s['nama_siswa'] ?>" disabled><br/>
					<label>Jenis Pembayaran</label>
					<select name="jenis_pembayaran" class="selectSpp form-control" tabindex="-1">
						<?php
						include "koneksi.php";
						$status = $con->query("SELECT * FROM tbl_pembayaran WHERE id_pembayaran=".$_GET['id_pembayaran']);
						$r = mysqli_fetch_array($status);
						?>
						<option value="SPP" <?php if(isset($r['jenis_pembayaran']) && $r['jenis_pembayaran'] == 'SPP') {echo "selected";} ?>>SPP</option>
						<option value="DPP" <?php if(isset($r['jenis_pembayaran']) && $r['jenis_pembayaran'] == 'DPP') {echo "selected";} ?>>DPP</option>
					</select><br/><br/>
					<label>Tgl Bayar</label>
					<input type="date" value="<?php echo $r['tgl_bayar'] ?>" name="tgl_bayar" class="form-control"><br/>
					<label>Periode</label>
					<select name="periode_bayar" class="selectSpp form-control" tabindex="-1">
						<?php
						$status = $con->query("SELECT * FROM tbl_pembayaran WHERE id_pembayaran=".$_GET['id_pembayaran']);
						$p = mysqli_fetch_array($status);
						$spp = 500000;
						$dpp = 350000;
						?>
						<option value="2017/2018" <?php if(isset($p['periode_bayar']) && $p['periode_bayar'] == '2017/2018') {echo "selected";} ?>>2017/2018</option>
						<option value="2018/2019" <?php if(isset($p['periode_bayar']) && $p['periode_bayar'] == '2018/2019') {echo "selected";} ?>>2018/2019</option>
						<option value="2019/2020" <?php if(isset($p['periode_bayar']) && $p['periode_bayar'] == '2019/2020') {echo "selected";} ?>>2019/2020</option>
						<option value="2020/2021" <?php if(isset($p['periode_bayar']) && $p['periode_bayar'] == '2020/2021') {echo "selected";} ?>>2020/2021</option>
						<option value="2021/2022" <?php if(isset($p['periode_bayar']) && $p['periode_bayar'] == '2021/2022') {echo "selected";} ?>>2021/2022</option>
						<option value="2022/2023" <?php if(isset($p['periode_bayar']) && $p['periode_bayar'] == '2022/2023') {echo "selected";} ?>>2022/2023</option>
					</select><br/><br/>
					<label class="col-sm-12">Sisa Pembayaran</label>
					<?php
					if ($r['jenis_pembayaran'] == "SPP") {
						?>
						<div class="col-sm-5">
							<input type="text" value="<?php echo $r['total_bayar'] ?>" name="total_bayar" class="form-control" readonly>
						</div>
						<div class="col-sm-1">+</div>
						<div class="col-sm-5">
							<input type="text" name="total_akhir" class="form-control" placeholder="<?php echo $spp - $r['total_bayar'] ?>"><br/>
						</div>
						<?php
					}elseif ($r['jenis_pembayaran'] == "DPP") {
						?>
						<div class="col-sm-5">
							<input type="text" value="<?php echo $r['total_bayar'] ?>" name="total_bayar" class="form-control" readonly>
						</div>
						<div class="col-sm-1">+</div>
						<div class="col-sm-5">
							<input type="text" name="total_akhir" class="form-control" placeholder="<?php echo $dpp - $r['total_bayar'] ?>"><br/>
						</div>
						<?php
					}
					?>
					<button type="submit" name="submit" class="btn btn-success btn-md">
						<i class="fa fa-save fa-fw"></i> Simpan
					</button>
					<button type="submit" class="btn btn-danger btn-md">
						<i class="fa fa-backward fa-fw"></i> Batal
					</button>
				</form>
			</div>
			<div class="col-sm-4 pull-right"></div>
			<div class="col-sm-12">
			</div>
		</div>
	</div>
	<?php include "js.php"; ?>
	<script>
		$(document).ready(function() {
			$(".selectSpp").select2({
				placeholder: "Select a state",
				allowClear: true
			});
		});
	</script>
</body>
</html>
<?php 
if (isset($_POST['submit'])) {
	$id_bayar 		= $_POST['id_pembayaran'];
	$id_siswa		= $_POST['id_siswa'];
	$jenis_bayar 	= mysqli_real_escape_string($con, $_POST['jenis_pembayaran']);
	$tgl_bayar		= mysqli_real_escape_string($con, $_POST['tgl_bayar']);
	$periode 		= mysqli_real_escape_string($con, $_POST['periode_bayar']);
	$total_bayar	= mysqli_real_escape_string($con, $_POST['total_bayar']);
	$total_akhir	= mysqli_real_escape_string($con, $_POST['total_akhir']);
	$total 			= ($total_bayar + $total_akhir);
	
	if ($jenis_bayar == 'SPP') {
		if ($total < 500000) {
			echo $status = 0;
		}
		else if ($total == 500000 ) {
			echo $status = 1;
		}
	}
	else if ($jenis_bayar == 'DPP') {
		if ($total < 350000) {
			echo $status = 0;
		}
		else if ($total == 350000 ) {
			echo $status = 1;
		}
	}

	$query = "UPDATE tbl_pembayaran SET jenis_pembayaran='".$jenis_bayar."', tgl_bayar='".$tgl_bayar."', periode_bayar='".$periode."', total_bayar='".$total."', status_pembayaran='".$status."', id_siswa='".$id_siswa."' WHERE id_pembayaran=".$id_bayar;

	if (mysqli_query($con, $query)) {
		session_start();
		$_SESSION['Pesan'] = 'Ubah Transaksi Berhasil';
		echo "<script language='JavaScript'>
		window.location = 'home.php?page=transaksi';
		</script>";
	}else{
		echo "Error : " . "<br/>" . mysqli_error($con);
	}
}