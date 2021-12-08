<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Website Cek Vaksinasi</title>
</head>

<body>
    <div class="pengecekan">
        <div class="profile">
            <?php
            session_start();
            ?>
            <a class="namaprofile" href="data.php?nik=<?php echo $_SESSION['user'] ?>">
                <img src="asset/img/profile.png" alt="profile">
                <?php
                include 'koneksi.php';
                if (isset($_SESSION['user'])) {
                    $nik = $_SESSION['user'];
                    $data = mysqli_query($konek, "select * from user where NIK='$nik'");
                    $baca = mysqli_fetch_array($data);
                    $namabaru = substr($baca['nama'], 0, 10)
                ?>
                    <?php echo $namabaru . "..." ?>
                <?php
                }
                ?>
            </a>
            <form class="logout" action="logout.php" onSubmit="return validasi()">
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
        <div class="form">
            <h4>PENGECEKAN VAKSINASI</h4>
            <?php
            include "enkripsi.php";
            $nik = $_SESSION['user'];
            $data = mysqli_query($konek, "select * from user where NIK='$nik'");
            $baca = mysqli_fetch_array($data);
            if ($baca['Alamat'] != "" && $baca['jenis_kelamin'] != "" && $baca['tgl_lahir'] != "") {

                $baca['Alamat'] = openssl_decrypt($baca['Alamat'], $algoritma, $kunci, 0, $IV);
                $baca['jenis_kelamin'] = openssl_decrypt($baca['jenis_kelamin'], $algoritma, $kunci, 0, $IV);
                $baca['tgl_lahir'] = openssl_decrypt($baca['tgl_lahir'], $algoritma, $kunci, 0, $IV);

            ?>
                <form class="login-form">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $baca['NIK'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $baca['nama'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $baca['Alamat'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $baca['jenis_kelamin'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" readonly class="form-control-plaintext" value="<?php echo $baca['tgl_lahir'] ?>">
                        </div>
                    </div>
                    <label for="status"><b>STATUS VAKSINASI</b></label>
                    <input class="status" type="text" value="<?php echo $baca['status'] ?>" readonly />
                </form>
            <?php
            } else {
            ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Data belum lengkap </strong>
                    Lengkapi data dengan menekan icon profile
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function validasi() {
        if (confirm("Yakin Keluar?")) {
            return true;
        } else {
            return false;
        }
    }
</script>