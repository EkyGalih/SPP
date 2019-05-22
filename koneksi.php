<?php
$hostname	= "localhost";
$username	= "root";
$password	= "";
$database	= "db_spp2";

$con = mysqli_connect($hostname, $username, $password, $database);
if ($con->connect_error) {
	echo "Gagal koneksi ke database : (" . $con->connect_error . ")";
}
