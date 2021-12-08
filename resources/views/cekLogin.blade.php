<?php
session_start();
include 'koneksi.php';
$nik = $_POST['NIK'];
$pass = $_POST['password'];
$pass1 = md5($_POST['password']);
$query = mysqli_query($konek, "SELECT * FROM user WHERE NIK = '$nik' AND password = '$pass1' ");
$data = mysqli_num_rows($query);
if ($nik == 'admin' and $pass == 'admin') {
    $_SESSION['user'] = $nik;
    $_SESSION['pass'] = $pass;
    header("location: admin.php");
} else if ($data > 0) {
    $_SESSION['user'] = $nik;
    $_SESSION['pass'] = $pass1;
    header("location: index.php?nik=$nik");
} else {
    header("location: login.php?pesan=gagal");
}
