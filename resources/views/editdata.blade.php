<?php
include "koneksi.php";

$nik = $_POST['nik'];
$status = $_POST['status'];

$query = "UPDATE user SET status='$status' where NIK='$nik'";
mysqli_query($konek, $query);
header("location:admin.php?pesan=berhasil");
