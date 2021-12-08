<?php
include "koneksi.php";
include "enkripsi.php";

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis'];
$tgl = $_POST['tgl_lahir'];

$alamat = openssl_encrypt($alamat, $algoritma, $kunci, 0, $IV);
$jenis_kelamin = openssl_encrypt($jenis_kelamin, $algoritma, $kunci, 0, $IV);
$tgl = openssl_encrypt($tgl, $algoritma, $kunci, 0, $IV);

$query = "UPDATE user SET nama='$nama', Alamat='$alamat',jenis_kelamin='$jenis_kelamin', tgl_lahir='$tgl' where NIK='$nik'";
mysqli_query($konek, $query);
header("location:data.php?pesan=berhasil");
