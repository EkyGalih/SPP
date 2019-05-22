<?php
include("koneksi.php");
$kelas  	= mysqli_real_escape_string($con, $_POST['kelas']);
$periode 	= mysqli_real_escape_string($con, $_POST['periode']);
$tgl 		= mysqli_real_escape_string($con, $_POST['bulan']);


$sql = "SELECT tbl_pembayaran.*, tbl_siswa.* FROM tbl_pembayaran, tbl_siswa WHERE tbl_pembayaran.id_siswa=tbl_siswa.id_siswa && tgl_bayar LIKE '%$tgl%' && periode_bayar LIKE '%$periode%' && kelas LIKE '%$kelas%' ORDER BY id_pembayaran DESC";
$sum = "SELECT sum(total_bayar) as total from tbl_pembayaran";
$record = mysqli_query($con, $sum);
$s = mysqli_fetch_array($record);

$spp = 500000;
$dpp = 350000;
$recordset = mysqli_query($con, $sql);
if (mysqli_num_rows($recordset) > 0){
	?>
	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nis</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Periode</th>
				<th>Jenis Pembayaran</th>
				<th>Bulan</th>
				<th>Total Pembayaran</th>
				<th>Sisa Pembayaran</th>
			</tr>
		</thead>
		<?php
		$no=1;
		while ($row = mysqli_fetch_array($recordset)){
			?>
			<tr>
				<td align="center"><?php echo $no ?></td>
				<td align="center"><?php echo $row['nis'] ?></td>
				<td><?php echo $row['nama_siswa'] ?></td>
				<td align="center"><?php echo $row['kelas'] ?></td>			
				<td align="center"><?php echo $row['periode_bayar'] ?></td>				
				<td align="center"><?php echo $row['jenis_pembayaran'] ?></td>			
				<td align="center"><?php echo $row['tgl_bayar'] ?></td>				
				<td align="center">Rp.<?php echo number_format($row['total_bayar'],2,",",".") ?></td>
				<?php
				if ($row['jenis_pembayaran'] == "SPP") {
					$tspp = $spp - $row['total_bayar'];
					?>
					<td>Rp.<?php echo number_format($tspp,2,",",".") ?></td>
					<?php
				}elseif ($row['jenis_pembayaran'] == "DPP") {
					$tdpp = $dpp - $row['total_bayar']
					?>
					<td>Rp.<?php echo number_format($tdpp,2,",",".") ?></td>
					<?php
				}
				?>
			</tr>
			<?php
			$no++;
		}
	}
	?>
	<tr>
		<td><strong>TOTAL</strong></td>
		<td colspan="6"></td>
		<td align="center"><strong><u>Rp.<?php echo number_format($s['total'],2,",",".") ?></u></strong></td>
		<td>
			<?php
			$total = $tspp + $tdpp;
			echo "<strong><u>Rp." .number_format($total,2,",","."). "</u></strong>";
			?>
		</td>
	</tr>
</table>