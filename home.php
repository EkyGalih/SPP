<?php
session_start();
require "koneksi.php";
if (!$_SESSION['user_login']){
	?>
	<script>
		alert("silahkan login terlebih dahulu")
		document.location = "index.php"
	</script>
	<?php }else{ ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>APP SPP | MA NW Kotaraja</title>
		<link rel="shortcut icon" href="assets/img/money.jpg">
		<?php include "css.php"; ?>
	</head>
	<body>
		<?php
		include "koneksi.php";
		$query = "SELECT * FROM tbl_petugas WHERE username='$_SESSION[user_login]'";
		$rows = $con->query($query);
		$s = $rows->fetch_array();
		$sql = "SELECT * FROM tbl_siswa WHERE nis='$_SESSION[user_login]'";
		$row = $con->query($sql);
		$siswa = $row->fetch_array();
		?>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
				<!-- navbar-header -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">
						<h6 style="margin-top: 1px; font-size: 12px; color: whitesmoke;">Sistem Informasi Pembayaran SPP</h6>
						<h3 style="color: #fff; font-size: 30px; margin-top: 1px;"><strong>MA NW Kotaraja</strong></h3>
					</a>
				</div>
				<!-- end navbar-header -->
				<!-- navbar-top-links -->
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<img src="assets/img/nw.jpg" width="50px" height="50px" class="img-squared" alt="logo ma nw">
						</a>
					</li>
					<!-- end main dropdown -->
				</ul>
				<!-- end navbar-top-links -->

			</nav>
			<nav class="navbar-default navbar-static-side" role="navigation">
				<!-- sidebar-collapse -->
				<div class="sidebar-collapse">
					<!-- side-menu -->
					<ul class="nav" id="side-menu">
						<li>
							<!-- user image section-->
							<div class="user-section">
								<div class="user-section-inner">
									<img class="img-circle" src="<?php echo $s['gambar'] ?><?php echo $siswa['gambar'] ?>" alt="">
								</div>
								<div class="user-info">
									<div><strong><?php echo $s['nama_petugas'] ?><?php echo $siswa['nama_siswa'] ?></strong></div>
									<div class="user-text-online">
										<span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
									</div>
								</div>
							</div>
							<!--end user image section-->
						</li>
						<li class="sidebar-search">

						</li>
						<li class="selected">
							<a href="home.php"><i class="fa fa-home fa-fw"></i>Home</a>
						</li>
						<?php
						if ($s['hak_akses'] == "admin") {
							?>
							<li>
								<a href="#"><i class="fa fa-user fa-fw"></i> Petugas<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="home.php?page=tambah_petugas"><i class="fa fa-plus fa-fw"></i> Tambah</a>
									</li>
									<li>
										<a href="home.php?page=petugas"><i class="fa fa-list-alt fa-fw"></i> Daftar Petugas</a>
									</li>
								</ul>
								<!-- second-level-items -->
							</li>
							<li>
								<a href="#"><i class="fa fa-user fa-fw"></i> Siswa<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="home.php?page=tambah_siswa"><i class="fa fa-plus fa-fw"></i> Tambah</a>
									</li>
									<li>
										<a href="home.php?page=siswa"><i class="fa fa-list-alt fa-fw"></i> Daftar Siswa</a>
									</li>
								</ul>
								<!-- second-level-items -->
							</li>
							<li>
								<a href="#"><i class="fa fa-money fa-fw"></i>Pembayaran<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="home.php?page=transaksi"><i class="fa fa-plus fa-fw"></i> Transaksi</a>
									</li>
								</ul>
								<!-- second-level-items -->
							</li>
							<?php
						}
						?>
						<?php
						if ($s['hak_akses'] == "kepsek" || $s['hak_akses'] == "admin") {
							?>
						<li>
							<a href="#"><i class="fa fa-files-o fa-fw"></i>laporan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="home.php?page=laporan_tunggakan"><i class="fa fa-print fa-fw"></i> Laporan Tunggakan</a>
								</li>
								<li>
									<a href="home.php?page=laporan_pembayaran_bulanan"><i class="fa fa-print fa-fw"></i> Laporan Bulanan</a>
								</li>
							</ul>
							<!-- second-level-items -->
						</li>
						<li>
							<a href="#"><i class="fa fa-wrench fa-fw"></i> Pengaturan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="home.php?page=profile"><i class="fa fa-user"></i> Edit Profile</a>
								</li>
								<li>
									<a href="home.php?page=keluar"><i class="fa fa-sign-out"></i> Keluar</a>
								</li>
							</ul>
						</li>
						<?php
						}
						?>
						<?php
						if ($siswa['kategori'] == "siswa") {
							?>
							<li>
								<a href="#"><i class="fa fa-files-o fa-fw"></i>laporan<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="home.php?page=laporan_spp_siswa">Laporan SPP</a>
									</li>
									<li>
										<a href="home.php?page=laporan_dpp_siswa">Laporan DPP</a>
									</li>
								</ul>
								<!-- second-level-items -->
							</li>
							<li>
							<a href="#"><i class="fa fa-wrench fa-fw"></i> Pengaturan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="home.php?page=profile_siswa"><i class="fa fa-user"></i> Edit Profile</a>
								</li>
								<li>
									<a href="home.php?page=keluar"><i class="fa fa-sign-out"></i> Keluar</a>
								</li>
							</ul>
						</li>
							<?php
						}
						?>
					</ul>
					<!-- end side-menu -->
				</div>
				<!-- end sidebar-collapse -->
			</nav>
			<div id="page-wrapper">
				<div class="row">
					<!-- Page Header -->
					<div class="col-lg-12">
						<h1 class="page-header">SISTEM INFORMASI | PEMBAYARAN SPP</h1>
					</div>
					<!--End Page Header -->
				</div>
				<div class="row">
					<!-- Welcome -->
					<div class="col-lg-12">
						<div class="alert alert-info">
							<i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Selamat datang <b><?php echo $s['nama_petugas'] ?><?php echo $siswa['nama_siswa'] ?> </b>
							<!-- <i class="fa  fa-pencil"></i><b>&nbsp;2,000 </b>Support Tickets Pending to Answere. nbsp; -->
						</div>
					</div>
					<!--end  Welcome -->
				</div>
				<?php 
		// PEMANGGILAN LINK PETUGAS
				if(isset($_GET['page'])){
					$page = $_GET['page'];

					switch ($page) {
						case 'petugas':
						include "petugas/petugas.php";
						break;
						case 'tambah_petugas':
						include "petugas/tambah_petugas.php";
						break;    
						case 'ubah_petugas';
						include "petugas/ubah_petugas.php";
						break;  
						case 'hapus_petugas';
						include "petugas/hapus_petugas.php";
						break;
					}
				}

		// END PEMANGGILAN

		// PEMANGGILAN LINK SISWA
				if(isset($_GET['page'])){
					$page = $_GET['page'];

					switch ($page) {
						case 'siswa':
						include "siswa/siswa.php";
						break;
						case 'tambah_siswa':
						include "siswa/tambah_siswa.php";
						break;  
						case 'ubah_siswa':
						include "siswa/ubah_siswa.php";
						break;   
						case 'hapus_siswa':
						include "siswa/hapus_siswa.php";
						break;    
					}
				}
		// END PEMANGGILAN

		//PEMANGGILAN LINK PEMBAYARAN
				if (isset($_GET['page'])) {
					$page = $_GET['page'];

					switch ($page) {
						case 'transaksi':
						include "pembayaran/transaksi.php";
						break;
						case 'ubah_transaksi';
						include "pembayaran/ubah_transaksi.php";
						break;
					}
				}
		//END PEMANGGILAN

		// PEMANGGILAN LAPORAN
				if (isset($_GET['page'])) {
					$page = $_GET['page'];

					switch ($page){
						case 'laporan_pembayaran_bulanan';
						include "laporan_bayar/laporan_pembayaran_bulanan.php";
						break;
						case 'laporan_tunggakan';
						include "laporan_bayar/laporan_tunggakan.php";
						break;
						case 'laporan_spp_siswa';
						include "laporan_bayar/Laporan_spp_siswa.php";
						break;
						case 'laporan_dpp_siswa';
						include "laporan_bayar/Laporan_dpp_siswa.php";
						break;
					}
				}
		// END PEMANGGILAN
		// PEMANGGILAN PENGATURAN
				if (isset($_GET['page'])) {
					$page = $_GET['page'];

					switch ($page){
						case 'profile';
						include "Profile/Petugas/Profile.php";
						break;
						case 'ubah_profile';
						include "Profile/Petugas/ubah_profile.php";
						break;
						case 'ubah_password';
						include "Profile/Petugas/ubah_password.php";
						break;
						case 'ubah_foto';
						include "Profile/Petugas/ubah_poto.php";
						break;
						case 'profile_siswa';
						include "Profile/Siswa/Profile_siswa.php";
						break;
						case 'ubah_profile_siswa';
						include "Profile/Siswa/ubah_profile_siswa.php";
						break;
						case 'ubah_password_siswa';
						include "Profile/Siswa/ubah_password_siswa.php";
						break;
						case 'ubah_foto_siswa';
						include "Profile/Siswa/ubah_poto_siswa.php";
						break;
						case 'keluar';
						include "keluar.php";
						break;
					}
				}
		// END PEMANGGILAN
				?>
			</div>
		</div>
		<?php include "js.php"; ?>
		<script>
			$(document).ready(function () {
				$('#TableSpp').dataTable();
			});
			$(document).ready(function() {
				$(".selectSpp").select2({
					placeholder: "Select a state",
					allowClear: true
				});
			});
		</script>
		<footer class="navbar navbar-default navbar-fixed-bottom">
			<p style="text-align: center; color: black; margin-top: 15px; margin-bottom: 5px;">Copyright MA NW Kotaraja &copy; 2017 | Supriadi</p>
		</footer>
	</body>
	</html>
	<?php } ?>