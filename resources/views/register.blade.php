<?php
include "koneksi.php";
$NIK = $_POST['NIK'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$pass = md5($_POST['password']);
$query = mysqli_query($konek, "INSERT INTO user VALUES('$NIK','$nama','$email','$pass','','','','Belum Vaksin')") or die(mysqli_error($konek));
if ($query) {
    header("location:login.php?pesan=berhasil");
} else {
    header("location:login.php?var=0 & pesan=gagal");
}
