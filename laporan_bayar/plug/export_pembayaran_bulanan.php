<?php
include("koneksi.php");
$periode 	= mysqli_real_escape_string($con, $_POST['periode']);
$tgl 		= mysqli_real_escape_string($con, $_POST['bulan']);


$sql = "SELECT tbl_pembayaran.*, tbl_siswa.* FROM tbl_pembayaran, tbl_siswa WHERE tbl_pembayaran.id_siswa=tbl_siswa.id_siswa && tgl_bayar LIKE '%$tgl%' && periode_bayar LIKE '%$periode%' && status_pembayaran='1' ORDER BY id_pembayaran DESC";
$sum = "SELECT sum(total_bayar) as total from tbl_pembayaran where status_pembayaran='1'";
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
				<th>Periode Pembayaran</th>
				<th>Jenis Pembayaran</th>
				<th>Tgl Bayar</th>
				<th>Total Bayar</th>
				<th>Status Pembayaran</th>
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
				if ($row['status_pembayaran'] == 1) {
					?>
					<td align="center" style="color: green;"><u><strong>Lunas</strong></u></td>
					<?php
				}elseif ($row['status_pembayaran'] == 0) {
					?>
					<td align="center" style="color: red;">Belum Lunas</td>
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
		<td align="center" colspan="2"><strong><u>Rp.<?php echo number_format($s['total'],2,",",".") ?></u></strong></td>
	</tr>
</table>