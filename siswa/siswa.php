<!DOCTYPE html>
<html>
<head>
	<title>Daftar Siswa</title>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-list-alt fa-fw"></i> Daftar Siswa</h4>
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
							<th>Nis</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Jenis Kelamin</th>
							<th>Jurusan</th>
							<th>Kelas</th>
							<th>Periode</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<?php
					include "koneksi.php";
					$sql = "SELECT * FROM tbl_siswa ORDER BY id_siswa DESC";
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
									<td><?php echo $s['nis']?> </td>
									<td><?php echo $s['nama_siswa']?> </td>
									<td><?php echo $s['alamat']?> </td>
									<td><?php echo $s['jenis_kelamin']?> </td>
									<td><?php echo $s['jurusan']?> </td>
									<td><?php echo $s['kelas']?> </td>
									<td><?php echo $s['periode']?> </td>
									<td align="center">
										<div class="tooltip-demo">
											<a data-toggle="tooltip" data-placement="right" title="Ubah data" href="home.php?page=ubah_siswa&id_siswa=<?php echo $s['id_siswa'] ?>" class="btn btn-warning btn-sm">
												<i class="fa fa-edit fa-fw"></i>
											</a> |
											<a data-toggle="tooltip" data-placement="right" title="Hapus data" href="home.php?page=hapus_siswa&id_siswa=<?php echo $s['id_siswa'] ?>" onclick="return confirm('Hapus Data Siswa?');" class="btn btn-danger btn-sm">
												<i class="fa fa-trash-o fa-fw"></i>
											</a>
										</div>
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
</body>
</html>