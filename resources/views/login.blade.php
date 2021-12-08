<?php
if (isset($_GET['var'])) {
    $var = $_GET['var'];
} else {
    $var = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <div class="form">
            <?php
            if ($var == 0) {
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "gagal") {
            ?>
                        <div class="alert alert-warning" role="alert">
                            Gagal Input data
                        </div>
                <?php
                    }
                }
                ?>
                <form class="register-form" action="register.php" method="POST" onSubmit="return validasi1()">
                    <h4>Registrasi Akun</h4>
                    <input type="text" placeholder="NIK" name="NIK" id="nik" />
                    <input type="text" placeholder="Nama" name="nama" id="nama" />
                    <input type="text" placeholder="Alamat Email" name="email" id="email" />
                    <input type="password" placeholder="Password" name="password" id="password" />
                    <button>create</button>
                    <p class="message">Sudah Memiliki Akun? <a href="login.php">Sign In</a></p>
                </form>
                <?php
            } else {
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "berhasil") {
                ?>
                        <div class="alert alert-info" role="alert">
                            Sukses Input data
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Gagal Login
                        </div>
                <?php
                    }
                }
                ?>
                <form class="login-form" action="cekLogin.php" method="POST" onSubmit="return validasi()">
                    <h4>Login Akun</h4>
                    <input type="text" placeholder="NIK" name="NIK" id="nik" />
                    <input type="password" placeholder="password" name="password" id="password" />
                    <button>login</button>
                    <p class="message">Belum Memiliki Akun? <a href="login.php?var=0">Create an account</a></p>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
<script>
    $('.message a').click(function() {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });
</script>
<script type="text/javascript">
    function validasi() {
        var username = document.getElementById("nik").value;
        var password = document.getElementById("password").value;
        if (username != "" && password != "") {
            return true;
        } else {
            alert('Username dan Password harus di isi !');
            return false;
        }
    }
</script>
<script type="text/javascript">
    function validasi1() {
        var username = document.getElementById("nik").value;
        var password = document.getElementById("password").value;
        var nama = document.getElementById("nama").value;
        var email = document.getElementById("email").value;
        if (username != "" && password != "" && email != "" && nama != "") {
            return true;
        } else {
            alert('Data tidak boleh kosong!');
            return false;
        }
    }
</script>