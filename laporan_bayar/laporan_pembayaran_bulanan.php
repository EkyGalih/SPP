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
					<h4>Laporan Pembayaran Siswa</h4>
				</div>
				<div class="panel-body">
					<div class="col-sm-4 pull-left"></div>
					<?php
					if ($s['hak_akses'] == "admin" || $s['hak_akses'] == "kepsek") {
						?>
						<div class="col-sm-4">
							<form action="laporan_bayar/plug/excel_pembayaran_bulanan.php" method="post" onsubmit="return validateForm()">
								<label>Periode</label>
								<select name="periode" class="selectSpp form-control" tabindex="-1" required>
									<option>Pilih</option>
									<option value="2017/2018">2017/2018</option>
									<option value="2018/2019">2018/2019</option>
									<option value="2019/2020">2019/2020</option>
									<option value="2020/2021">2020/2021</option>
									<option value="2021/2022">2021/2022</option>
									<option value="2022/2023">2022/2023</option>
								</select><br/><br/>
								<label>Bulan</label>
								<select name="bulan" class="selectSpp form-control" tabindex="-1" required>
									<option>Pilih</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select><br/><br/>
								<button type="submit" class="btn btn-primary btn-md">
									<i class="fa fa-print fa-fw"></i> Cetak
								</button>
							</form>
						</div>
						<?php
					}
					?>
					<div class="col-sm-4 pull-right"></div>
					<div class="col-sm-12">
						<br/>
						<div class="table-responsive">
							<table class="table table-striped table-hover table-bordered" id="TableSpp">
								<thead>
									<tr>
										<th>No</th>
										<th>Nis</th>
										<th>Nama</th>
										<th>Kelas</th>
										<th>Jenis Kelamin</th>
										<th>Tgl Bayar</th>
										<th>Periode</th>
										<th>Total Bayar</th>
										<th>Status Pembayaran</th>
									</tr>
								</thead>
								<?php
								include "koneksi.php";
								$query = "SELECT tbl_pembayaran.*, tbl_siswa.* FROM tbl_pembayaran, tbl_siswa WHERE tbl_pembayaran.id_siswa=tbl_siswa.id_siswa && status_pembayaran= 1 ORDER BY id_pembayaran DESC";
								$rows = $con->query($query);
								if ($rows == FALSE) {
									trigger_error("Syntax mysql salah: " . $sql . "Error: " . $con->error, E_USER_ERROR);
								}else{
									$no=1;
									while ($l = $rows->fetch_array()) {
										?>
										<tbody>
											<tr>
												<td align="center"><?php echo $no ?></td>
												<td><?php echo $l['nis'] ?></td>
												<td><?php echo $l['nama_siswa'] ?></td>
												<td align="center"><?php echo $l['kelas'] ?></td>
												<td align="center"><?php echo $l['jenis_kelamin'] ?></td>
												<td align="center"><?php echo $l['tgl_bayar'] ?></td>
												<td align="center"><?php echo $l['periode_bayar'] ?></td>
												<td align="center">Rp.<?php echo number_format($l['total_bayar'],2,",",".") ?></td>
												<td align="center">
													<?php
													if ($l['status_pembayaran'] == false) {
														?>
														<label class="label label-warning">Belum Lunas</label>
														<?php
													}
													else if ($l['status_pembayaran'] == true) {
														?>
														<label class="label label-success">Lunas</label>
														<?php
													}
													?>
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
			<!-- </div> -->
			<!-- </div> -->
			<?php include "js.php"; ?>
		</body>
		</html>