<!DOCTYPE html>
<html>
<head>
	<title>APP SPP - MA NW Kotaraja</title>
	<?php //include "css.php" ?>
</head>
<body>
	<!-- <div id="wrapper"> -->
		<?php //include "../nav_up.php" ?>
		<?php //include "../nav_side.php" ?>
		<!-- <div id="page-wrapper"> -->
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Laporan Pembayaran DPP <u><?php echo $siswa['nama_siswa'] ?></u></h4>
				</div>
				<div class="panel-body">
					<div class="col-sm-4 pull-left"></div>
					<div class="col-sm-4 pull-right"></div>
					<div class="col-sm-12">
						<br/>
						<?php
						include "koneksi.php";
						$query = "SELECT * FROM tbl_siswa WHERE nis='$_SESSION[user_login]'";
						$row = $con->query($query);
						$siswa = $row->fetch_array();
						$id = $siswa['id_siswa'];
						$date = date("M Y");

						$sql = "SELECT * FROM tbl_pembayaran where jenis_pembayaran='DPP' && id_siswa=".$id;
						$rows = $con->query($sql);
						$lap = $rows->fetch_array();

						$dpp = 350000;
						if ($lap['jenis_pembayaran'] == "DPP" && $lap['status_pembayaran'] == 0) {
							?>
							<h3 align="center" class="alert alert-danger">Pembayaran <strong>DPP</strong> atas nama <strong><u><?php echo $siswa['nama_siswa'] ?></u></strong> sebesar <strong>Rp.<?php echo number_format($lap['total_bayar'],2,",",".")
							?></strong> dan masih tersisa tunggakan sebesar <strong>Rp.<?php echo number_format($dpp - $lap['total_bayar'],2,",",".") ?></strong> mohon untuk segera melunasi pembayaran sebelum akhir <strong><?php echo $date ?></strong></h3>
							<?php
						}elseif ($lap['jenis_pembayaran'] == "DPP" && $lap['status_pembayaran'] == 1) {
							?>
							<h3 align="center" class="alert alert-success">Pembayaran <strong>DPP</strong> atas nama <strong><u><?php echo $siswa['nama_siswa'] ?></u></strong> sudah <strong>LUNAS</strong></h3>
							<?php
						}else{
							?>
							<h3 align="center" class="alert alert-warning">Siswa atas nama <strong><u><?php echo $siswa['nama_siswa'] ?></u></strong> belum melakukan pembayaran <strong><u>DPP</u></strong></h3>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<!-- </div> -->
			<!-- </div> -->
			<?php include "js.php"; ?>
		</body>
		</html>