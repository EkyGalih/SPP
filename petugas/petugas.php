<!DOCTYPE html>
<html>
<head>
	<title>Daftar Petugas</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Cari Petugas</h4>
		</div>
		<div class="panel-body">
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
				<table class="table table-bordered table-hover table-striped" id="TableSpp">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Password</th>
							<th>Hak_Akses</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<?php
					include "koneksi.php";
					$sql = "SELECT * FROM tbl_petugas ORDER BY id_petugas DESC";
					$hasil = $con->query($sql);
					if ($hasil == FALSE) {
						trigger_error("Syntax mysql salah: " . $sql . "Error: " . $con->error, E_USER_ERROR);
					} else {
						$no=1;
						while ($p = $hasil->fetch_array()) {
							?>
							<tbody>
								<tr>
									<td align="center"><?php echo $no ?></td>
									<td><?php echo $p['nama_petugas']?> </td>
									<td><?php echo $p['username']?> </td>
									<td align="center">
										<label class="label label-danger"><i class="fa fa-lock"></i> <strong><i>Privacy &amp; Protected</i></strong></label>
									</td>
									<td><?php echo $p['hak_akses']?> </td>
									<td align="center" class="tooltip-demo">
										<a data-toggle="tooltip" data-placement="right" title="Ubah Data" href="home.php?page=ubah_petugas&id_petugas=<?php echo $p['id_petugas'] ?>" class="btn btn-warning btn-sm">
											<i class="fa fa-edit fa-fw"></i>
										</a> |
										<a data-toggle="tooltip" data-placement="right" title="Hapus Data" href="home.php?page=hapus_petugas&id_petugas=<?php echo $p['id_petugas'] ?>" onclick="return confirm('Hapus Data Petugas?');" class="btn btn-danger btn-sm">
											<i class="fa fa-trash-o fa-fw"></i>
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
	<?php include "js.php"; ?>
</body>
</html>