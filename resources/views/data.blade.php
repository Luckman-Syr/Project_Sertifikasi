<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Website Cek Vaksinasi</title>
</head>

<body>
    <div class="login-page">
        <form class="back" action="index.php">
            <button class="btn btn-danger" type="submit">Back</button>
        </form>
        <div class="form">
            <?php
            if (isset($_GET['pesan']) == "berhasil") {
            ?>
                <div class="alert alert-info" role="alert">
                    Sukses
                </div>
            <?php
            }
            ?>
            <form class="login-form" action="simpan.php" method="POST" onSubmit="return validasi1()">
                <h4>Lengkapi Data Anda</h4>
                <?php
                include 'koneksi.php';
                include 'enkripsi.php';
                session_start();
                $nik = $_SESSION['user'];
                $data = mysqli_query($konek, "select * from user where NIK='$nik'");
                $baca = mysqli_fetch_array($data);

                $baca['Alamat'] = openssl_decrypt($baca['Alamat'], $algoritma, $kunci, 0, $IV);
                $baca['jenis_kelamin'] = openssl_decrypt($baca['jenis_kelamin'], $algoritma, $kunci, 0, $IV);
                $baca['tgl_lahir'] = openssl_decrypt($baca['tgl_lahir'], $algoritma, $kunci, 0, $IV);
                ?>
                <input type="text" name="nik" id="nik" value="<?php echo $nik ?>" readonly />
                <input type="text" value="<?php echo $baca['nama'] ?>" name="nama" id="nama" />
                <input type="text" <?php if ($baca['Alamat'] != NULL) { ?> value="<?php echo $baca['Alamat']; ?>" <?php } ?> placeholder="Alamat" name="alamat" id="alamat" />
                <input type="date" <?php if ($baca['tgl_lahir'] != NULL) { ?> value="<?php echo $baca['tgl_lahir']; ?>" <?php } ?> name="tgl_lahir" id="tgl_lahir" />
                <select <?php if ($baca['jenis_kelamin'] != NULL) { ?> value="<?php echo $baca['jenis_kelamin']; ?>" <?php } ?> name="jenis" id="jenis">
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function validasi1() {
        var username = document.getElementById("nik").value;
        var alamat = document.getElementById("alamat").value;
        var nama = document.getElementById("nama").value;
        var tgl = document.getElementById("tgl_lahir").value;
        var jenis = document.getElementById("jenis").value;
        if (username != "" && tgl != "" && nama != "" && nama != "" && tgl != "" && jenis != "") {
            return true;
        } else {
            alert('Data tidak boleh kosong!');
            return false;
        }
    }
</script>

<script>
    $("input[type=date]").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, inst) {
            $(inst).val(dateText); // Write the value in the input
        }
    });

    // Code below to avoid the classic date-picker
    $("input[type=date]").on('click', function() {
        return false;
    });
</script>