<?php
require 'koneksi.php';
//require 'fungsi.php';
$username   = ($_POST['nis']);
$password   = ($_POST['password']);
$ency       = md5($password);
// var_dump($ency);

$cek_admin = $con->query("SELECT nis FROM tbl_siswa WHERE nis = '$username' AND password = '$ency'");

if (($cek_admin->num_rows == 1)) {
    session_start();
    $_SESSION['user_login'] = $username;
    header("location:home.php");
} else {
	session_start();
	$_SESSION['Pesan'] = 'Nis atau Password Salah, <strong>coba lagi!</strong>';
    ?>
    <script>
        document.location = "LoginSiswa.php"
    </script>
    <?php
}
?>