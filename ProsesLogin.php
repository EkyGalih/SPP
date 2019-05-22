<?php
require 'koneksi.php';
//require 'fungsi.php';
$username   = ($_POST['username']);
$password   = ($_POST['password']);
$ency       = md5($password);
// var_dump($ency);

$cek_admin = $con->query("SELECT username FROM tbl_petugas WHERE username = '$username' AND password = '$ency'");

if (($cek_admin->num_rows == 1)) {
    session_start();
    $_SESSION['user_login'] = $username;
    header("location:home.php");
} else {
	session_start();
	$_SESSION['Pesan'] = 'Username atau Password Salah, <strong>coba lagi!</strong>';
    ?>
    <script>
        document.location = "LoginPetugas.php"
    </script>
    <?php
}
?>